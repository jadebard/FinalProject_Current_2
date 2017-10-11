<?php
/*
 * Author: Jacob DeBard
 * Date: 04/20/2017
 * Name: confirm_logout.class.php
 * Description: confirmation message that a user has logged out
 */
class ConfirmLogout extends UserIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Confirmed Logout");

        ?>
        <head>
            <title>Logout Confirmation</title>
        </head>
        <body>
        <script>
        function runAlert() {

        swal({
        title: "Success!",
        text: "<p> You have successfully logged out </p>    <a style='width: auto;' class='backButton' href='<?= BASE_URL ?>'>Home Page</a>",
        type: "success",
        showConfirmButton: false,
        html: true

        });

        }

        $(document).ready(function () {
        runAlert();


        });
        </script>


        </body>

    <?php
    parent::displayFooter();
    }       //closes the display function

}           //closes the class
?>

