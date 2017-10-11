<?php

/*
 * Author: Group 14
 * Date: 4/6/2017
 * File: database,class.php
 * Description: Description: the Database class sets the database details.
 * 
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'guitar_drum_db',
        'tblGuitar' => 'guitar',
        'tblDrum' => 'drum',
        'tblUser' => 'users',
        'tblGuitarType' => 'guitar_types',
        'tblDrumType' => 'drum_types',
        'tblUsers' => 'users',
        'tblRoles' => 'user_roles'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
         
        try {
        $this->objDBConnection = @new mysqli(
                        $this->param['host'],
                        $this->param['login'],
                        $this->param['password'],
                        $this->param['database']
        );
            //if the connection failed, runs the DatabaseException.
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting to database failed: " . mysqli_connect_error();
//            exit();
            include 'error.php';
            throw new DatabaseException($message);
        }
        //catches the DatabaseException
        } catch(DatabaseException $db) {
            
            //runs a new error instance and runs the display method.
            $error = new Error();
            $error->display($db->getMessage());
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores movies
    public function getGuitarTable() {
        return $this->param['tblGuitar'];
    }

    //returns the name of the table that stores books
    public function getDrumTable() {
        return $this->param['tblDrum'];
    }

    //returns the name of the table storing cds
    public function getUserTable() {
        return $this->param['tblUser'];
    }

    //returns the name of the table storing movie ratings
    public function getGuitarTypeTable() {
        return $this->param['tblGuitarType'];
    }

    //return the name of the table that stores book categories
    public function getDrumTypeTable() {
        return $this->param['tblDrumType'];
    }

    //return the name of the table that stores users
    public function getUsersTable() {
        return $this->param['tblUsers'];
    }

    //returns the name of the table that stores the user roles.
    public function getRolesTable() {
        return $this->param['tblRoles'];
    }

}
