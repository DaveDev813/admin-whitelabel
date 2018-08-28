<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FilesModel extends CI_Model{

    public function __construct(){

        parent::__construct();
    }

    public function getImages($module, $reference){

    	$this->db->select("file_path")->from("files")->where(array(
    		"module_name" => $module, "reference_id" => $reference
    	))->get()->result_array();
    }

    public function insertFile(){

    }

    public function insertBatchFiles($batch){

        $this->db->insert_batch('files', $batch);
    }
}



