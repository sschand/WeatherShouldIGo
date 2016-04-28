<?php

class User extends CI_Model {

    function store_user_register($info){
        $query = "INSERT INTO users (name, user_name, email, password, dob, phone, created_at, updated_at) VALUES(?,?,?,?,?,?,?)";
        $values = array($info["name"], $info['user_name'], $info['email'], md5($info['password']), $info['phone'], $info['dob'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
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
        $query = "INSERT INTO trips (user_id,city_name,description,start_date,created_at) VALUES (?,?,?,?,?)";
        $values = array($user_id,$city_name,$info['description'],$info['start_date'],date("Y-m-d, H:i:s"));
        return $this->db->query($query,$values);
      }

      function get_trip($id){
        $query ="SELECT * FROM trips WHERE user_id=?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();

      }

      function getTripByid($trip_id){
        $query = "SELECT * FROM trips JOIN users ON trips.user_id=users.user_id WHERE trips.trip_id=? AND users.user_id != ? ";
        $values = array($trip_id,$user_id);
        return $this->db->query($query,$values)->result_array();
      }



   }





?>
