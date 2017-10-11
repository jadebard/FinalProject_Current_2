<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User {
    //private properties of a Drum object
    private $user_id, $username, $password, $user_fname, $user_lname, $user_email, $user_role;
    
     //the constructor that initializes all properties
    public function __construct($user_id, $username, $password, $user_fname, $user_lname, $user_email, $user_role) {
        $this->username = $username;
        $this->user_fname = $user_fname;
        $this->user_lname = $user_lname;
        $this->user_email = $user_email;
        $this->user_role = $user_role;
    }
    
    //public get methods that set specfic details of the drum
    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function getUserFname() {
        return $this->user_fname;
    }

    public function getUserLname() {
        return $this->user_lname;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function getUserRole() {
        return $this->user_role;
    }

    //sets the user id
    public function setUserId() {
        $this->user_id = $user_id;
    }
}