<?php
/*
 * Author: Jacob DeBard
 * Date: 04/15/17
 * File: guitar_edit.class.php
 * Description: Displays a form to add a new guitar to the database
 *
 */
 
class GuitarAdd extends GuitarIndexView {
 
    public function display() {
        //display page header
        parent::displayHeader("Add Guitar");
        ?>
 
        <div id="main-header">Add Guitar Details</div>
 
        <!-- display drums details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/guitar/add/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input class="inputContact" type="hidden" name="id" value="">
            <p><strong>Name</strong><br>
                <input class="inputContact" name="guitar_name" type="text" size="100" value="" autofocus></p>
            <p><strong>Type</strong>
                <select class="inputContact" name="guitar_type">
                    <option value="1">Acoustic</option>
                    <option value="2">Electric</option>
                </select>
            </p>
            <p><strong>Youtube Link</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input class="inputContact" name="youtube_link" type="url" value=""></p>
            <p><strong>Price</strong>
                <input class="inputContact" name="price" type="float" size="40" value=""></p>
            <p><strong>Image</strong>
                <input class="inputContact" name="guitar_image" type="text" size="100" value=""></p>
           <p><strong>Description</strong>:<br>
                <textarea style="color: black" name="description" rows="8" cols="100"></textarea></p>
            <input class="backButton" type="submit" name="action" value="Add Guitar">
            <input class="backButton" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/guitar/index/" ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
 
//end of display method
}
