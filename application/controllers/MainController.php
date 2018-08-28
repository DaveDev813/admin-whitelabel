<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function home(){

		if(intval($_SESSION["logged_in"]) === 1){
			$this->load->view('home', array("content" => "home-main"));
		}else{
			header("Location: " . base_url() . "login");
		}
	}

	public function login(){

		$this->load->view('login');
	}

	public function ProcessLogout(){
	
		$this->session->sess_destroy();		

		header("Location: " . base_url());
	}

	public function ProcessLogin(){

		$msg = array();

		if($this->input->server('REQUEST_METHOD') == "POST"){

			$username = $_POST["username"];
			$password = md5($_POST["password"] . "@_r@ND0M_t0k3n");

			$user_info = $this->CoreModel->getRecords("user", "*", array(
				"password" => $password
			));

			if(!empty($user_info)){

				$user_info = $user_info[0];

				$_username = strtolower(trim($user_info["first_name"])) . "." . strtolower(trim($user_info["last_name"]));

				if($_username == $username){

					$this->session->set_userdata(array(
					   'username'    => $_username,
					   'email'       => $user_info["email_address"],
					   'logged_in'   => TRUE,
					   'date_logged' => date("Y-m-d H:i:s"),
					   'sys_token' 	 => md5('@_r@ND0M_t0k3n' . date("Y-m-d H:i:s"))
					));

					header("Location: " . base_url());
				}
			}

			$msg["message"] = "Invalid Username and Password Combination";
		}

		$this->load->view("login", $msg);
	}
}
