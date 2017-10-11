<?php
/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * Name: guitar_index.class.php
 * Description: This class defines a method called "display", which displays all guitars.
 */
class GuitarIndex extends GuitarIndexView {
    /*
     * the display method accepts an array of guitar objects and displays
     * them in a grid.
     */

    public function display($guitars) {
        //display page header
        parent::displayHeader("List All Guitars");
        
        
        $role = '';
        //starts a session if one had not been initialized
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
       }
       
       //sets user details to session variables
        if (isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $name = $_SESSION['name'];
            $role = $_SESSION['role'];
        }
        
        if ($role == 1) {
        ?>
        <div id="button-group">
            <input class="backButton" type="button" id="add-button" value="   Add a Guitar   "
                   onclick="window.location.href = '<?= BASE_URL ?>/guitar/addForm/'">&nbsp;
        </div>

        <div class="grid-container">
            <?php
        }
            
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

//                    echo "<div class='col'><a href='",BASE_URL, "/guitar/detail/".$guitar_id ."'><img src='" . $guitar_image .
//                        "'></a><span> $guitar_name <br>Type $guitar_type<br> ";
//                    printf("Price: $%.2f<br>", $price,"<br>");
//                    echo "</span></div> <hr>";
                    echo "<div class='col'> <a href='",BASE_URL, "/guitar/detail/".$guitar_id ."'><img src='" . $guitar_image .
                        "'></a><span class='moveHolder'>  <h1 class='modalName'> Model: </h1> <h2> $guitar_name </h2> <br> <h1 class='modalType'> Type: </h1> <h2> $guitar_type </h2><br> ";
                    printf("<h2 class='modelPrice'> Price: <br> $%.2f </h2><br>", $price,"<br>");
                    echo "<a href='", BASE_URL, "/guitar/detail/".$guitar_id . "'><div class='viewableClick'> <p> View Guitar </p></div> </a></span></div> <hr>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($guitars) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>

        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}