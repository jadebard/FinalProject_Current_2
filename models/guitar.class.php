<?php
/*
 * Author: Group 14
 * Date: 04/04/17
 * Name: guitar.class.php
 * Description: the Guitar class models a real-world book.
 */

class Guitar {

    //private properties of a Guitar object
    private $guitar_id, $guitar_name, $guitar_type,  $youtube_link, $price, $guitar_image, $description;

    //the constructor that initializes all properties
    public function __construct($guitar_image, $guitar_name, $guitar_type ,  $description, $youtube_link, $price) {
        $this->guitar_name = $guitar_name;
        $this->guitar_type = $guitar_type;
        $this->youtube_link = $youtube_link;
        $this->price = $price;
        $this->guitar_image = $guitar_image;
        $this->description = $description;
    }
    
    //pubic get methods to get specific details of the guitar
    public function getGuitarId() {
        return $this->guitar_id;
    }

    public function getGuitarName() {
        return $this->guitar_name;
    }

    public function getGuitarType() {
        return $this->guitar_type;
    }

    public function getYoutubeLink() {
        return $this->youtube_link;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getGuitarImage() {
        return $this->guitar_image;
    }

    public function getDescription() {
        return $this->description;
    }


    //set guitar id
    public function setGuitarId($guitar_id) {
        $this->guitar_id = $guitar_id;
    }

}