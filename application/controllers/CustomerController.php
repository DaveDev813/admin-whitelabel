<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class CustomerController extends SYS_CoreController{

	public function __construct(){

		parent::__construct($this, array(
			"module"  	  => "customer",
			"primary" 	   => "customer_id",
			"sources" 	   => array(),
			"styles"  	   => array()
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

	public function formFields(){	

		$this->setFields("customer_id", "INT", array("NOT NULL", "PRIMARY KEY", "AUTO_INCREMENT"), TRUE);

		$this->setFields("first_name", "varchar(50)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("last_name", "varchar(50)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("email_address", "varchar(20)", array("NOT NULL", "DEFAULT 'N/A'"));

		$this->setFields("gender", "varchar(20)", array("NULL", "DEFAULT 'N/A'"));

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
