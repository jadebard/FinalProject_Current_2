<?php
/*
 * Author: Jacob DeBard
 * Date: 04/15/2017
 * File: drum_add.class.php
 * Description: displays a form to add a drum
 *
 */
 
class DrumAdd extends DrumIndexView {
 
    public function display() {
        //display page header
       parent::displayHeader("Add Guitar");

        ?>
 
        <div id="main-header">Add Drum Details</div>
 
        <!-- display drums details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/drum/add/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input class="inputContact" type="hidden" name="id" value="">
            <p><strong>Name</strong><br>
                <input class="inputContact" name="drum_name" type="text" size="100" value="" autofocus></p>
            <p><strong>Type</strong>
                <select class="inputContact" name="drum_type">
                    <option value="1">Acoustic Set</option>
                    <option value="2">Digital Set</option>
                </select>
            </p>
            <p><strong>Youtube Link</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input class="inputContact" name="youtube_link" type="url" value="" ></p>
            <p><strong>Price</strong>
                <input class="inputContact" name="price" type="float" size="40" value="" ></p>
            <p><strong>Image</strong>
                <input class="inputContact" name="drum_image" type="text" size="100" value=""></p>
           <p><strong>Description</strong>:<br>
                <textarea style="color: black" name="description" rows="8" cols="100"></textarea></p>
            <input class="backButton" type="submit" name="action" value="Add drum">
            <input class="backButton" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/drum/index/"?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
 
//end of display method
}
