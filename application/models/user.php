<?php

class User extends CI_Model {


     function store_user_register($info){
       $query = "INSERT INTO users (name, user_name, email, password, dob, created_at, updated_at) VALUES(?,?,?,?,?,?,?)";
       $values = array($info["name"], $info['user_name'], $info['email'], $info['password'], $info['dob'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
       return $this->db->query($query,$values);
     }

      function get_user($name){
        $query = "SELECT * FROM users WHERE email= ?";
        $values=array($name);
        return $this->db->query($query,$values)->row_array();
      }

      function store_user_login($email){
        $query = "SELECT * FROM users WHERE email= ?";
        $values = array($email);
        return $this->db->query($query,$values)->row_array();
      }

      function create_trip($city_name,$user_id,$info){
        $query = "INSERT INTO trips (user_id,city_name,description,start_date,created_at) VALUES (?,?,?,?,?)";
        $values = array($user_id,$city_name,$info['description'],$info['start_date'],date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);

        $query1 ="SELECT trip_id FROM trips ORDER_BY trip_id DESC";
        $trip_id = $this->db->query($query)->result_array();

        $query2 ="INSERT INTO trips_users (trip_id,user_id) VALUES(?,?)";
        $values2 =array($trip_id,$user_id);
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
        WHERE user_id != ?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
      }

      function getTripByid($trip_id){
        $query = "SELECT users.user_name,trips.city_name,trips.description,trips.start_date FROM users JOIN trips_users ON users.user_id = trips_users.user_id
                  JOIN trips ON trips.trip_id = trips_users.trip_id
                  WHERE trips_users.trip_id=?";
        $values = array($trip_id);
        return $this->db->query($query,$values)->result_array();
      }

      function add_friend($id,$trip_id){
        $query ="SELECT users.user_name, users.user_id FROM friends
        JOIN users ON friends.user_id = users.user_id
        JOIN trips_users ON trips_users.user_id = users.user_id
        where friends.friend_id=? AND trips_users.trip_id !=?";
        $values = array($id,$trip_id);
        return $this->db->query($query,$values)->result_array();
      }

      // function add_friend($trip_id){
      //   $query ="INSERT INTO "
      // }



   }





?>
