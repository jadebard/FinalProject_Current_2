<?php
/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * Name: guitar_index.class.php
 * Description: This class defines a method called "display", which displays all guitars
 * that match the query terms for the search.
 */
class GuitarSearch extends GuitarIndexView {
    /*
     * the display method accepts an array of guitar objects and displays
     * them in a grid.
     */

    public function display($terms, $guitars) {
        //display page header
        parent::displayHeader("List All Guitars");
        ?>
        <div id="main-header"> Guitars in the Store</div>

        <div class="grid-container">
            <?php
            if ($guitars === 0) {
                echo "No guitar was found.<br><br><br><br><br>";
            } else {
                //display books in a grid; six books per row
                foreach ($guitars as $i => $guitar) {
                    $guitar_id = $guitar->getGuitarId();
                    $guitar_name = $guitar->getGuitarName();
                    $guitar_type = $guitar->getGuitarType();
                    $youtube_link = $guitar->getYoutubeLink();
                    $price = $guitar->getPrice();
                    $guitar_image = $guitar->getGuitarImage();
                    if (strpos($guitar_image, "http://") === false AND strpos($guitar_image, "https://") === false) {
                        $guitar_image = BASE_URL . "/" . INSTRUMENT_IMG . $guitar_image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><a href='",BASE_URL, "/guitar/detail/".$guitar_id ."'><img src='" . $guitar_image .
                        "'></a><span> $guitar_name <br>Type $guitar_type<br> ";
                    printf("Price: $%.2f<br>", $price,"<br>");
                    echo "</span></div> <hr>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($guitars) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
       <div class="backButton"> <a href="<?= BASE_URL ?>/guitar/index">Guitar List</a> </div>
        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}