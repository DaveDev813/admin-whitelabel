<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_ErrorController.php';

class SYS_CoreController extends SYS_ErrorController{

	public $record 		      = array();
	public $dataset 		  = array();
	public $columns           = array();
	public $table_columns     = array();
	public $fields     	      = array();
	public $post_result_error = 0;
	public $method         	  = "";
	public $module 			  = "";
	public $action 	      	  = "";

	protected $recordLimit 	  = 30;
	protected $title  	      = "";
	protected $recordFilter   = "";	
	protected $POST           = array();
	protected $GET            = array();
	protected $FILES          = array();	
	protected $REQ            = array();
	protected $formFields     = array();

	private $recordOffset     = 1;
	private $moduleColumns    = array();
	private $child  	      = null;

    public function __construct($child, $module){

        parent::__construct();

		if(intval($_SESSION["logged_in"]) !== 1){
			header("Location: " . base_url() . "login");
		}

		$this->load->model("PositionModel", "positions_model");
		$this->load->model("ProductModel",  "product_model");

 		$this->primary = $module["primary"]; 
 		$this->FILES   = $_FILES;
		$this->POST    = $_POST;
		$this->GET 	   = $_GET;
		$this->REQ     = $_REQUEST;
        $this->module  = $module["module"];
		$this->action  = $this->uri->segment(2);
		$this->method  = $this->input->server('REQUEST_METHOD');
		$this->child   = $child;

		if($this->action == "edit"){

			$this->record = $this->CoreModel->getRecordById($this->module, $this->primary, $this->GET["id"]);
		}

		$this->child->fields();	

		//re/generate the tables structure of the module
		$this->compile();

		if(in_array($this->action, array("add","edit"))){

			if(!method_exists($this->child, 'fields')){

				die("Failed to load module: missing function fields()");
			}

			if($this->method == "POST"){

				//core action execute
				$this->post_result_error = intval($this->{ "core_".$this->action}());

				//call a post determined action declared in the child
				if(method_exists($this->child, "post" . ucfirst($this->action) . "Action")){
					$this->child->{"post" . ucfirst($this->action) . "Action"}();
				}

				if($this->post_result_error == 0){

					header("Location: " . base_url() . $this->module ."/list");

					exit();

				}else{

					if(!method_exists($this->child, 'custom_form')){

						$this->load->view("home", array(
							"content" => "/default/form", 
							"CORE" 	  => $this, 
							"MODULE"  => $this->child,
							"ERROR"   => array(
								"msg"    => $this->post_error_msg,
								"status" => $this->post_result_error
							)
						));
					}
				}

			}else{

				if(!method_exists($this->child, 'custom_form')){

					$this->load->view("home", array(
						"content" => "/default/form", 
						"CORE" 	  => $this, 
						"MODULE"  => $this->child
					));
				}
			}

			return;
		}else{

			if($this->action == "list"){
				
				$this->child->columns();

				$this->getDataSet();

				if(method_exists($child, 'customColumnlist')){

					$this->child->customColumnlist();
				}

				if(!method_exists($child, 'custom_list')){

					$this->load->view("home", array("content"=> "/default/list", "CORE" => $this, "MODULE" => $child));

					return;
				}
			}
		} 

		die("Module Error : unknown action given");
    }

    public function forceFieldValue($field, $value){
    	$this->fields[$field] = array();
    	$this->POST[$field]   = $value;
    }

    private function setRequestValues(){

    	//get the columns of the tabl e
    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

    	if($this->action == "add"){
	    	$row = array(
	    		"date_created" => date("Y-m-d H:i:s"),
	    		"created_by"   => $_SESSION["username"],
	    		"updated_by"   => "N/A",
	    		"date_updated" => "00-00-00 00:00:00"
	    	);
    	}else{
	    	$row = array(
	    		"updated_by"   => $_SESSION["username"],
	    		"date_updated" => date("Y-m-d H:i:s")
	    	);
    	}

		foreach(array_keys($this->fields) as $field){

			//it means that this is a seperator (see FormComponents.php seperator() function ).. skip it
			if(is_integer($field)){
				continue;
			}

			//check if the columns exists

			$column_exits = FALSE;
			$column_conf  = NULL;

			foreach($this->moduleColumns as $column){

				if($column->Field == $field){

					$column_exits = TRUE;
					$column_conf  = $column;

					break;
				}
			}

			if($column_exits){

				if(in_array($column_conf->Type, array("datetime", "date"))){

					if(strtotime($this->POST[$field]) == FALSE){

						die("Can't format the value of " . $field);
					}

					$row[$field] = date("Y-m-d", strtotime($this->POST[$field]));

				}else{

					if(isset($this->POST[$field])){
						$row[$field] = $this->POST[$field];
					}
				}
			}
		}

		return $row;
    }

