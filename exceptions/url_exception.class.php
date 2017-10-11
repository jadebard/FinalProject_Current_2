<?php

/*
 * Author: Jacob DeBard
 * Date: 4/24/2017
 * File: url_exception.class.php
 * Description: class that extends the built in Exception class. Overriden and 
 * retrieves a function called getDetails() when an exception is being handled
 *
 */

class UrlException extends Exception {
    public function getDetails() {
        return "Please enter a valid url.";
    }
}