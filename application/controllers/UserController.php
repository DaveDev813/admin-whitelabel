<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class UserController extends SYS_CoreController{

	public $add_page_title  = "Create New User";
	public $edit_page_title = "Update User Information";
	public $add_btn_label   = "Save User";
	public $edit_btn_label  = "Update User";

	public function __construct(){

		// NOTE :
		// FOR THE MEANTIME REFRAIN FROM USING 'UNIQUE' IN COLUMNS TO PREVENT REDUNDANT INDEXING, 
		// THESE WILL BE APPLIED TO ALL MODULE
		parent::__construct($this, array(
			"module"  => "user",
			"primary" => "user_id",
			"columns" => array(
				$this->setFields("first_name",    "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("middle_name",   "varchar(150)",  array("NULL", 	 "DEFAULT 'N/A'")),
				$this->setFields("last_name",     "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("gender", 		  "varchar(20)",   array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("date_of_birth", "datetime", 	   array("NULL", 	 "DEFAULT CURRENT_TIMESTAMP")),
				$this->setFields("email_address", "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("contact_no",    "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),				
				$this->setFields("password", 	  "varchar(150)",  array("NOT NULL")),
				$this->setFields("user_type", 	  "varchar(150)",  array("NOT NULL")),
			)
		));
	}

	public function index(){}

	public function preAddAction(){

		if($this->POST["con_password"] != $this->POST["password"]){
			$this->setPostErrorMsg("Password does not match, Please Try Again.");
		}

		$this->POST["password"] = md5($this->POST["password"] . "@_r@ND0M_t0k3n"); 
	}

	public function postAddAction(){
	
	}

	public function preEditAction(){

	}

	public function postEditAction(){

	}

	public function fields(){

		$position_values = array();

		$this->set("seperator", "", "Account Information", array(), array());

		$this->set("input",  		   "first_name",  	"First Name",  array(), array("required"));
		$this->set("input",  		   "middle_name", 	"Middle Name", array());
		$this->set("input",  		   "last_name",   	"Last Name",   array(), array("required"));
		$this->set("select", 		   "gender", 	    "Gender", 	   array("Male" => "M", "Female" => "F"));
		$this->set("inputdatemasked",  "date_of_birth", "Date Of Birth");
		$this->set("inputphonemasked", "contact_no",	"Contact No.");
		$this->set("input", 		   "email_address", "Email Address", array(), array("required"));
		$this->set("password", 		   "password", 		"Password", 		array(), array("required"));
		$this->set("select", "user_type", "Account Type", array("Super Admin" => "Super Admin", "Administrator" => "Administrator", "Employee" => "Employee"), array("required"));
	
		// $this->set("seperator", "", "Account Settings", array(), array());

		// $this->set("multiple", "position", "Account Position", array(
		// 	"IT Manager" 		=> "IT Manager",
		// 	"IT Officer" 		=> "IT Officer",
		// 	"QA Associate" 		=> "QA Associate",
		// 	"QA Lead" 			=> "QA Lead",
		// 	"Executive Officer" => "Executive Officer",
		// 	"Web Developer" 	=> "Web Developer"
		// ), array("required")); 


		// $this->set("multiple", "user_permission", "Account Permissions", array(
		// 	"IT Manager" 		=> "IT Manager",
		// 	"IT Officer" 		=> "IT Officer",
		// 	"QA Associate" 		=> "QA Associate",
		// 	"QA Lead" 			=> "QA Lead",
		// 	"Executive Officer" => "Executive Officer",
		// 	"Web Developer" 	=> "Web Developer"
		// ), array("required"));		
	}

	public function columns(){
		
		$this->setColumns('user_id', 	'No.', array());

		$this->setColumns('user_type', 	       'Type',	array());

		$this->setColumns('name', 		 	'Name',  		array(
			"format" => "CONCAT(first_name, ' , ' , last_name)",
		));

		$this->setColumns('email_address', 	'Email', 		array());

		$this->setColumns('contact_no', 	'Contact No.',	array());
	}

}
