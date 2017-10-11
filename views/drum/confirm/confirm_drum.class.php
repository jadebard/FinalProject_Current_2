<?php
/*
 * Author: Jacob DeBard
 * Date: 04/15/2017
 * Name: confirm_drum.class..php
 * Description: Displays a confimration that a drum was created
 */
class ConfirmDrum extends DrumIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Confirmed Creation");

        ?>
        <head>
            <title>Drum Confirmation</title>
        </head>
        <body>
        <script>  function runScript() {
            swal({
                title: "Success!",
                text: " <p> You Have added a new Drum Set!.</p><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/drum/index'>Drum List</a>",
                type: "success",
                showConfirmButton: false,
                html: true

            });
            
                };               
                $(document).ready(function() {
                    runScript();
            })

            </script>
         <a href="<?= BASE_URL ?>/drum/index">Go to drum list</a>
        </body>

    <?php
    parent::displayFooter();
    }       //closes the display function

}           //closes the class
?>

