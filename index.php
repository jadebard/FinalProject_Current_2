<?php
/*
 * Author: Group 14
 * Date: 4/4/2017
 * Name: index.php
 * Description: The index page of the website
 */
//load application settings
require_once("application/config.php");

//load autoloader
require_once("application/autoloader.class.php");

//load the displather that dissects a request URL
new Dispatcher();