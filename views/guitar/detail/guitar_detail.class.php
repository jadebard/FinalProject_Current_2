<?php

/*
 * Author: Jacob DeBard
 * Date: 04/18/2017
 * Name: guitar_detail.class..php
 * Description: Displays details of the specific guitar selected
 */

class GuitarDetail extends IndexView {

    public function display($guitar, $confirm = "") {
        parent::displayHeader("Display Guitar Details");

        $role = '';
        
       if (session_status() == PHP_SESSION_NONE) {
            session_start();
       }
//        
        if (isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $name = $_SESSION['name'];
            $role = $_SESSION['role'];
        }
        
        //retrieve guitar details by calling get methods
        $id = $guitar->getGuitarId();
        $name = $guitar->getGuitarName();
        $type = $guitar->getGuitarType();
        $image = $guitar->getGuitarImage();
        $description = $guitar->getDescription();
        $youtube = $guitar->getYoutubeLink();
        $price = $guitar->getPrice();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . INSTRUMENT_IMG . $image;
        }
        ?>

        <div id="main-header">Guitar Details</div>
        <hr>
        <!-- display guitar details in a table -->
        <div class="wrapImg" style="margin-top: 150px;">
            
            <img src="<?= $image ?>" alt="<?= $title ?>" />
               
            <div style="margin-left: 80px; width: 40%;" class="wrapTxtOne">
                <p><strong>Guitar:</strong></p>
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


                <div class="wrapTxtTwo">




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
                </div>
                <?php if ($role == 1) { ?>
                    <div class="flexButtons">
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/guitar/edit/<?= $id ?>'">&nbsp;
                    </div>

                    <div id="button-group">
                        <input type="button" id="delete-button" value="   Delete   "
                               onclick="window.location.href = '<?= BASE_URL ?>/guitar/delete/<?= $id?>'">&nbsp;
                    </div>
                    </div>
                <?php } ?>
        </div>

        <a class="backButton" href="<?= BASE_URL ?>/guitar/index">Go to guitar list</a>

        <?php
        parent::displayFooter();

    }

//end of display method
}