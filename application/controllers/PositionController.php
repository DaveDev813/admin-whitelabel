<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class PositionController extends SYS_CoreController{

	public $add_page_title  = "Create New Position";
	public $edit_page_title = "Edit Customer";
	public $add_btn_label   = "Save Customer";
	public $edit_btn_label  = "Update Customer";

	public function __construct(){

		parent::__construct($this, array(
			"module"  => "positions",
			"primary" => "position_id",
			"columns" => array(
				$this->setFields("position_code", "varchar(200)",  array("NOT NULL")),
				$this->setFields("position_name", "varchar(200)",  array("NOT NULL")),
				$this->setFields("description",   "varchar(500)",  array("NULL", 	 "DEFAULT 'N/A'")),
				$this->setFields("date_created",  "datetime",      array("NOT NULL", "DEFAULT CURRENT_TIMESTAMP")),
			),
			"sources" => array(),
			"styles"  => array()
		));
	}

	public function index(){
	}

	public function postActionResult(){
	}

	public function validate(){

		if($this->positions_model->isCodeExists($_POST["position_code"])){

			$this->setPostErrorMsg("Position Code Already Exists");

			return FALSE;
		}

		if($this->positions_model->isPositionNameExists($_POST["position_name"])){
			
			$this->setPostErrorMsg("Position Name Already Exists!");

			return FALSE;
		}

		if($_POST["description"] == "" || empty($_POST["description"])){

			$_POST["description"] = "N/A";
		}

		return TRUE;
	}

	public function add(){
	}

	public function edit(){
	}

	public function columns(){
		
		$this->setColumns('position_code', 'Code', array());

		$this->setColumns('position_name', 'Name', array());
	
		$this->setColumns('description',   'Description', array());		
	}

	public function fields(){

		$this->set("input", "position_code", "Code", array(), array(
			"placeholder" => "Position Code",
			"required",
		));  

		$this->set("input", "position_name", "Position Name", array(), array(
			"placeholder" => "Position Name",
			"required"
		));

		$this->set("textarea", "description", "Position Description", array(), array(
			"placeholder" => "Enter Position Description",
			"rows"        => 5,
		));
	}
}
