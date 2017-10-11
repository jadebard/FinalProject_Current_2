<?php
/*
 * Author: Group 14
 * Date: 04/04/17
 * Name: drum.class.php
 * Description: the Drum class models a real-world drumset.
 */

class Drum {

    //private properties of a Drum object
    private $drum_id, $drum_name, $drum_type,  $youtube_link, $price, $drum_image, $description;

    //the constructor that initializes all properties
    public function __construct($drum_image, $drum_name, $drum_type ,  $description, $youtube_link, $price) {
        $this->drum_name = $drum_name;
        $this->drum_type = $drum_type;
        $this->youtube_link = $youtube_link;
        $this->price = $price;
        $this->drum_image = $drum_image;
        $this->description = $description;
    }
    
    //public get methods that set specfic details of the drum
    public function getDrumId() {
        return $this->drum_id;
    }

    public function getDrumName() {
        return $this->drum_name;
    }

    public function getDrumType() {
        return $this->drum_type;
    }

    public function getYoutubeLink() {
        return $this->youtube_link;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDrumImage() {
        return $this->drum_image;
    }

    public function getDescription() {
        return $this->description;
    }


    //set drum id
    public function setDrumId($drum_id) {
        $this->drum_id = $drum_id;
    }

}
