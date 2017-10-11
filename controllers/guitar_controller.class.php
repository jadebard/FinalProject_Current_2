<?php

/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * File: guitar_controller.class.php
 * Description: the guitar controller
 *
 */

class GuitarController {

    private $guitar_model;

    //default constructor
    public function __construct() {
        //create an instance of the GuitarModel class
        $this->guitar_model = GuitarModel::getGuitarModel();
    }

    //index action that displays all guitars
    public function index() {
        //retrieve all guitars and store them in an array
        $guitars = $this->guitar_model->list_guitar();

        if (!$guitars) {
            //display an error
            $message = "There was a problem displaying guitars.";
            $this->error($message);
            return;
        }

        // display all guitars
        $view = new GuitarIndex();
        $view->display($guitars);
    }

    //show details of a guitar
    public function detail($id) {
        //retrieve the specific guitar
        $guitar = $this->guitar_model->view_guitar($id);

        if (!$guitar) {
            //display an error
            $message = "There was a problem displaying the guitar id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display guitar details
        $view = new GuitarDetail();
        $view->display($guitar);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new GuitarError();

        //display the error page
        $error->display($message);
    }

        //search guitars
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all guitars
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching guitars
        $guitars = $this->guitar_model->search_guitar($query_terms);

        if ($guitars === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched guitars
        $search = new GuitarSearch();
        $search->display($query_terms, $guitars);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $guitars = $this->guitar_model->search_guitar($query_terms);

        //retrieve all guitar names and store them in an array
        $names = array();
        if ($guitars) {
            foreach ($guitars as $guitar) {
                $names[] = $guitar->getGuitarName();
            }
        }
        echo json_encode($names);
    }
    
    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }
    
    public function edit($id) {
        //retrieve the specific guitar
        $guitar = $this->guitar_model->view_guitar($id);
 
        if (!$guitar) {
            //display an error
            $message = "There was a problem displaying the guitar id='" . $id . "'.";
            $this->error($message);
            return;
        }
 
        $view = new GuitarEdit();
        $view->display($guitar);
    }
    
     //update a guitar in the database
    public function update($id) {
        //update the guitar
        $update = $this->guitar_model->update_guitar($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the guitar id='" . $id . "'.";
            $this->error($message);
            return;
        }

 
        //display the updated guitar details
        $confirm = "The guitar was successfully updated.";
        $guitar = $this->guitar_model->view_guitar($id);
 
        $view = new GuitarDetail();
        $view->display($guitar, $confirm);
    }
    
    //directs admin to the add form
    public function addForm() {
        $view = new GuitarAdd();
        $view->display();
    }
    
    //add function that sanitizes input, handles exceptions, then runs the add_guitar in the GuitarModel
    public function add() {
        //post data from the form
        $guitar_name = filter_input(INPUT_POST, 'guitar_name', FILTER_SANITIZE_STRING);
        $guitar_type = filter_input(INPUT_POST, 'guitar_type', FILTER_SANITIZE_NUMBER_INT);
        $youtube_link = filter_input(INPUT_POST, 'youtube_link', FILTER_SANITIZE_URL);
        $guitar_image = filter_input(INPUT_POST, 'guitar_image', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        
        //exception handling
        try{
            if (!Utilities::checkurl($youtube_link)) {
                throw new UrlException();
            }
            
            if (!Utilities::checkNum($price)) {
                throw new NumberException();
            }
            
            if ($guitar_name == "" || $youtube_link == "" || $guitar_image == "" || $price == "" || $description == "") {
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
        
        //new guitar object
        $guitar = new Guitar($guitar_image, $guitar_name, $guitar_type , $description, $youtube_link, $price);
        
        $this->guitar_model->add_guitar($guitar);
        
        //confirmation pagee
        $view = new ConfirmGuitar();
        $view->display();
    }
    
    //deletes a guitar with the id of the current guitar
    public function delete($id) {
        $this->guitar_model->delete_guitar($id);
        
        $view = new GuitarDelete();
        $view->display();
    }

}