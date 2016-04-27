<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // When encountering No Access Control Origin issues
        //$this->load->library('PHPRequests');
        $this->load->model('User');
    }
    public function index()
    {
      $info = $this->User->getTripByUser($this->session->userdata('city_name'),$this->session->userdata('user_id'));
      //var_dump($tripInfo);
      $data = array('info' => $info);
      $this->load->view('trip', $data);
    }


}

//end of main controller
