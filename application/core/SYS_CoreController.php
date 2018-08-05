<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SYS_CoreController extends CI_Controller{

	public 	  $child  = null;
	protected $action = "";
	protected $title  = "";
	protected $module = "";
	protected $_REQ   = array();
	protected $fields = array();

    public function __construct($child, $module){

        parent::__construct();
 	
        $this->module = $module["module"];

		$this->action = $this->uri->segment(2);

		$this->POST   = $_POST;
		$this->GET 	  = $_GET;
		$this->REQ    = $_REQUEST;

		$child->formFields();

		if($this->action == "list"){

//			$this->generateListView();
		}else{
			//add or edit

			$this->generate();
		}
	
		$this->load->view('home', array("content" => "employee" . "/" . "add"));
    }

    protected function generateListView(){

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