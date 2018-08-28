<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once getcwd() . '\application\core\SYS_CoreController.php';

class ProductsController extends SYS_CoreController{

	public $add_page_title  	 = "Create New Product";
	public $edit_page_title 	 = "Edit Product";
	public $add_btn_label   	 = "Save Product";
	public $edit_btn_label  	 = "Update Product";
	private $product_upload_path = "./assets/uploads/rrj/";

	private $uploaded_files 	 = array();
	private $product_categories  = array();
	private $product_tags  		 = array();
	private $clothe_sizes 	  	 = array(
		"Extra Large" => "XXL", 
		"Large"  	  => "L", 
		"Medium"  	  => "M",
		"Small"  	  => "S", 
		"Extra Small" => "XS"
	);		
	private $product_colors 	  = array(
		"Red" 	 => "R", 
		"Orange" => "O", 
		"Yellow" => "Y",
		"Green"  => "G", 
		"Blue" 	 => "B",
		"Indigo" => "I",
		"Violet" => "V"
	);

	public function __construct(){

		parent::__construct($this, array(
			"module"  => "products",
			"primary" => "product_id",
			"columns" => array(
				$this->setFields("code",        "varchar(100)"),
				$this->setFields("name",   	    "varchar(100)"),
				$this->setFields("category",   	"longtext"),
				$this->setFields("tags",   	    "longtext"),
				$this->setFields("sizes",   	"longtext"),
				$this->setFields("colors",   	"longtext"),
				$this->setFields("description", "longtext"),
				$this->setFields("status", 		"varchar(100)")
			)
		));
	}

	public function index(){}

	public function preAddAction(){

		$this->POST["category"] = trim(implode("|", $this->POST["category"]));
		$this->POST["tags"]  	= trim(implode("|", $this->POST["tags"]));
		$this->POST["sizes"]  	= trim(implode("|", $this->POST["sizes"]));
		$this->POST["colors"]  	= trim(implode("|", $this->POST["colors"]));

		$this->forceFieldValue("status", "Active");

		//$upload_result 	 				= $this->uploadProductImages();

		// if($upload_result === TRUE){

		// }else{

		// 	$this->setPostErrorMsg($upload_result["msg"]);

		// 	return FALSE;
		// }

		return TRUE;
	}

	public function postAddAction(){

		// if(isset($this->POST["category"]) && !empty($this->POST["category"]) && is_array($this->POST["category"])){

		// 	$rows = array();

		// 	foreach($this->POST["category"] as $category){

		// 		$rows[] = array("product_id" => $this->insert_id, "category_id" => $category);
		// 	}

		// 	$this->CoreModel->insert_batch("cmp_product_categories", $rows);
		// }

		// if(isset($this->POST["tags"]) && !empty($this->POST["tags"]) && is_array($this->POST["tags"])){

		// 	$rows = array();

		// 	foreach($this->POST["tags"] as $category){

		// 		$rows[] = array("product_id" => $this->insert_id, "tag_id" => $category);
		// 	}

		// 	$this->CoreModel->insert_batch("cmp_product_s", $rows);
		// }


		// $rows = array();

		// foreach($this->uploaded_files as $path){
			
		// 	$rows[] = array(
		// 		"reference_id" => $this->insert_id,
		// 		"module_name"  => $this->module,
		// 		"file_path"    => $path,
		// 		"date_created" => date("Y-m-d H:i:s")
		// 	);
		// }

		// $this->CoreModel->insert_batch("files", $rows);		
	}

	public function preEditAction(){

		$this->POST["category"] = trim(implode("|", $this->POST["category"]));
		$this->POST["tags"]  	= trim(implode("|", $this->POST["tags"]));
		$this->POST["sizes"]  	= trim(implode("|", $this->POST["sizes"]));
		$this->POST["colors"]  	= trim(implode("|", $this->POST["colors"]));
	}

	public function postEditAction(){

	}

	public function customColumnValue($column){

	}

