<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller{

	public function __construct(){

		parent::__construct();
	}

	public function login(){

		$this->load->view('login');
	}

	public function ProcessLogin(){

		header("Location: " . base_url() ."home");
	}
}
