<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // When encountering No Access Control Origin issues
        //$this->load->library('PHPRequests');
        $this->load->model('user');
    }
    public function index() // must be logged in to see trips!!
    {
        if($this->session->userdata('user_id')){

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

            $usernames = $this->user->getUsersByUsername($this->session->userdata('user_id'));

            $data = array('triplist'=> $trip, 'friendTripList'=> $friendTrip, 'usernames' => $usernames);

            //var_dump($data);
            $this->load->view('trip',$data);
        } else{
            $this->session->set_flashdata('login', 'You must be logged in to view the Trips page!');
            redirect(base_url());
        }

    //   var_dump($this->session->userdata('userAirport'));


      //var_dump($data);
    //   $this->load->view('trip',$data);
    }

    public function create_trip(){
      $info = $this->input->post();
      $this->user->create_trip($this->session->userdata('city_name'),$info);
      redirect(base_url().'trip');
    }

    public function getTripByid($trip_id){
      $this->session->set_userdata('display_trip_id', $trip_id);
      $trip = $this->user->get_trip($this->session->userdata('user_id'));
      $info = $this->user->getTripByid($trip_id);
      $friendTrip = $this->user->friend_trip($this->session->userdata('user_id'));
      $friends = $this->user->add_friend($this->session->userdata('user_id'),$this->session->userdata('display_trip_id'));
      $this->session->set_userdata('friends', $friends);


      $userAir = $this->getAirport($this->session->userdata('userCity'));
      $this->session->set_userdata('userAirport', $userAir);

      $splitCity = preg_split('/(?=[A-Z])/',$info[0]['city_name']);
      $newCity = '';
      for($i=1; $i < count($splitCity); $i++){
          $newCity .= $splitCity[$i];
          $newCity .= '+';
      }
      $destinationCity = substr($newCity, 0, strlen($newCity)-1);

    //   var_dump($destinationCity);

      $finalDestinationCity = $this->getAirport($destinationCity);

      $this->session->set_userdata('destinationAirport', $finalDestinationCity);

    //   var_dump($this->session->userdata('destinationAirport'));

      $usernames = $this->user->getUsersByUsername($this->session->userdata('user_id'));
      //var_dump($info);
      $data = array('tripinfo'=>$info,'triplist'=> $trip,'friendTripList'=> $friendTrip, 'usernames' => $usernames);
      $this->load->view('trip',$data);

    }


    public function add_friendToTrip(){
      $info = $this->input->post('friend_select');
      //var_dump($info);
     $this->user->add_friendToTrip($info,$this->session->userdata('display_trip_id'));

     //Twilio Sending Message grabs
     $friendNumber = $this->user->getPhoneByUserId($info);
     $trip = $this->user->getTripNameByTripId($this->session->userdata('display_trip_id'));
    //  var_dump($this->session->userdata('display_trip_id'));
     $this->sendMessageForTrip($friendNumber, $trip);

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



    public function getAirport($city)
    {
        // var_dump($city);
        $html = @file_get_contents('http://www.travelmath.com/nearest-airport/' . $city);

        // var_dump($html);

        $test = explode("International airports near", $html);
        // var_dump($test);
        $test3 = explode('"domestic-distance"', $test[1]);
        // var_dump($test3);
        $test4 = explode('(', $test3[0]);	// Explodes until $test4 is just array of things after an '('
        // var_dump($test);

        for($i = 0; $i < count($test4); $i++)
        {
        		$testStr = $test4[$i][0] . $test4[$i][1] . $test4[$i][2];	// Check first 3 letters
        		if(ctype_upper($testStr))
        		{
        			// Grab biggest airport
        			break;
        		}
        }

        return $testStr;
    }


}

//end of main controller
