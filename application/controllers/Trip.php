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
      $friendTrip = $this->User->friend_trip($this->session->userdata('user_id'));
      $trip = $this->User->get_trip($this->session->userdata('user_id'));
      $data = array('triplist'=> $trip, 'friendTripList'=> $friendTrip);
      //var_dump($data);
      $this->load->view('trip',$data);
    }

    public function create_trip(){
      $info = $this->input->post();
      $this->User->create_trip($this->session->userdata('city_name'),$this->session->userdata('user_id'),$info);
      redirect(base_url().'trip');
    }

    public function getTripByid($trip_id){
      $this->session->set_userdata('display_trip_id', $trip_id);
      $trip = $this->User->get_trip($this->session->userdata('user_id'));
      $info = $this->User->getTripByid($trip_id);
      $friendTrip = $this->User->friend_trip($this->session->userdata('user_id'));

      //var_dump($info);
      $data = array('tripinfo'=>$info,'triplist'=> $trip,'friendTripList'=> $friendTrip);
      $this->load->view('trip',$data);

    }

    public function add_friend(){
      $friends = $this->User->add_friend($this->session->userdata('user_id'),$this->session->userdata('display_trip_id'));
      $this->session->set_userdata('friends', $friends);
      redirect(base_url().'Trip/getTripByid/'.$this->session->userdata('display_trip_id'));
    }

}

//end of main controller
