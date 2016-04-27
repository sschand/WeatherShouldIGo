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
		// redirect(base_url().'/login/get_user');
		// }
		echo $user_id;
		echo "USER REGISTERED";
		die();
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
				$this->session->set_userdata('user_name',$user['user_name']);


				redirect(base_url().'/Main');

			 }
			 else {
				 $this->session->set_flashdata('match','<div class="match">Email and Password do not match!</div>');
				 redirect(base_url().'');
			 }

	}

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


}

//end of main controller
