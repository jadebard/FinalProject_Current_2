<?php
/*
 * Author: Group 14
 * Date: 4/06/2017
 * File: welcome_controller.class.php
 * Description: This scripts define the class for the welcome controller; this is the default controller.
 * 
 */
class WelcomeController {
    //home page index
    public function index() {
        $view = new WelcomeIndex();
        $view->display();
    }
}