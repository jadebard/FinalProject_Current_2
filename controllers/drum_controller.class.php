<?php

/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * File: drum_controller.class.php
 * Description: the drum controller
 *
 */

class DrumController {

    private $drum_model;

    //default constructor
    public function __construct() {
        //create an instance of the DrumModel class
        $this->drum_model = DrumModel::getDrumModel();
    }

    //index action that displays all drums
    public function index() {
        //retrieve all drum and store them in an array
        $drums = $this->drum_model->list_drum();

        if (!$drums) {
            //display an error
            $message = "There was a problem displaying drums.";
            $this->error($message);
            return;
        }

        // display all drums
        $view = new DrumIndex();
        $view->display($drums);
    }

    //show details of a drum
    public function detail($id) {
        //retrieve the specific drum
        $drum = $this->drum_model->view_drum($id);

        if (!$drum) {
            //display an error
            $message = "There was a problem displaying the drum id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display drum details
        $view = new DrumDetail();
        $view->display($drum);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new DrumError();

        //display the error page
        $error->display($message);
    }
    //search movies
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all drums
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching drums
        $drums = $this->drum_model->search_drum($query_terms);

        if ($drums === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched durms
        $search = new DrumSearch();
        $search->display($query_terms, $drums);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $drums = $this->drum_model->search_drum($query_terms);

        //retrieve all drums names and store them in an array
        $names = array();
        if ($drums) {
            foreach ($drums as $drum) {
                $names[] = $drum->getDrumName();
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
        //retrieve the specific drums
        $drum = $this->drum_model->view_drum($id);
 
        if (!$drum) {
            //display an error
            $message = "There was a problem displaying the drum id='" . $id . "'.";
            $this->error($message);
            return;
        }
 
        $view = new DrumEdit();
        $view->display($drum);
    }
    
     //update a drum in the database
    public function update($id) {
        //update the movie
        $update = $this->drum_model->update_drum($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the drum id='" . $id . "'.";
            $this->error($message);
            return;
        }
 
        //display the updateed drum details
        $confirm = "The drum was successfully updated.";
        $drum = $this->drum_model->view_drum($id);
 
        $view = new DrumDetail();
        $view->display($drum, $confirm);
    }
    
    //public method thee directs the admin to the add form
    public function addForm() {
        $view = new DrumAdd();
        $view->display();
    }
    
    //public function that filters user input, handles exceptions, and runs the add_drum method in the DrumModel
    public function add() {
        //post data from the form
        $drum_name = filter_input(INPUT_POST, 'drum_name', FILTER_SANITIZE_STRING);
        $drum_type = filter_input(INPUT_POST, 'drum_type', FILTER_SANITIZE_NUMBER_INT);
        $youtube_link = filter_input(INPUT_POST, 'youtube_link', FILTER_SANITIZE_URL);
        $drum_image = filter_input(INPUT_POST, 'drum_image', FILTER_SANITIZE_STRING);
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
            
            if ($drum_name == "" || $youtube_link == "" || $drum_image == "" || $price == "" || $description == "") {
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
        
        //new drum object
        $drum = new Drum($drum_image, $drum_name, $drum_type , $description, $youtube_link, $price);
        
        $this->drum_model->add_drum($drum);
        
        //displays the confirmation
        $view = new ConfirmDrum();
        $view->display();
    }
    
    
    //delete function. Deletes drum with the id of the current drum.
    public function delete($id) {
        $this->drum_model->delete_drum($id);
        
        $view = new DrumDelete();
        $view->display();
    }

}
