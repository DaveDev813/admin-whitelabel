<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SYS_CoreController extends CI_Controller{

	public $record 		      = array();
	public $dataset 		  = array();
	public $columns           = array();
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
 	
		$this->POST   = $_POST;
		$this->GET 	  = $_GET;
		$this->REQ    = $_REQUEST;
        $this->module = $module["module"];
		$this->action = $this->uri->segment(2);
		$this->method = $this->input->server('REQUEST_METHOD');
		$this->child  = $child;

		if($this->action == "edit"){
			$this->record = $this->CoreModel->getRecordById($this->module, $this->GET["id"]);
		}

		$this->child->fields();	

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
					if($this->{ "core_".$this->action}()){
						$this->post_result_error = 0;
					}else{
						$this->post_result_error = 1;
					}

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

    private function core_add(){

		//call custom module procedures
		$this->child->{$this->action}();

    	//get the columns of the tabl e
    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

    	$new_row = array();

		foreach(array_keys($this->fields) as $field){

			$column_exits = FALSE;

			foreach($this->moduleColumns as $column){

				if($column->Field == $field){

					$column_exits = TRUE;

					break;
				}
			}

			if($column_exits){

				$new_row[$field] = $this->POST[$field];
			}
		}

		return $this->CoreModel->insert($this->module, $new_row);
     }

    private function core_edit(){

		//call custom module procedures
		$this->child->{$this->action}();

    	//get the columns of the tabl e
    	$this->moduleColumns = $this->CoreModel->getColumns($this->module);

    	$rows = array();

		foreach(array_keys($this->fields) as $field){

			$column_exits = FALSE;

			foreach($this->moduleColumns as $column){

				if($column->Field == $field){

					$column_exits = TRUE;

					break;
				}
			}

			if($column_exits){

				$rows[$field] = $this->POST[$field];
			}
		}

		return $this->CoreModel->update($this->module, $rows, $this->GET["id"]);
    }

    private function compile(){

		// var_dump($this->CoreModel->isTableExists("customers"));
    }

    private function getDataSet(){

    	$columns = "id, ";

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

    	$this->formFields[] = array(
    		"name" => $name,
    		"type" => $type,
    		"prop" => $properties
    	);
    }

    protected function setFields($column_name, $type, $options, $isPrimary = FALSE){

    	$col_options = "";

    	foreach($options as $option){
    		$col_options .= " " . $option . " ";
    	}

    	$this->fields[]  = $column_name . " " . $type . $col_options; 
    }

	private function generate(){
		
		$existing = $this->db->query("SHOW TABLES LIKE '%" . $this->module . "%'");

		if(count($existing->result())){

			$this->db->query('RENAME TABLE ' . $this->module . ' TO ' . $this->module . '_tmp');

			$rows = $this->db->query("SELECT * FROM " . $this->module . "_tmp");

			$this->db->query('CREATE TABLE '. $this->module .' (' . implode(" , ", $this->fields) . ')');			
		}else{

			$this->db->query('CREATE TABLE '. $this->module .' (' . implode(" , ", $this->fields) . ')');			
		}
	} 
}