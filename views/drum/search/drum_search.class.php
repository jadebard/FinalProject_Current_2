<?php
/*
 * Author: Group 14
 * Date: 04/18/17
 * Name: drum_search.class.php
 * Description: this script defines the DrumSearch class. The class contains a method named display, which
 *     accepts an array of Drum objects and displays them in a grid.
 */

class DrumSearch extends DrumIndexView {
    /*
     * the displays accepts an array of drum objects and displays
     * them in a grid.
     */

     public function display($terms, $drums) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($drums)) ? "( 0 - 0 )" : "( 1 - " . count($drums) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($drums === 0) {
                echo "No drum was found.<br><br><br><br><br>";
            } else {
                //display drums in a grid; six drums per row
                foreach ($drums as $i => $drum) {
                    $drum_id = $drum->getDrumId();
                    $drum_name = $drum->getDrumName();
                    $drum_type = $drum->getDrumType();
                    $youtube_link = $drum->getYoutubeLink();
                    $price = $drum->getPrice();
                    $drum_image = $drum->getDrumImage();
                    if (strpos($drum_image, "http://") === false AND strpos($drum_image, "https://") === false) {
                        $drum_image = BASE_URL . "/" . INSTRUMENT_IMG . $drum_image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><a href='",BASE_URL, "/drum/detail/".$drum_id ."'><img src='" . $drum_image .
                    "'></a><span> $drum_name <br>Type $drum_type<br> ";
                    printf("Price: $%.2f<br>", $price,"<br>");        
                    echo "</span></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($drums) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a class="backButton" href="<?= BASE_URL ?>/drum/index">Go to drum list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}