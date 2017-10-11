<?php
/*
 * Author: Jacob DeBard
 * Date: 4/20/2017
 * Name: user_index_view.class.php
 * Description: the parent class that displays a search box. The search form is commented out here since the search feature is not implemented. 
 */

class UserIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the instrument type
            var instrument = "guitar";
        </script>
        <!--create the search bar -->

        <div id="searchbar">
            <form class="searchHolder fa fa-search fa-3x" method="get" action="<?= BASE_URL ?>/guitar/search">
                <input class="search" type="text" name="query-terms" id="searchtextbox" placeholder="Find Your Next Guitar" autocomplete="off" onkeyup="handleKeyUp(event)">
            </form>
            <div id="suggestionDiv"></div>

        </div>
        <br>
        <br>
        <hr class="searchBreak">
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}