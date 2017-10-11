<?php
/*
 * Author: Jacob DeBard
 * Date: 04/16/2017
 * File: drum_edit.class.php
 * Description: displays a form to put in new information for drum details
 *
 */
 
class DrumEdit extends DrumIndexView {
 
    public function display($drum) {
        //display page header
        parent::displayHeader("Edit Drumset");
        
        //retrieve details by calling get methods
        $id = $drum->getDrumId();
        $name = $drum->getDrumName();
        $type = $drum->getDrumType();
        $youtube = $drum->getYoutubeLink();
        $price = $drum->getPrice();
        $image = $drum->getDrumImage();
        $description = $drum->getDescription();
        ?>
 
        <div id="main-header">Edit Drum Details</div>
 
        <!-- display drums details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/drum/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input class="inputContact" type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Name</strong><br>
                <input class="inputContact" name="drum_name" type="text" size="100" value="<?= $name ?>" autofocus></p>
            <p><strong>Type</strong>:
                <select class="inputContact" name="drum_type">
                    <option value="1">Acoustic Set</option>
                    <option value="2">Digital Set</option>
                </select>
                <?php
//                foreach ($types as $d_type => $d_id) {
//                    $checked = ($type == $d_type ) ? "checked" : "";
//                    echo "<input type='radio' name='drum_type' value='$d_id' $checked> $d_type &nbsp;&nbsp;";
//                }
                ?>
            </p>
            <p><strong>Youtube Link</strong>: <input class="inputContact" name="youtube_link" type="url" value="<?= $youtube ?>" ></p>
            <p><strong>Price</strong>
                <input class="inputContact" name="price" type="float" size="40" value="<?= $price ?>" ></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input class="inputContact" name="drum_image" type="text" size="100" value="<?= $image ?>"></p>
         /  <p><strong>Description</strong></p>:<br>
                <textarea name="description" rows="8" cols="100"><?= $description ?></textarea>
            <input class="backButton" type="submit" name="action" value="Update Drum">
            <input class="backButton" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/drum/detail/" . $id ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
 
//end of display method
}
