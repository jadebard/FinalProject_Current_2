<?php

/*
 * Author: Group 14
 * Date: 4/20/2017
 * Name: index_view.class.php
 * Description: initializes the header and the footer of the whole site
 */
class IndexView {


    //this method displays the page header
    static public function displayHeader($page_title) {
        
        //starts a session variable
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
       }
       
       //initializes these variables before a user logs in
        $login = $name = $role = '';
        
        //when a session starts, sets user details to session variables
        if (isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $name = $_SESSION['name'];
            $role = $_SESSION['role'];
        }
        
        //initialize a login status before login
        $login_status = '';
        
        //when a session starts, sets the login status to the session variable
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }
        ?>

        <html>

            <title> <?php echo $page_title ?> </title>
<!--            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>-->
<!--            <link rel='shortcut icon' href='--><?//= BASE_URL ?><!--/www/img/favicon.ico' type='image/x-icon' />-->
  <link href="<?= BASE_URL ?>/www/css/bootstrap.min.css" rel="stylesheet">
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/style.css' />
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/font-awesome-4.7.0/css/font-awesome.min.css' />
              <link href="<?= BASE_URL ?>/www/css/lity.css" rel="stylesheet" type="text/css"/>
                <link href="<?= BASE_URL ?>/www/css/sweetalert.css" rel="stylesheet"/>
                




<script src="<?= BASE_URL ?>/www/js/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/www/js/sweetalert.min.js"></script>
<script src="<?= BASE_URL ?>/www/js/bootstrap.min.js"></script>
            <script>

                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";
            </script>

        <?php
    //end of displayHeader function

?>



    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">

    </head>

    <body>

    <div class="loginModal">
    <div class="bg"> </div>
    <div class="loginForm">

        <div class="loginHeader">
            <h3 class="fontWeightModule"> Login To Guitar Haven </h3>
            <h3 class="suClose"><i class="fa fa-times" aria-hidden="true"></i></h3>

        </div>


        <div class="suForm">

            <form class="modalForm" method="post" action="<?= BASE_URL . "/user/loginRequest/" ?>" id="loginForm">
                <div class="flexInputs">
                    <label> Name</label>
                    <input class="inputContact" id="username" type="text" placeholder="Username" name="username" required />
                    <label> Password</label>
                    <input class="inputContact" id="password" type="password" placeholder="Password" name="password" required/>
                </div>

                <button class="sub" type="submit" value="Submit"> Submit </button>
                <button class= "reset" type="reset" value="Reset"> Reset </button>
            </form>

<!--            <a href="../Guitars/registerForm.php"><button id="register">Register New User</button></a>-->
<!--            <a style='color: white; text-decoration: none; margin-top: 2%' href='logout.php'>Logout</a>-->



        </div>


    </div>





</div>




    <header>
        <div class="topSection logo">
            <a href="<?php BASE_URL ?>/I211/FinalProject_Current_2/"><h1>Guitar Haven</h1></a>

            <!--        <input class="search" placeholder="Search">-->
            
<!--            <form class="search" action="--><?//= BASE_URL ?><!--/drum/search" method="get">-->
<!--                <input class="search" type="text" name="query-terms" placeholder="Search" onkeyup="handleKeyUp(event)" autocomplete="off" required />-->
<!--                <input id="searchBtn" type="submit" value="Go" />-->
<!--            </form>-->

<!--        <p>  <i id="login" class="fa fa-user loginButton"></i> <a style="color: whitesmoke" href="showcart.php"><? echo $shoppingcart ?></a> </p>-->
        <?php 
        if ($login_status === 1) {
        ?> <div class="loginName"> <?php
            echo "<p style='font-weight: 100'> Hello " . $_SESSION['name'] . "!</p>";
            echo "<a href='" . BASE_URL . "/user/logout'>Log out</a>";

            ?> </div> <?php
        } else {
            echo "<p>  <i id='login' class='fa fa-user loginButton'></i> </p>";
        }
        ?>
        </div>
        <nav>
            <ul>
                <a href="<?= BASE_URL ?>/index">Home</a>
                <a href="<?= BASE_URL ?>/about">About</a>
                <a href="<?= BASE_URL ?>/guitar/index">Guitars</a>
                <a href="<?= BASE_URL ?>/drum/index">Drums</a>
                <a href="<?= BASE_URL ?>/contact">Contact</a>
            </ul>
        </nav>

        <!-- LOGIN POPUP -->

    </header>
    </body>
    </html>
            <?php }
    //this method displays the page footer
    public static function displayFooter() {
        ?>


<body>

<footer>
<div class="moveFooter">
    <div class="social">
        <a href="http://facebook.com/profile.php?=73322363" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
    </div>

    <p>&copy; Copyright Guitar Haven <?php echo date("Y"); ?></p>
    <p>guitarhaven@gmail.com</p>
     </div>
</footer>
</body>
</html>
<!--        <div id="footer"><br>&copy 2016 Kung Fu Panda Media Library. All Rights Reserved.</div>-->

        <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/jquery.gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/CSSPlugin.min.js"></script>
<script src="<?= BASE_URL ?>/www/js/lity.js"></script>
            <script type="text/javascript" src="<?= BASE_URL ?>/www/js/app.js"></script>



        </body>
        </html>
        <?php
    } //end of displayFooter function


}
