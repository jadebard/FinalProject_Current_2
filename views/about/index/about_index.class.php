<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_index.class
 *
 * @author Obaid
 */
class AboutIndex extends IndexView {

    public function display() {
        //display page header
        parent::displayHeader("About GuitarHaven");
        ?>
        <div id="main-header"> About the creators of Guitar Haven</div>

        <div class="grid-container">
<!--         add code here-->

       <p style="padding-top: 120px; font-family: 'Open Sans Condensed', sans-serif" > GuitarHaven is home to the largest selection of popular guitars and drums. 

Drummers need look no further for the biggest selection of the best drum gear, including acoustic drum sets, electronic drum sets, hand drums, cymbals and sticks.  With our live sound products, will suit the needs of any gigging musician. 

Are you a longtime guitarist looking for something especially unique? Check out our Electric & Acoustic instruments. From the Gibson Les Paul to the Fender Stratocasters, we’ve got you covered. 

No matter your experience level or musical preference, our knowledgeable team of experienced musicians will help you find the right piece of gear for your band, ensemble or music venue. Whether you’re just getting started making music, or you're a working professional, GuitarHaven has what you need to help make the sounds in your head a reality. 

Our Team consists of Taylor Childers, Jacob Debard,  Obaid Ameen, Jake Ford, who worked very hard on implementing style, clients, servers, and database in order to bring you the most executive website with the best Drums and Guitars available today!  </p>
            
            
       <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
?> 