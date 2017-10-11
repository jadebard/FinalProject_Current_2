<?php
/*
 * Author: Jacob DeBard
 * Date: 04/20/2017
 * Name: confirm_login.class..php
 * Description: Shows a confirmation message that a user logged in
 */
class ConfirmLogin extends UserIndexView {

    //public function display
    public function display() {
        parent::displayHeader("Confirmed Login");

        ?>
        <head>
            <title>Login Confirmation</title>
        </head>
        <body>
        <script>
        function runAlert() {

        swal({
        title: "Welcome!",
        text: "<p> You have successfully logged in </p>  <a style='width: auto;' class='backButton' href='<?= BASE_URL ?>'>Home Page</a>",
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

