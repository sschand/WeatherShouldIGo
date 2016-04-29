<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // When encountering No Access Control Origin issues
        //$this->load->library('PHPRequests');
        $this->load->model('user');
    }
    public function index()
    {
      $trip = $this->user->get_trip($this->session->userdata('user_id'));
      $friendTrip = $this->user->friend_trip($this->session->userdata('user_id'));
      for($i=0;$i < count($friendTrip); $i++)
      {
        $peopleCount = $this->user->get_people($friendTrip[$i]['trip_id']);
        $cityID = $friendTrip[$i]['trip_id'];
        $this->session->set_userdata($cityID, $peopleCount);
      }

      $friends = $this->user->add_friend($this->session->userdata('user_id'),$this->session->userdata('display_trip_id'));
      $this->session->set_userdata('friends', $friends);

      $trip = $this->user->get_trip($this->session->userdata('user_id'));
      $data = array('triplist'=> $trip, 'friendTripList'=> $friendTrip);

      //var_dump($data);
      $this->load->view('trip',$data);
    }

    public function create_trip(){
      $info = $this->input->post();
      $this->user->create_trip($this->session->userdata('city_name'),$this->session->userdata('user_id'),$info);
      redirect(base_url().'trip');
    }

    public function getTripByid($trip_id){
      $this->session->set_userdata('display_trip_id', $trip_id);
      $trip = $this->user->get_trip($this->session->userdata('user_id'));
      $info = $this->user->getTripByid($trip_id);
      $friendTrip = $this->user->friend_trip($this->session->userdata('user_id'));
      $friends = $this->user->add_friend($this->session->userdata('user_id'),$this->session->userdata('display_trip_id'));
      $this->session->set_userdata('friends', $friends);

      //var_dump($info);
      $data = array('tripinfo'=>$info,'triplist'=> $trip,'friendTripList'=> $friendTrip);
      $this->load->view('trip',$data);

    }


    public function add_friendToTrip(){
      $info = $this->input->post('friend_select');
      //var_dump($info);
     $this->user->add_friendToTrip($info,$this->session->userdata('display_trip_id'));

     //Twilio Sending Message grabs
     $friendNumber = $this->user->getPhoneByUserId($info);
     $trip = $this->user->getTripNameByTripId($this->session->userdata('display_trip_id'));
     //$this->sendMessageForTrip($friendNumber, $trip);

     $this->session->unset_userdata('friends');

       redirect(base_url().'trip/getTripByid/'.$this->session->userdata('display_trip_id'));
    }
    protected function sendMessageForTrip($phone, $trip) {
        //Requires a file set in assets before you can accomplish everything
        set_include_path(dirname(__FILE__)."/../");
        require('assets/services/Twilio.php');

        //Account based tokens, Don't touch
        $account_sid = 'AC0bf0467f0af56fc24371c76da012e428';
        $auth_token = 'eea66dc4d709d27d2469d6d609af0dbf';

        //Creates new Twilio Service
        $client = new Services_Twilio($account_sid, $auth_token);

        //Sending message area
        $message = $client->account->messages->sendMessage(
            '+14084713857', //Twilio Phone Number (Don't change for now)
            $phone, //Recipient Phone Number
            $trip['description'].'... You have been invited to go to '.$trip['city_name'].' On '.$trip['start_date'].' by '.$this->session->userdata('user_name')     //Message to send in the text
        );
    }

    public function add_friend_to_list(){
      //var_dump($this->input->post('user_name'));
      $info = $this->user->get_user_id($this->input->post('user_name'));

      $this->user->add_friend_to_list($this->session->userdata('user_id'),$info['user_id']);
      $this->session->unset_userdata('display_trip_id');
      redirect(base_url().'trip');
    }

    public function remove_friend($friend_id){
      $this->user->remove_friend($friend_id);
      redirect(base_url().'trip/getTripByid/'.$this->session->userdata('display_trip_id'));
    }

}

//end of main controller
