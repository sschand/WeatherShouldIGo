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
      $trip = $this->User->get_trip($this->session->userdata('user_id'));
      $data = array('triplist'=> $trip);
      //var_dump($data);
      $this->load->view('trip',$data);
    }

    public function create_trip(){
      $info = $this->input->post();
      $this->User->create_trip($this->session->userdata('city_name'),$this->session->userdata('user_id'),$info);
      redirect(base_url().'trip');
    }

    // public function getTripByid($trip_id,$user_id){
    //   $info = $this->User->getTripByid($trip_id,$user_id);
    //   $data = array('tripinfo',$info);
    //   $this->load->view('trip',$data);
    //
    // }

}

//end of main controller
