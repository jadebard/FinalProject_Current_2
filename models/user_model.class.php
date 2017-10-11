<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel {
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUsers;
    private $tblRoles;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getUserModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getUserTable();
        $this->tblRoles = $this->db->getRolesTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize user roles
        if (!isset($_SESSION['user_roles'])) {
            $user_roles = $this->get_user_roles();
            $_SESSION['user_roles'] = $user_roles;
        }
    }

    //static method to ensure there is just one UserModel instance
    public static function getUserModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
    
    //get all user roles
    private function get_user_roles() {
        $sql = "SELECT * FROM " . $this->tblRoles;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $roles = array();
        while ($obj = $query->fetch_object()) {
            $types[$obj->role] = $obj->role_id;
        }
        return $roles;
    }
    
    //handles the reequest made to see if the username and password are valid
    public function user_request($username, $password) {

        
       echo $sql = "SELECT * FROM $this->tblUsers WHERE username='$username' AND password='$password'";
        
        //execute the query
        $query = $this->dbConnection->query($sql);
        
                if ($query->num_rows){
            $row = $query->fetch_assoc();
            //start session if it has not already started
            if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            //stores all the user details into session variables
            $_SESSION['login'] = $username;
            $_SESSION['role'] = $row['user_role'];
            $_SESSION['name'] = $row['user_fname'];
            $_SESSION['login_status'] = 1;
        }
       
        if ($_SESSION['login_status'] == 0) {
            $message = "Username or password incorrect. Please Try again.";
            
            $view = new UserError();
            $view->display($message);
            exit();
        }
        
//        header("Location: " . BASE_URL . "/index");
        if (!$query) {
            return false;
        } else {
            return true;
        }
    }    
}