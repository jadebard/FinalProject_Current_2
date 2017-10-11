<?php
/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * Name: drum_index.class.php
 * Description: displays all of the drums in our database
 */
class DrumIndex extends DrumIndexView {

    public function display($drums) {
        //display page header
        parent::displayHeader("List All Drums");
        
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
                        <input class="backButton" type="button" id="add-button" value="   Add a Drumset   "
                               onclick="window.location.href = '<?= BASE_URL ?>/drum/addForm/'">&nbsp;
                    </div>
        <div class="grid-container">
            <?php
        }
            
            if ($drums === 0) {
                echo "No drum was found.<br><br><br><br><br>";
            } else {
                //display drums in a list
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

                    echo "<div class='col'> <a href='",BASE_URL, "/drum/detail/".$drum_id ."'><img src='" . $drum_image .
                    "'></a><span class='moveLeft'>  <h1 class='modalName'> Model: </h1> <h2> $drum_name </h2> <br> <h1 class='modalType'> Type: </h1> <h2> $drum_type </h2><br> ";
                    printf("<h2 class='modelPrice'> Price: <br> $%.2f </h2><br>", $price,"<br>");
                    echo "<a href='", BASE_URL, "/drum/detail/".$drum_id . "'><div class='viewableClick'> <p> View Drums </p></div> </a></span></div> <hr>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($drums) - 1) {
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
