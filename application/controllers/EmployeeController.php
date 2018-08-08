<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class EmployeeController extends SYS_CoreController{

	public function __construct(){

		parent::__construct($this, array(
			"module"  	  => "employee",
			"primary" 	   => "employee_id",
			"sources" 	   => array("validation.js","ekek.js",""),
			"styles"  	   => array("lodi.css",)
		));
	}

	public function index(){

	}

	public function list(){

	}

	public function add(){

	}

	public function edit(){

	}

	public function validation(){
		
	}

	public function formFields(){	

		//id, class, css, x
		$this->setFields("employee_id", "INT", array("NOT NULL", "PRIMARY KEY", "AUTO_INCREMENT"), TRUE);

		$this->setFields("first_name", "longtext(50)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("last_name", "varchar(50)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("email_address", "varchar(20)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("gender", "varchar(20)", array("NULL", "DEFAULT 'N/A'"));

		$this->setFields("contact_no", "varchar(20)", array("NULL", "DEFAULT 'N/A'"));

		$this->setFields("contact_no", "varchar(20)", array("NULL", "DEFAULT 'N/A'"));

		$this->setFields("contact_no", "varchar(20)", array("NULL", "DEFAULT 'N/A'"));
	}

	public function columnFields(){

		$this->setColumns("employee_id", "Employee ID", array(

		));

		$this->setColumns("employee_id", "Name", array(

		));

		$this->setColumns("employee_id", "Email", array(

		));
	}
}
