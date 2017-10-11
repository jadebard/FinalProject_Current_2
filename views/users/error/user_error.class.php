<?php
/*
 * Author: Group 14
 * Date: 04/18/2017
 * File: user_error.class.php
 * Description: shows an error message if an error occurred with user processes
 *
 */
class UserError extends UserIndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>

        <div id="main-header">Error</div>
        <hr>
        <table style="width: 100%; border: none">
            <tr>
                <td style="vertical-align: middle; text-align: center; width:100px">
                    <img src='<?= BASE_URL ?>/www/css/assets/error.jpg' style="width: 80px; border: none"/>
                </td>
                <td style="text-align: left; vertical-align: top;">
        <script>
        function runAlert() {

        swal({
        title: "Error",
        text: " <p> Sorry, but an error has occurred.</p> <div style='color: red'> \
                <?= urldecode($message) ?> </div><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>'>Home Page</a>",
        type: "error",
        showConfirmButton: false,
        html: true

        });

        }

        $(document).ready(function () {
        runAlert();


        });
        </script>
                    <h3> Sorry, but an error has occurred.</h3>
                    <div style="color: red">
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <br><br><br><br><hr>
        <a href='<?= BASE_URL ?>'>Home</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

}