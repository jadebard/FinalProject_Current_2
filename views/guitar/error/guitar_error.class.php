<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * File: guitar_error.class.php
 * Description: displays an error message when errors occur with
 * guitar processes
 *
 */
class GuitarError extends GuitarIndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>


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
                <?= urldecode($message) ?><a style='margin-left: 125px' class='backButton' href='<?= BASE_URL ?>/guitar/index'>Guitar List</a> </div>",
                            type: "error",
                            showConfirmButton: false,
                            html: true

                        });

                        </script>
                    <div style="color: red">
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <br><br><br><br><hr>
       <a href="<?= BASE_URL ?>/guitar/index" class="backButton"> Back to guitar list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

}