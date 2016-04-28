<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('User');

		$this->load->library("form_validation");
		$this->load->helper('form');
	}

	public function index()
	{
    $this->load->view('index');
	}

	// Register user, validation is done with Boostrap on client side
	public function store_user_register(){
		$info = $this->input->post();
		$user_id = $this->User->store_user_register($info);
		$this->session->set_userdata('user_id', $user_id);
		redirect(base_url().'login/get_user');
	}

	//Grab user info and redirect to log in  
	public function get_user(){
    	$user = $this->User->get_user($this->session->userdata['user_id']);
		$this->session->set_flashdata('success_register',"You were successfully registered, login to continue <i class='fa fa-flag-checkered' aria-hidden='true'></i>");
    	$data = array('user'=> $user);
		redirect(base_url().'');
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect(base_url().'');
	}

	public function store_user_login(){
		$email = $this->session->userdata('user_email');

		$user = $this->User->store_user_login($email);

		$this->session->set_userdata('user_id',$user['user_id']);
		$this->session->set_userdata('user_name',$user['user_name']);
		redirect(base_url().'/Main');
	}

	public function validate_user($email, $password){
		$user = $this->User->store_user_login($email);
		$response = '';

		if($user && $user['password'] == md5($password)){
			$this->session->set_userdata('user_id', $user['user_id']);
			$this->session->set_userdata('user_name', $user['user_name']);
			$this->session->set_userdata('user_email', $email);
			$response = "User and email correct";		
		}else {
			$response =  "Incorrect login";
		}
		echo $response;
	}



public function logged($name){
	$this->session->set_userdata('city_name',$name);
	if($this->session->userdata('user_id')){
		//$this->User->insertCityByName($name,$this->session->userdata('user_id'));
		$this->load->view('newevent');
	} else {
		$this->session->set_flashdata('loggedFail','<script type="text/javascript">alert("Must be logged in to plan a trip!");</script>');
		redirect(base_url().'');
	}
}

	// public function plan_trip($city){
	// 	$this->load->view('newevent');
	// }
}

//end of main controller
