<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class CustomerController extends SYS_CoreController{

	public 	  $add_page_title  = "Add New Customer";
	public 	  $edit_page_title = "Edit Customer";
	public 	  $add_btn_label   = "Save Customer";
	public 	  $edit_btn_label  = "Update Customer";

	public function __construct(){

		parent::__construct($this, array(
			"module"  => "customer",
			"primary" => "customer_id",
			"columns" => array(
				$this->setFields("customer_no",     "varchar(200)",  array("NOT NULL", "DEFAULT 'N/A'", "UNIQUE")),
				$this->setFields("first_name",      "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("middle_name",     "varchar(150)",  array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("last_name",       "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("gender", 		    "varchar(20)",   array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("date_of_birth",   "datetime", 	 array("NULL", 	   "DEFAULT CURRENT_TIMESTAMP")),
				$this->setFields("email_address",   "varchar(150)",  array("NOT NULL", "DEFAULT 'N/A'")),
				$this->setFields("contact_no",      "varchar(20)",   array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("company_name",    "varchar(100)",  array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("company_email",   "varchar(100)",  array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("company_contact", "varchar(50)",   array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("company_address", "varchar(500)",  array("NULL", 	   "DEFAULT 'N/A'")),
				$this->setFields("date_created",    "datetime",      array("NOT NULL", "DEFAULT CURRENT_TIMESTAMP")),
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

		$date_of_birth = $_POST["date_of_birth"];

		if(strtotime($date_of_birth)){			
			$_POST["date_of_birth"] = date("m/d/Y", strtotime($date_of_birth)) . " 00:00:00";
		}

		return TRUE;
	}

	public function add(){

	}

	public function edit(){

	}


	public function columns(){
		
		$this->setColumns('customer_no', 	'Customer No.', array());

		$this->setColumns('name', 		 	'Name',  		array(
			"format" => "CONCAT(first_name, ', ', last_name, ' ', middle_name)",
		));

		$this->setColumns('email_address', 	'Email', 		array());

		$this->setColumns('contact_no', 	'Contact No.',	array());
	}

	public function fields(){

		$this->set("input", "customer_no", "Customer No.", array(), array(
			"placeholder" => "Customer No",
			"required",
		));  

		$this->set("input", "first_name", "First Name", array(), array(
			"placeholder" => "First Name",
			"required"
		));

		$this->set("input", "middle_name", "Middle Name", array(), array(
			"placeholder" => "Middle Name",
		));

		$this->set("input", "last_name", "Last Name", array(), array(
			"placeholder" => "Last Name",
			"required"
		));

		$this->set("select", "gender", "Gender", array(
			"Male"   => "M", 
			"Female" => "F", 
			"Others" => "O"
		));

		$this->set("inputdatemasked", "date_of_birth", "Date Of Birth");

		$this->set("inputphonemasked", "contact_no", "Contact No.");

		$this->set("input", "email_address", "Email Address", array(), array(
			"placeholder" => "Email Address",
			"required"
		));

		$this->set("input", "company_name", "Company Name", array(), array(
			"placeholder" => "Company Name",
		));

		$this->set("input", "company_email", "Company Email", array(), array(
			"placeholder" => "Company Address",
		));

		$this->set("inputphonemasked", "company_contact", "Company Contact No.");

		$this->set("textarea", "company_address", "Company Address", array(), array(
			"placeholder" => "Company Address",
			"rows"        => 5,
		));
	}
}
