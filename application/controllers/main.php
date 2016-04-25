<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// When encountering No Access Control Origin issues
	    $this->load->library('PHPRequests');
	}	
	public function index()
	{
		$this->load->view('index');	
	}
	public function get_pics()
	{
	    $this->load->library('PHPRequests');

	    $location = str_replace(" ", "", $this->input->post('city'));

	    $weather = trim($this->input->post('weather'));

		$url = "https://api.instagram.com/v1/tags/".$location.$weather."/media/recent?callback=?&count=10&access_token=2205178294.324cf62.a569c4db3a394908bfa806cfafae2397"; 

	    $html = file_get_contents($url);
		
		$this->output
  			 ->set_content_type('application/json')
	         ->set_output($html);	
	}
}

//end of main controller