<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model{

    public function __construct(){

        parent::__construct();
    }

    public function isProductTagCodeExists($code){
        return $this->db->select("code")->from("product_tag")->where("code", $code)->get()->num_rows();
    }

    public function isProductTagNameExists($name){
        return $this->db->select("name")->from("product_tag")->where("name", $name)->get()->num_rows();
    }    

    public function getProductTags($columns, $filter = array()){
        return $this->db->select($columns)->from("product_tag")->where($filter)->get()->result_array();
    }

    public function isProductCategoryCodeExists($code){
        return $this->db->select("code")->from("product_category")->where("code", $code)->get()->num_rows();
    }

    public function isProductCategoryNameExists($name){
        return $this->db->select("name")->from("product_category")->where("name", $name)->get()->num_rows();
    }

    public function getProductCategories($columns, $filter = array()){
       return $this->db->select($columns)->from("product_category")->where($filter)->get()->result_array();
    }
}



