<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SYS_ErrorController extends CI_Controller{

	public function __construct(){

		parent::__construct();
	}

	public function resetErrorMsg(){

		$this->post_result_error = 0;

		$this->post_error_msg    = "";
	}

	public function setPostErrorMsg($msg){

		$this->post_result_error = 1;

		$this->post_error_msg 	 = $msg;
	}

	

}