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

   }





?>
