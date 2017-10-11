<?php
/*
 * Author: Jacob DeBard
 * Date: 04/18/2017
 * Name: confirm_guitar.class.php
 * Description: Displays a confirmation message that a guitar was created
 */
class ConfirmGuitar extends GuitarIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Confirmed Creation");

        ?>
        <head>
            <title>Guitar Confirmation</title>
        </head>
        <body>
        <script>  function runScript() {
            swal({
                title: "Success!",
                text: " <p> You Have added a new Guitar!.</p><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/guitar/index'>Guitar List</a>",
                type: "success",
                showConfirmButton: false,
                html: true

            });
            
                };               
                $(document).ready(function() {
                    runScript();
            })</script>

         <a href="<?= BASE_URL ?>/guitar/index"> <div class="backButton"> Go to guitar list </div></a>
        </body>

    <?php
    parent::displayFooter();
    }       //closes the display function

}           //closes the class
?>