    private function core_add(){

		//call a pre determined action declared in the child
		if(method_exists($this->child, "pre"  . ucfirst($this->action) . "Action")){
			$this->child->{"pre"  . ucfirst($this->action) . "Action"}();
		}

		//set post values to the corresponding table columns
		$row = $this->setRequestValues();

		$this->insert_id = $this->CoreModel->insert($this->module, $row);
     }

    private function core_edit(){

		//call a pre determined action declared in the child
		if(method_exists($this->child, "pre"  . ucfirst($this->action) . "Action")){
			$this->child->{"pre"  . ucfirst($this->action) . "Action"}();
		}

		//set post values to the corresponding table columns
		$row = $this->setRequestValues();

		$this->CoreModel->update($this->module, $row, $this->GET["id"]);
    }

    private function getDataSet(){

    	$columns =  $this->primary . ", ";

    	foreach($this->columns as $field => $conf){

    		$options  = $conf["options"];

    		$columns .= (isset($options["format"]) ? $options["format"] . " as " . $field : $field) . ", ";
    	}

		$this->dataset = $this->CoreModel->getRecords($this->module, $columns, "", $this->recordLimit, $this->recordOffset);
    }

    protected function setColumns($field, $label, $options){

    	$this->columns[$field] = array("label" => $label, "options" => $options);
    }

    protected function set($type, $id, $label, $values = array(), $options = array()){

    	if($type == "seperator"){

    		$this->fields[] = array(
    			"html" 	  => $this->formcomponents->seperator($label),
    			"options" => array()
    		);

    		return;
    	}

    	if($this->action == "edit"){

    		//pre set the values of the field
			if(isset($this->record->{$id})){

				if($type == "multiple"){

					$options["selected"] = explode("|", $this->record->{$id});

				}elseif($type == "select"){

	    			$options["selected"] = $this->record->{$id};

	    		}else{

		    		$values[] = $this->record->{$id};
	    		}
			}
    	}

    	$this->fields[$id] = array(
    		"html"    => $this->formcomponents->set($type, $id, $label, $values, $options),
    		"options" => $options
    	);
    }

    protected function setFormField($name, $type, $properties){
    		
    	//Add further validations here..

    	$this->formFields[] = array("name" => $name, "type" => $type, "prop" => $properties);
    }

    protected function setFields($column_name, $type, $options = array(), $isPrimary = FALSE){

    	$col_options = "";

    	foreach($options as $option){
    		$col_options .= " " . $option . " ";
    	}

    	if($isPrimary){
    		array_unshift($this->table_columns, $column_name . " " . $type . $col_options);
    	}else{
	    	$this->table_columns[$column_name]  = $column_name . " " . $type . $col_options; 
    	}
    }

	private function compile(){

		if(!$this->CoreModel->isTableExists($this->module)){

			$this->setFields($this->primary, "INT", array("NOT NULL", "PRIMARY KEY", "AUTO_INCREMENT"), TRUE);

			$this->table_columns["created_by"]   = "created_by varchar(100) NOT NULL";
			$this->table_columns["date_created"] = "date_created datetime";
			$this->table_columns["date_updated"] = "date_updated datetime";
			$this->table_columns["updated_by"]   = "updated_by varchar(100) NOT NULL";

			$this->db->query('CREATE TABLE '. $this->module .' (' . implode(" , ", $this->table_columns) . ')');
			
	    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

		}else{

	    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

			//If the table exists, alter the tables
			$altered_columns = "";

			foreach($this->table_columns as $name => $column){

				$action  	   = "CHANGE"; 

				$is_col_exists = FALSE;

				//check if the $name exists on the createad table
				foreach($this->moduleColumns as $columns){
					//if the $name found a match it means it has not been renamed
					if($name == $columns->Field){

						$is_col_exists = TRUE;

						break;
					}
				}

				if(!$is_col_exists){

					$action = "ADD";
				}

				$altered_columns .= " " . $action . " " . ((!$is_col_exists) ? "" : $name) . " " . $column . ", ";
			}

			$this->db->query('ALTER TABLE ' . $this->module . rtrim($altered_columns, ", "));
		}
	} 
}