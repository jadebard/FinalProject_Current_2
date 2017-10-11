<?php

/* Author: Jacob DeBard
 * Date: 04/26/2017
 * Name: utilities.class.php
 * Description: this class contains two static methods for validating email address and date.
 */

class Utilities {
    //validate an email address. An valid email address appears in the format of "username@domain.domain"
    public static function checkurl($url) {
        $result = TRUE;
        if (!preg_match("((^(http[s]?:\/\/)?([w]{3}[.])?(([a-z0-9\.]+)+(com|php))(((\/[a-z0-9]+)*(\/[a-z0-9]+\/?))*([a-z0-9]+[.](html|php|gif|png|jpg))?)(((\&|\?)\w+\=\w*)*)$)|((^([.]\/)?((([a-z0-9]+)\/?)+|(([a-z0-9]+)\/)+([a-z0-9]+[.](html|php|gif|png|jpg))))$))", $url)) {
        
            $result = FALSE;
        }
        return $result;
    }
    
    public static function checkNum($price) {
        $result = TRUE;
        if (!is_numeric($price) == true) {
            $result = FALSE;
        }
        
        return $result;
    }
    
    public static function checkemail($email) {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }
    

//validate a date. A valid date must be entered in 'mm/dd/yyyy' or 'mm-dd-yyyy' format
//    public static function validatedate($date) {
//        if(count(explode('/', $date))<3) {return false;}
//        list( $m, $d, $y ) = preg_split('/[-\.\/ ]/', $date);
//        if (!is_numeric($m) || !is_numeric($d) || !is_numeric($y) || $y < 1000 || $y > 9999)
//        {return false;}
//        return checkdate($m, $d, $y);
//    }

}

?>
