<?php
/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * File: drum_error.class.php
 * Description: displays error message if an error occurred with drum processes
 *
 */
class DrumError extends DrumIndexView {

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
                    <script>  swal({
                            title: "Error",
                            text: " <p> Sorry, but an error has occurred.</p> <div style='color: red'>\
                <?= urldecode($message) ?><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/drum/index'>Drum List</a> </div> </div>",
                            type: "error",
                            showConfirmButton: false,
                            html: true

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
        <a href="<?= BASE_URL ?>/drum/index">Back to Drums</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

}