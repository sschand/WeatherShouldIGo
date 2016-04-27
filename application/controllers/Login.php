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

	public function store_user_register(){
		if($this->input->post('action') && $this->input->post('action') == "register"){

			$this->load->library("form_validation");
			$this->form_validation->set_rules("name", "Name", "trim|required");
			$this->form_validation->set_rules("username", "username", "trim|required");
			$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("password", "Password", "required|min_length[8]|matches[confirm_password]");
			$this->form_validation->set_rules("confirm_password", "Password Confirmation", "required");
			$this->form_validation->set_rules("dob", "Date of birth", "trim|required");

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('index');
		}
		else
		{
			$info = $this->input->post();

	    $this->User->store_user_register($info);
	    $this->session->set_userdata('email', $this->input->post('email'));
			redirect(base_url().'/login/get_user');
		}
	  }
	}

	public function get_user(){
    $user = $this->User->get_user($this->session->userdata['email']);
		$this->session->set_flashdata('success_register',"You were successfully registered, login to continue <i class='fa fa-flag-checkered' aria-hidden='true'></i>");
    $data = array('user'=> $user);
		redirect(base_url().'');
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect(base_url().'');
	}

	public function store_user_login(){
		if($this->input->post('action') && $this->input->post('action') == "login"){
			$this->form_validation->set_rules("email_login", "Email", "required|valid_email");
			$this->form_validation->set_rules("password_login", "Password", "required");

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('index');
		}
		else
		{
		 $email = $this->input->post('email_login')	;
		 $password = md5($this->input->post('password_login'));
		 $user = $this->User->store_user_login($email);

			 if($user && md5($user['password']) == $password){

        $this->session->set_userdata('user_id',$user['user_id']);
				//$this->session->set_userdata('alias',$user['alias']);

				redirect(base_url().'/Main/mytrip');

			 }
			 else {
				 $this->session->set_flashdata('match','<div class="match">Email and Password do not match!</div>');
				 redirect(base_url().'');
			 }

	}
}
}


}

//end of main controller
