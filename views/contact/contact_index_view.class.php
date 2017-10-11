<?php
/*
 * Author: Jake Ford
 * Date: 4.5.2017
 * Name: book_index_view.class.php
 * Description: the parent class that displays a search box. The search form is commented out here since the search feature is not implemented. 
 */

class ContactIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the instrument type
            var instrument = "contact";
        </script>
<!--        create the search bar 
        
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/drum/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search drum by name" autocomplete="off">
                <input type="submit" value="Go"/>
            </form>
            <div id="suggestionDiv"></div>
        </div> -->
        <?php
        
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}