	public function columns(){
		
		$this->setColumns('code', 	     'Code', 	    	array());
		$this->setColumns('name',	     'Name', 	 		array());
		$this->setColumns('category',    'Category', 		array());
		$this->setColumns('tags', 	  	 'Tags', 	  		array());
		$this->setColumns('sizes', 		 'Size Available', 	array("format" => "(REPLACE(sizes, '|', ', '))"));
		$this->setColumns('tags', 	  	 'Tags', 	  		array());		
		$this->setColumns('description', 'Description', 	array());
	}

	public function fields(){

		$this->getProductCategories();

		$this->getProductTags();

		$this->set("input",      "code", 	    "Code", 	   array(), 				  array("required"));  
		$this->set("input",      "name", 	    "Name", 	   array(), 				  array("required"));		
		$this->set("multiple",   "category",    "Categories",  $this->product_categories, array("required"));		
		$this->set("multiple",   "tags", 	    "Tags", 	   $this->product_tags, 	  array("required"));
		$this->set("multiple",   "colors", 	    "Colors", 	   $this->product_colors, 	  array("required"));
		$this->set("multiple",   "sizes", 	    "Sizes", 	   $this->clothe_sizes, 	  array("required"));
		$this->set("textarea",   "description", "Description", array(), 				  array());

		// $upload_options = array();
		
		// if($this->action == "edit"){
						
		// 	$images 		 = array();
		// 	$attached_images = $this->CoreModel->getRecords("files", "file_path", array(
		// 		"module_name"  => $this->module,
		// 		"reference_id" => $_GET["id"]
		// 	));		

		// 	foreach($attached_images as $_images){
		// 		array_push($images, $_images["file_path"]);
		// 	}

		// 	$upload_options["selected"] = $images;
		// }

		// $this->set("fileupload", "product_images_id",   "Product Images",   array(), $upload_options);

	}

	private function uploadProductImages(){

		$upload_error_result = TRUE;
		$files_to_upload 	 = $_FILES["product_images_id"];

		//attempt to upload the files
		foreach($files_to_upload["tmp_name"] as $index => $tmp_file){

			$file 	   = $files_to_upload["tmp_name"][$index];
			$file_name = $files_to_upload["name"][$index];

			//no error while submitting the files
			if(intval($files_to_upload["error"][$index] == 0)){

				$file_type = explode("/", $files_to_upload["type"][$index])[1];
				$file_size = $files_to_upload["size"][$index];
	
				$this->fileuploader->raw_file_name 	  = $file_name;
				$this->fileuploader->file 			  = $file;
				$this->fileuploader->target_file_size = $file_size;
				$this->fileuploader->target_file_type = $file_type; 
				$this->fileuploader->upload_path 	  = $this->product_upload_path;

				//the filename of the file that will be used by the tmp file
				$this->fileuploader->target_file 	  = $this->fileuploader->upload_path .  $_POST["product_code"] . "_". md5($this->fileuploader->target_file)."-".date("Y-m-d") . "." .  $this->fileuploader->target_file_type;

				if(!$this->fileuploader->doUpload()){

					$upload_error_result 		 = $this->fileuploader->getError();
					$upload_error_result["name"] = $file_name;
					$upload_error_result["size"] = $file_size;
					$upload_error_result["type"] = $file_type;

					break;			
				}

				$this->uploaded_files[] = $this->fileuploader->target_file;

			}else{

				$upload_error_result = array(
					"error" => 1,
					"name"  => $file_name,
					"size"  => 0,
					"type"  => "",
					"msg" 	=> "Failed to upload file : " . $file_name
				);

				break;
			}
		}

		return $upload_error_result;
	}

	private function getProductCategories(){
		
		$result 	= array();
		$categories = $this->product_model->getProductCategories("category_id, name");

		foreach($categories as $category){

			$result[$category["name"]] = $category["category_id"];
		}

		$this->product_categories = $result;
	}

	private function getProductTags(){

		$result = array();
		$tags 	= $this->product_model->getProductTags("tag_id, name");

		foreach($tags as $tag){

			$result[$tag["name"]] = $tag["tag_id"];
		}

		$this->product_tags = $result;
	}
}
