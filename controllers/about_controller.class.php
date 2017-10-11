<?php

/*
 * Author: Obaid Ameen
 * Date: 4.25.2017
 * File: contact_controller.class.php
 * Description: the contact class controller
 *
 */

class AboutController {

    //index action that displays all items
    public function index() {

        // display all items
        $view = new AboutIndex();
        $view->display();
    }


    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new AboutError();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

}
