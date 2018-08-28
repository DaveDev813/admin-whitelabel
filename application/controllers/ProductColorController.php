<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class ProductColorController extends SYS_CoreController{

	public $add_page_title  = "Create New Tag";
	public $edit_page_title = "Edit Tag";
	public $add_btn_label   = "Save Tag";
	public $edit_btn_label  = "Update Tag";

	public function __construct(){

		parent::__construct($this, array(
			"module"  => "product_color",
			"primary" => "product_color_id",
			"columns" => array(
				$this->setFields("color_code", 	 "varchar(100)"),
				$this->setFields("color_name", 	 "varchar(100)"),
				$this->setFields("hex", 	  	 "varchar(100)"),
				$this->setFields("date_created", "datetime"),
			)
		));
	}

	public function index(){

	}

	public function postActionResult(){

	}

	public function validate(){

		return TRUE;
	}

	public function add(){
	}

	public function edit(){
	}

	public function columns(){

		$this->setColumns('product_tag_code', 		 'Code', 		array());
		$this->setColumns('product_tag_name', 		 'Name', 		array());
		$this->setColumns('product_tag_description', 'Description', array());		
	}

	public function fields(){

		$this->set("input",    "color_code", "Code", 	    array(), array("required"));  		
		$this->set("input",    "color_name", "Tag Name", 	array(), array("required"));
		$this->set("textarea", "hex", 		 "Description", array(), array("rows" => 5));
	}
}
