<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller{

	public function __construct(){

		parent::__construct();
	}

	public function home(){

		$this->load->view('home', array("content" => "home-main"));
	}
}
