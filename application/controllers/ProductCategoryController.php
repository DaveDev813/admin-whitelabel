<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class ProductCategoryController extends SYS_CoreController{

	public $add_page_title  = "Create New Category";
	public $edit_page_title = "Edit Category";
	public $add_btn_label   = "Save Category";
	public $edit_btn_label  = "Update Category";

	public function __construct(){

		parent::__construct($this, array(
			"module"  => "product_category",
			"primary" => "category_id",
			"columns" => array(
				$this->setFields("code",    	"varchar(100)"),
				$this->setFields("name",    	"varchar(100)"),
				$this->setFields("description", "longtext"),
			)
		));
	}

	public function index(){
	}

	public function add(){
	}

	public function edit(){
	}

	public function postActionResult(){
	}

	public function validate(){
		
		if($this->product_model->isProductCategoryCodeExists($_POST["code"])){
			$this->setPostErrorMsg("Tag Code Already Exists");
			return FALSE;
		}

		if($this->product_model->isProductCategoryCodeExists($_POST["name"])){
			$this->setPostErrorMsg("Tag Name Already Exists!");
			return FALSE;
		}

		if(!isset($_POST["product_category_description"]) || empty($_POST["description"])){
			$_POST["description"] = "N/A";
		}

		return TRUE;
	}

	public function columns(){

		$this->setColumns('code', 		 'Code', 		array());
		$this->setColumns('name', 		 'Name', 		array());
		$this->setColumns('description', 'Description', array());		
	}

	public function fields(){

		$this->set("input",    "code", 	   	  "Code", 	       array(), array("required"));  		
		$this->set("input",    "name", 	   	  "Category Name", array(), array("required"));
		$this->set("textarea", "description", "Description",   array(), array("rows" => 5));
	}
}
