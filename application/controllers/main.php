<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // When encountering No Access Control Origin issues
        $this->load->library('PHPRequests');
        $this->session->set_userdata('mapLoaded', false);
    }
    public function index()
    {
      $this->session->unset_userdata('display_trip_id');
        // $this->session->unset_userdata('friends');
        $this->load->view('index');
    }
    public function map()
    {
        $this->load->view('map');
    }


    public function mytrip(){
      // $userTrip = $this->Trip->getmytrip($this->session->userdata('id'));
      // $data = array('userdata'=>$userTrip);
      $this->load->view('trip');
    }

    public function sms() {
        $this->load->view('twilio');
    }

}

//end of main controller
