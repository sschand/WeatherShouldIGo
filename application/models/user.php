<?php

class User extends CI_Model {

    function store_user_register($info){
        $query = "INSERT INTO users (name, user_name, email, password, dob, phone, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
        $values = array($info["name"], $info['user_name'], $info['email'], md5($info['password']), $info['dob'],$info['phone'], date('Y-m-d, H:i:s'), date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);
        return $this->db->insert_id();
    }

      function get_user($user_id){
        $query = "SELECT * FROM users WHERE user_id= ?";
        $values=array($user_id);
        return $this->db->query($query,$values)->row_array();
      }

      function store_user_login($email){
        $query = "SELECT * FROM users WHERE email= ?";
        $values = array($email);
        return $this->db->query($query,$values)->row_array();
      }

      function create_trip($city_name,$user_id,$info){
        $query = "INSERT INTO trips (city_name,description,start_date,created_at) VALUES (?,?,?,?)";
        $values = array($city_name,$info['description'],$info['start_date'],date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);

        $query1 ="SELECT trip_id FROM trips ORDER BY trip_id DESC";
        $trip_id = $this->db->query($query1)->row_array();

        $query2 ="INSERT INTO trips_users (trip_id,user_id) VALUES(?,?)";
        $values2 =array($trip_id['trip_id'],$user_id);
        $this->db->query($query2,$values2);

      }

      function get_trip($id){
        $query ="SELECT trips.city_name,trips.trip_id FROM trips_users JOIN trips ON trips.trip_id = trips_users.trip_id
        WHERE user_id=?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
      }

      function friend_trip($id){
        $query ="SELECT trips.city_name, trips.trip_id FROM trips_users JOIN trips ON trips.trip_id = trips_users.trip_id
        WHERE user_id != ?
        GROUP BY trips.trip_id";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
      }

      function getTripByid($trip_id){
        $query = "SELECT users.user_name,trips.city_name,trips.description,trips.start_date,users.user_id FROM users JOIN trips_users ON users.user_id = trips_users.user_id
                  JOIN trips ON trips.trip_id = trips_users.trip_id
                  WHERE trips_users.trip_id=?";
        $values = array($trip_id);
        return $this->db->query($query,$values)->result_array();
      }

      function add_friend($id,$trip_id){
        $query ="SELECT users.user_name, users.user_id FROM friends
		    JOIN users ON friends.user_id = users.user_id
        WHERE friends.friend_id = ? AND
		    users.user_name NOT IN (SELECT users.user_name FROM friends
        JOIN users ON friends.user_id = users.user_id
        JOIN trips_users ON trips_users.user_id = users.user_id
        WHERE trips_users.trip_id = ?)
        group by users.user_name
        ";
        $values = array($id,$trip_id);
        return $this->db->query($query,$values)->result_array();
      }

      function add_friendToTrip($id,$trip_id){
        $query = "INSERT INTO trips_users (user_id,trip_id) VALUES (?,?)";
        $values = array($id, $trip_id);
        $this->db->query($query,$values);
      }


      function get_user_id($info){
        $query = "SELECT user_id FROM users WHERE users.user_name = ?";
        $values = array($info);
        return $this->db->query($query,$values)->row_array();

      }

      function add_friend_to_list($user_id,$friend_id){
        $query="INSERT INTO friends (user_id,friend_id) VALUES (?,?)";
        $values=array($user_id,$friend_id);
        $this->db->query($query,$values);

        $values1 = array($friend_id,$user_id);
        $this->db->query($query,$values1);
      }

      function remove_friend($user_id){
        $query = "DELETE FROM trips_users WHERE user_id = ? ";
        $values = array($user_id);
        $this->db->query($query,$values);

      }

      function get_people($trip_id){
        $query = "SELECT * FROM trips_users WHERE trip_id = ?";
        $value = array($trip_id);
        return $this->db->query($query, $value)->result_array();
      }

      function getPhoneByUserId($userId) {
          $query = "SELECT users.phone FROM users WHERE users.user_id = ?";
          $input = array($userId);

          return $this->db->query($query, $input)->result_array();
      }
      function getTripNameByTripId($tripId) {
        $query = "SELECT city_name, start_date, description FROM trips_users JOIN trips
                    ON trips_users.trip_id = trips.trip_id WHERE trips.trip_id = 2
                    GROUP BY trips.trip_id";

        $input = array($tripId);

        return $this->db->query($query, $input)->row_array();
      }




   }





?>
