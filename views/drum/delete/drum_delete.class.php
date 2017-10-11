<?php
/*
 * Author: Jacob DeBard
 * Date: 04/18/2017
 * Name: drum_delete.class..php
 * Description: Displays a confirmation message that a drumset was deleted
 */
class DrumDelete extends DrumIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Guitar Deletion");

        ?>
        <head>
            <title>Drum Deleted</title>
        </head>
        <body>
        <script>  swal({
                title: "Success",
                text: " <p> You Have deleted a Drum set.</p><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/drum/index'>Drum List</a> </div>",
                type: "success",
                showConfirmButton: false,
                html: true

            });


            </script>

         <a href="<?= BASE_URL ?>/drum/index">Go to drum list</a>
        </body>

    <?php
    parent::displayFooter();
    }       //closes the display function

}           //closes the class
?>

