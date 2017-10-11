<?php

/*
 * Author: Jacob DeBard
 * Date: 4/24/2017
 * File: user_controller.class.php
 * Description: the user controller
 *
 */

class UserController {
    private $user_model;
    
    public function __construct() {
        $this->user_model = UserModel::getUserModel();
    }
    
    public function loginRequest() {

        $username = $password = "";

        //retrieve user name and password from the form in the login form
        if (filter_has_var(INPUT_POST, 'username') || filter_has_var(INPUT_POST, 'password')) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        }
        
        //runs the user_request function in the UserModel
        $request = $this->user_model->user_request($username, $password);
        
        if (!$request) {
            $message = "Username or password may be incorrect";
            $this->error($message);
            return;
        }
        
        //goes to confimation page
        $view = new ConfirmLogin();
        $view->display();
    }
    
    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new UserError();

        //display the error page
        $error->display($message);
    }
    
    //logout function
    public function logout() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        
        //empties the SESSION
        $_SESSION = array();

        setcookie(session_name(), "", time() - 3600);

        session_destroy();
        
        //confirms the logout
        $view = new ConfirmLogout();
        $view->display();
    }
}