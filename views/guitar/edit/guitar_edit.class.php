<?php
/*
 * Author: Jacob DeBard
 * Date: 03/30/2017
 * File: guitar_edit.class.php
 * Description: displays a form to edit the guitar details
 *
 */
 
class GuitarEdit extends GuitarIndexView {
 
    public function display($guitar) {
        //display page header
        parent::displayHeader("Edit Guitar");
//            if (session_status() == PHP_SESSION_NONE) {
//                      session_start();
//                  }
                  
//                  $types = '';
        //get drum type from a session variable
//        if (isset($_SESSION['guitar_types'])) {
//            $types = $_SESSION['guitar_types'];
//        }
             
        if (isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $name = $_SESSION['name'];
            $role = $_SESSION['role'];
        }
       
        //retrieve details by calling get methods
        $id = $guitar->getGuitarId();
        $name = $guitar->getGuitarName();
        $type = $guitar->getGuitarType();
        $youtube = $guitar->getYoutubeLink();
        $price = $guitar->getPrice();
        $image = $guitar->getGuitarImage();
        $description = $guitar->getDescription();
        ?>
 
        <!--<div id="main-header">Edit Guitar Details</div>-->
 
        <!-- display drums details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/guitar/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Name</strong><br>
                <input class="inputContact" name="guitar_name" type="text" size="100" value="<?= $name ?>" autofocus></p>
            <p><strong>Type</strong>:
                <select class="inputContact" name="guitar_type">
                    <option value="1">Acoustic</option>
                    <option value="2">Electric</option>
                </select>
                <?php
//                foreach ($types as $g_type => $g_id) {
//                    $checked = ($type == $g_type ) ? "checked" : "";
//                    echo "<input type='radio' name='guitar_type' value='$g_id' $checked> $g_type &nbsp;&nbsp;";
//                }
                ?>
            </p>
            <p><strong>Youtube Link</strong>: <input class="inputContact" name="youtube_link" type="url" value="<?= $youtube ?>" ></p>
            <p><strong>Price</strong>
                <input class="inputContact" name="price" type="float" size="40" value="<?= $price ?>" ></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input class="inputContact" name="guitar_image" type="text" size="100" value="<?= $image ?>"></p>
         /  <p><strong>Description</strong></p>:<br>
                <textarea font-color="black" name="description" rows="8" cols="100"><?= $description ?></textarea>
            <input class="backButton" type="submit" name="action" value="Update Guitar">
            <input class="backButton" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/guitar/detail/" . $id ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
 
//end of display method
}
