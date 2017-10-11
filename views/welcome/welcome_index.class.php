<?php

/*
 * Author: Jacob DeBard
 * Date: 04/012017
 * Name: welcome_index_view.class.php
 * Description: the Welcome index that shows the two options to show Guitar or Drums
 */

class WelcomeIndex extends IndexView {
//
    public function display() {
//        //display page header
        parent::displayHeader("Guitar Haven");
      ?>

        <div class="fixedLettering">

            <div class="letteringHolder">     <h1> Guitar Haven </h1>
                <div class="buttonHolder">
        <a href="<?= BASE_URL ?>/guitar/index"> <div class="guitars"> <p> Guitars </p> </div> </a>
           <a href="<?= BASE_URL ?>/drum/index"> <div class="drums"> <p> Drums </p> </div> </a>
            </div>
            </div>

        </div>

    <div class="videoHolder">

        <video autoplay loop>
        <source src="www/videos/backgroundVidHome.mp4">


        </video>






    </div>


        <?php
        //display page footer
        parent::displayFooter();
    }

}
