<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PositionModel extends CI_Model{

    public function __construct(){

        parent::__construct();
    }

    public function isCodeExists($code){
        return $this->db->select("position_code")->from("positions")->where("position_code", $code)->get()->num_rows();
    }

    public function isPositionNameExists($name){
        return $this->db->select("position_name")->from("positions")->where("position_name", $name)->get()->num_rows();
    }    

    public function getPositions($filter = array()){

        return $this->db->select("position_id, position_code, position_name")->from("positions")->where($filter)->get()->result_array();
    }
}



