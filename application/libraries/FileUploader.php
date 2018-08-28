<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUploader{

	private $error_msg 		 = "";

	public $file 			 = NULL;
	public $target_file   	 = "";
	public $target_file_size = 0;
	public $target_file_type = 0;
	public $upload_path   	 = "";
	public $max_file_size 	 = 9000000; //900kb
	public $raw_file_name 	 = "";

	public function getError(){
		return array("error" => 1, "msg" => $this->error_msg);
	}

	public function doUpload(){

		//if not the file is not yet uploaded
		if(!$this->isFileExists()){

			//if file size if valid
			if($this->isValidFileSize()){

				//if file is in valid type
				if($this->isValidFileType()){

					if(move_uploaded_file($this->file, $this->target_file)){
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}
		}

		return FALSE;
	}

	private function isFileExists(){

		if(file_exists($this->target_file)){

			$this->error_msg = "File ".$this->raw_file_name." already exists ";

			return TRUE;
		}
		return FALSE;
	}

	private function isValidFileSize(){

		if($this->target_file_size > $this->max_file_size){

			$this->error_msg = "File ".$this->raw_file_name." (".$this->target_file_size.") is too large ";

			return FALSE;
		}
		return TRUE;
	}

	private function isValidFileType(){

		if($this->target_file_type == ""){

			$this->error_msg = "File ".$this->raw_file_name." is not in valid format";

			return FALSE;
		}

		if($this->target_file_type != "jpg" && $this->target_file_type != "png" && $this->target_file_type != "jpeg"){

			$this->error_msg = "File ".$this->raw_file_name." is not in valid format";

			return FALSE;			
		}

		return TRUE;
	}
}