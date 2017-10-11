<?php

/*
 * Author: Jacob DeBard
 * Date: 04/18/2017
 * Name: drum_detail.class..php
 * Description: Displays details of the specific drum selected
 */

class DrumDetail extends IndexView {

    public function display($drum, $confirm = "") {
        parent::displayHeader("Display Drum Details");
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

        //retrieve drum details by calling get methods
        $id = $drum->getDrumId();
        $name = $drum->getDrumName();
        $type = $drum->getDrumType();
        $image = $drum->getDrumImage();
        $youtube= $drum->getYoutubeLink();
        $description = $drum->getDescription();
        $price = $drum->getPrice();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . INSTRUMENT_IMG . $image;
        }
        ?>

        <div id="main-header">Drum Details</div>
        <hr>
        <!-- display drum details in a table -->

        <div class="wrapImg" style="margin-top: 150px">

            <img src="<?= $image ?>" alt="<?= $title ?>" />

        <div style="margin-left: 80px; width: 40%;" class="wrapTxtOne">
                    <p><strong>Drum:</strong></p>
            <p><?= $name ?></p>
                    <p><strong>Type:</strong></p>
            <p><?= $type ?></p>
                    <p><strong>Price:</strong></p>
            <p>$<?= $price ?></p>
                    <p><strong>Description:</strong></p>
            <p class="media-description"><?= $description ?></p>
                    <p><strong>Youtube:</strong></p>
            <a class="youtubeLink" id="youtubelink" href="<?= $youtube ?>" data-lity><p>Youtube <i class="fa fa-youtube-play" aria-hidden="true"></i></p></a>

        </div>
        </div>





        <div id="confirm-message"> <?php
        if ($confirm === "") {



        }

        else {
            ?>
            <script>

                swal({
                    title: "Success",
                    text: "<?= $confirm ?> </div>",
                    type: "success",
                    showConfirmButton: true,
                    html: true

                });

            </script>

            <?php

        }

        ?>

        <?php if ($role == 1) { ?>
            <div id="button-group">
                <input type="button" id="edit-button" value="   Edit   "
                       onclick="window.location.href = '<?= BASE_URL ?>/drum/edit/<?= $id ?>'">&nbsp;
            </div>
            <!--                    <div id="button-group">
                        <input type="button" id="add-button" value="   Add   "
                               onclick="window.location.href = '<?= BASE_URL ?>/drum/addForm/'">&nbsp;
                    </div>-->
            <div id="button-group">
                <input type="button" id="delete-button" value="   Delete   "
                       onclick="window.location.href = '<?= BASE_URL ?>/drum/delete/<?= $id?>'">&nbsp;
            </div>
        <?php } ?>
        <a class="backButton"  href="<?= BASE_URL ?>/drum/index">Go to drum list</a>

        <?php
        parent::displayFooter();
    
    }

//end of display method
}
