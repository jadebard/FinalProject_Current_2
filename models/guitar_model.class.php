<?php

/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * File: guitar_model.class.php
 * Description: the guitar model
 *
 */

class GuitarModel {
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblGuitar;
    private $tblGuitarType;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGuitarModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblGuitar = $this->db->getGuitarTable();
        $this->tblGuitarType = $this->db->getGuitarTypeTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize guitar categories
        if (!isset($_SESSION['guitar_types'])) {
            $guitar_types = $this->get_guitar_types();
            $_SESSION['guitar_types'] = $guitar_types;
        }
    }

    //static method to ensure there is just one GuitarModel instance
    public static function getGuitarModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new GuitarModel();
        }
        return self::$_instance;
    }

    /*
     * the list_guitar method retrieves all guitars from the database and
     * returns an array of Guitar objects if successful or false if failed.
     * Guitars should also be filtered by type and/or sorted by name or type if they are available.
     */

    public function list_guitar() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT
                ". $this->tblGuitar.".guitar_id,
                ". $this->tblGuitar.".guitar_image,
                ". $this->tblGuitar.".guitar_name,
                ". $this->tblGuitarType.".type,
                ". $this->tblGuitar.".description,
                ". $this->tblGuitar.".youtube_link,
                ". $this->tblGuitar.".price
                FROM " . $this->tblGuitar . "," . $this->tblGuitarType .
            " WHERE " . $this->tblGuitar . ".guitar_type=" . $this->tblGuitarType . ".type_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no guitar was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned guitars
        $guitars = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $guitar = new Guitar(stripslashes($obj->guitar_image), stripslashes($obj->guitar_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));

            //set the id for the guitar
            $guitar->setGuitarId($obj->guitar_id);

            //add the guitar into the array
            $guitars[] = $guitar;
        }
        return $guitars;
    }

    /*
     * the viewBook method retrieves the details of the book specified by its id
     * and returns a book object. Return false if failed.
     */

    public function view_guitar($id) {
        //the select sql statement
        $sql = "SELECT
                ". $this->tblGuitar.".guitar_id,
                ". $this->tblGuitar.".guitar_image,
                ". $this->tblGuitar.".guitar_name,
                ". $this->tblGuitarType.".type,
                ". $this->tblGuitar.".description,
                ". $this->tblGuitar.".youtube_link,
                ". $this->tblGuitar.".price
                FROM " . $this->tblGuitar . "," . $this->tblGuitarType .
            " WHERE " . $this->tblGuitar . ".guitar_type=" . $this->tblGuitarType . ".type_id" .
            " AND " . $this->tblGuitar . ".guitar_id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a guitar object
            $guitar = new Guitar(stripslashes($obj->guitar_image), stripslashes($obj->guitar_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));

            //set the id for the guitar
            $guitar->setGuitarId($obj->guitar_id);
            return $guitar;

        }

        return false;
    }

        public function search_guitar($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT
                ". $this->tblGuitar.".guitar_id,
                ". $this->tblGuitar.".guitar_image,
                ". $this->tblGuitar.".guitar_name,
                ". $this->tblGuitarType.".type,
                ". $this->tblGuitar.".description,
                ". $this->tblGuitar.".youtube_link,
                ". $this->tblGuitar.".price
                FROM " . $this->tblGuitar . "," . $this->tblGuitarType .
            " WHERE " . $this->tblGuitar . ".guitar_type=" . $this->tblGuitarType . ".type_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND  ". $this->tblGuitar.".guitar_name LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no guitar was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 guitar found.
        //create an array to store all the returned guitars
        $guitars = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $guitar = new Guitar(stripslashes($obj->guitar_image), stripslashes($obj->guitar_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));
            //set the id for the guitar
            $guitar->setGuitarId($obj->guitar_id);

            //add the guitar into the array
            $guitars[] = $guitar;
        }
        return $guitars;
    }


    //get all guitar categories
    private function get_guitar_types() {
        $sql = "SELECT * FROM " . $this->tblGuitarType;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $types = array();
        while ($obj = $query->fetch_object()) {
            $types[$obj->type] = $obj->type_id;
        }
        return $types;
    }
    
    public function update_guitar($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'guitar_name') ||
                !filter_has_var(INPUT_POST, 'guitar_type') ||
                !filter_has_var(INPUT_POST, 'youtube_link') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'guitar_image') ||
                !filter_has_var(INPUT_POST, 'description')) {
 
            return false;
        }
 
        //retrieve data for the new guitar; data are sanitized and escaped for security.
        $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'guitar_name', FILTER_SANITIZE_STRING)));
        $type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'guitar_type', FILTER_SANITIZE_NUMBER_INT)));
        $youtube = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'youtube_link', FILTER_DEFAULT));
        $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'guitar_image', FILTER_DEFAULT)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));
        
        //exception handling
        try{
            if (!Utilities::checkurl($youtube)) {
                throw new UrlException();
            }
            
            if (!Utilities::checkNum($price)) {
                throw new NumberException();
            }
            
            if ($name == "" || $youtube == "" || $image == "" || $price == "" || $description == "") {
                throw new DataMissingException("Please fill out all fields in the form.");
            }
        } catch (UrlException $u) {
            $message = $u->getDetails();
            
            $error = new GuitarError();
            $error->display($message);
            exit();
        } catch (NumberException $n) {
            $message = $n->getDetails();
            
            $error = new GuitarError();
            $error->display($message);
            exit();
        } catch (DataMissingException $d) {
            $message = $d->getMessage();
            
            $error = new GuitarError();
            $error->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            
            $error = new GuitarError();
            $error->display($message);
            exit();
        }
 
        //query string for update
        $sql = "UPDATE " . $this->tblGuitar .
                " SET guitar_image='$image', guitar_name='$name', guitar_type='$type', description='$description', "
                . "youtube_link='$youtube', price='$price' WHERE guitar_id='$id'";
 
        //execute the query
        return $this->dbConnection->query($sql);
    }
    
    public function add_guitar($guitar) {
        
        //sql statement to be sent to the database
        $sql = "INSERT INTO " . $this->tblGuitar . " "
                . "(guitar_id, guitar_image, guitar_name, guitar_type, description, youtube_link, price)"
                . " VALUES (NULL, '" . $guitar->getGuitarImage() . "',
               '". $guitar->getGuitarName() . "',
                '". $guitar->getGuitarType() . "',
                '". $guitar->getDescription() . "',
                '". $guitar->getYoutubeLink() . "',
                '". $guitar->getPrice() . "')";
        
        //execute the query
        $this->dbConnection->query($sql);
        
        return;
    }
    
    public function delete_guitar($id) {
        $sql = "DELETE FROM " . $this->tblGuitar . 
                " WHERE guitar_id ='$id'";
        
        $this->dbConnection->query($sql);
        
        return;
    }

}