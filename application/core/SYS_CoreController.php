<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SYS_CoreController extends CI_Controller{

	public $record 		      = array();
	public $dataset 		  = array();
	public $columns           = array();
	public $table_columns     = array();
	public $fields     	      = array();
	public $post_result_error = 0;
	public $method         	  = "";
	public $module 			  = "";

	protected $recordLimit 	  = 30;
	protected $action 	      = "";
	protected $title  	      = "";
	protected $recordFilter   = "";	
	protected $POST           = array();
	protected $GET            = array();
	protected $REQ            = array();
	protected $formFields     = array();

	private $recordOffset     = 1;
	private $moduleColumns    = array();
	private $child  	      = null;

    public function __construct($child, $module){

        parent::__construct();
 		
 		$this->primary = $module["primary"]; 
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

			if(!method_exists($this->child, 'add') || !method_exists($this->child, 'edit')){

				die("Failed to load module: missing function add/edit()");
			}

			if($this->method == "POST"){

				//call module specific validation
				if($child->validate()){

					//core action execute
					$this->post_result_error = intval($this->{ "core_".$this->action}());

					//execute further procedures of the module after the request (add/edit)
					$this->child->postActionResult();

					if($this->post_result_error == 0){
	
						header("Location: " . base_url() . $this->module ."/list");
	
						exit();
					}
				}
			}

			if(!method_exists($this->child, 'custom_form')){

				$this->load->view("home", array("content"=> "/default/form", "CORE" => $this, "MODULE" => $this->child));
			}

			return;

		}else{

			if($this->action == "list"){
				
				$this->child->columns();

				$this->getDataSet();

				if(!method_exists($child, 'custom_list')){

					$this->load->view("home", array("content"=> "/default/list", "CORE" => $this, "MODULE" => $child));

					return;
				}
			}
		} 

		die("Module Error : unknown action given");
    }

    private function setRequestValues(){

    	//get the columns of the tabl e
    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

    	$row = array();

		foreach(array_keys($this->fields) as $field){

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

					$row[$field] = $this->POST[$field];
				}
			}
		}

		return $row;
    }

    private function core_add(){

		//call custom module procedures
		$this->child->{$this->action}();

		//set post values to the corresponding table columns
		$row = $this->setRequestValues();

		$this->CoreModel->insert($this->module, $row);
     }

    private function core_edit(){

		//call custom module procedures
		$this->child->{$this->action}();

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

    	if($this->action == "edit"){

    		//pre set the values of the field
			if(isset($this->record->{$id})){
	    		if($type == "select"){
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

    protected function setFields($column_name, $type, $options, $isPrimary = FALSE){

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