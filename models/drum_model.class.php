<?php

/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * File: drum_model.class.php
 * Description: the drum model
 *
 */

class DrumModel {
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblDrum;
    private $tblDrumType;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getDrumModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblDrum = $this->db->getDrumTable();
        $this->tblDrumType = $this->db->getDrumTypeTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize drum categories
        if (!isset($_SESSION['drum_types'])) {
            $drum_types = $this->get_drum_types();
            $_SESSION['drum_types'] = $drum_types;
        }
    }

    //static method to ensure there is just one DrumModel instance
    public static function getDrumModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new DrumModel();
        }
        return self::$_instance;
    }

    /*
     * the list_drum method retrieves all drums from the database and
     * returns an array of Drum objects if successful or false if failed.
     * Drums should also be filtered by type and/or sorted by name or type if they are available.
     */

    public function list_drum() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT
                ". $this->tblDrum.".drum_id,
                ". $this->tblDrum.".drum_image,
                ". $this->tblDrum.".drum_name,
                ". $this->tblDrumType.".type,
                ". $this->tblDrum.".description,
                ". $this->tblDrum.".youtube_link,
                ". $this->tblDrum.".price
                FROM " . $this->tblDrum . "," . $this->tblDrumType .
            " WHERE " . $this->tblDrum . ".drum_type=" . $this->tblDrumType . ".type_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no drum was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned drums
        $drums = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $drum = new Drum(stripslashes($obj->drum_image), stripslashes($obj->drum_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));

            //set the id for the drum
            $drum->setDrumId($obj->drum_id);

            //add the drum into the array
            $drums[] = $drum;
        }
        return $drums;
    }

    /*
     * the view_drum method retrieves the details of the drum specified by its id
     * and returns a drum object. Return false if failed.
     */

    public function view_drum($id) {
        //the select sql statement
        $sql = "SELECT
                ". $this->tblDrum.".drum_id,
                ". $this->tblDrum.".drum_image,
                ". $this->tblDrum.".drum_name,
                ". $this->tblDrumType.".type,
                ". $this->tblDrum.".description,
                ". $this->tblDrum.".youtube_link,
                ". $this->tblDrum.".price
                FROM " . $this->tblDrum . "," . $this->tblDrumType .
            " WHERE " . $this->tblDrum . ".drum_type=" . $this->tblDrumType . ".type_id" .
            " AND " . $this->tblDrum . ".drum_id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a drum object
            $drum = new Drum(stripslashes($obj->drum_image), stripslashes($obj->drum_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));

            //set the id for the drum
            $drum->setDrumId($obj->drum_id);
            return $drum;

        }

        return false;
    }
    //search the database for drums that match words in titles. Return an array of drums if succeed; false otherwise.
    public function search_drum($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT
                ". $this->tblDrum.".drum_id,
                ". $this->tblDrum.".drum_image,
                ". $this->tblDrum.".drum_name,
                ". $this->tblDrumType.".type,
                ". $this->tblDrum.".description,
                ". $this->tblDrum.".youtube_link,
                ". $this->tblDrum.".price
                FROM " . $this->tblDrum . "," . $this->tblDrumType .
            " WHERE " . $this->tblDrum . ".drum_type=" . $this->tblDrumType . ".type_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND  ". $this->tblDrum.".drum_name LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no drum was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 drum found.
        //create an array to store all the returned drums
        $drums = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $drum = new Drum(stripslashes($obj->drum_image), stripslashes($obj->drum_name), stripslashes($obj->type) ,  stripslashes($obj->description), stripslashes($obj->youtube_link), stripslashes($obj->price));
            //set the id for the drum
            $drum->setDrumId($obj->drum_id);

            //add the drum into the array
            $drums[] = $drum;
        }
        return $drums;
    }


    //get all drum categories
    private function get_drum_types() {
        $sql = "SELECT * FROM " . $this->tblDrumType;

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
    
    public function update_drum($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'drum_name') ||
                !filter_has_var(INPUT_POST, 'drum_type') ||
                !filter_has_var(INPUT_POST, 'youtube_link') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'drum_image') ||
                !filter_has_var(INPUT_POST, 'description')) {
 
            return false;
        }
 
        //retrieve data for the new drum; data are sanitized and escaped for security.
        $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'drum_name', FILTER_SANITIZE_STRING)));
        $type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'drum_type', FILTER_SANITIZE_NUMBER_INT)));
        $youtube = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'youtube_link', FILTER_DEFAULT));
        $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'drum_image', FILTER_DEFAULT)));
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
            
            $error = new DrumError();
            $error->display($message);
            exit();
        } catch (NumberException $n) {
            $message = $n->getDetails();
            
            $error = new DrumError();
            $error->display($message);
            exit();
        } catch (DataMissingException $d) {
            $message = $d->getMessage();
            
            $error = new DrumError();
            $error->display($message);
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
            
            $error = new DrumError();
            $error->display($message);
            exit();
        }
 
        //query string for update
        $sql = "UPDATE " . $this->tblDrum .
                " SET drum_image='$image', drum_name='$name', drum_type='$type', description='$description', "
                . "youtube_link='$youtube', price='$price' WHERE drum_id='$id'";
 
        //execute the query
        return $this->dbConnection->query($sql);
    }
    
    public function add_drum($drum) {
        
        //sql statement to be sent to the database
        $sql = "INSERT INTO " . $this->tblDrum . " "
                . "(drum_id, drum_image, drum_name, drum_type, description, youtube_link, price)"
                . " VALUES (NULL, '" . $drum->getDrumImage() . "',
               '". $drum->getDrumName() . "',
                '". $drum->getDrumType() . "',
                '". $drum->getDescription() . "',
                '". $drum->getYoutubeLink() . "',
                '". $drum->getPrice() . "')";
        
        //execute the query
        $this->dbConnection->query($sql);
        
        return;
    }
    
    public function delete_drum($id) {
        $sql = "DELETE FROM " . $this->tblDrum . 
                " WHERE drum_id ='$id'";
        
        $this->dbConnection->query($sql);
        
        return;
    }

}