<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class CoreModel extends CI_Model{

    public function __construct(){

        parent::__construct();
    }

    public function isTableExists($table){

    	$result = $this->db->query("SHOW TABLES LIKE '%".$table."%'");

    	return $result->num_rows();
    }

    public function getColumns($table){

    	$columns = array();
    	$query 	 = $this->db->query("SHOW COLUMNS FROM " . $table);

		foreach ($query->result() as $row){
        	$columns[] = $row;
		}

		$query->free_result();     	

		return $columns;
    }

    public function countRows($module){

    	$query = $this->db->query('SELECT * FROM ' . $module);

		return $query->num_rows();
    }

    public function getRecordById($module, $id){

		return $this->db->select("*")->from($module)->where("id", $id)->get()->row();
    }

    public function getRecords($module, $columns, $filter, $limit, $offset, $order = array()){

    	$this->db->select($columns);

    	$this->db->from($module);

    	if(!empty($filter)){
	    	$this->db->where($filter);
    	}

		// $this->db->limit($limit, $offset);

		return $this->db->get()->result_array();
    }

    public function insert($module, $values){

    	$this->db->insert($module, $values);

    	return $this->db->insert_id();
    }

    public function update($module, $values, $id){

    	$this->db->where("id", $id);
    	$this->db->replace($module, $values);

    	return $this->db->affected_rows();
    }
}



