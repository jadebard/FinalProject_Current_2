<?php
/*
 * Author: Jacob DeBard
 * Date: 04/17/2017
 * Name: guitar_delete.class.php
 * Description: displays a confirmation that a guitar was deleted
 */
class GuitarDelete extends GuitarIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Guitar Deleted");

        ?>
        <head>
            <title>Guitar Deleted</title>
        </head>
        <body>
        <script>  swal({
                title: "Success",
                text: " <p> You Have deleted a guitar.</p><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/guitar/index'>Guitar List</a> </div>",
                type: "success",
                showConfirmButton: false,
                html: true

            });

            </script>
         <a href="<?= BASE_URL ?>/guitar/index">Go to guitar list</a>
        </body>

    <?php
    parent::displayFooter();
    }       //closes the display function

}           //closes the class
?>

