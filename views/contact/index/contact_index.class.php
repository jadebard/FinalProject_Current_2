<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_index.class
 *
 * @author Obaid
 */
class ContactIndex extends IndexView {

    public function display() {
        //display page header
        parent::displayHeader("contact");
        ?>


        <div class="grid-container">
            <?php
            if (isset($_REQUEST['submitted'])) {
// Initialize error array.
                $errors = array();
                // Check for a proper First name
                if (!empty($_REQUEST['firstname'])) {
                    $fname = $_REQUEST['firstname'];
                    $pattern = "/^[a-zA-Z0-9\_]{2,20}/"; // This is a regular expression that checks if the name is valid characters
                    if (preg_match($pattern, $fname)) {
                        $fname = $_REQUEST['firstname'];
                    } else {
                        $errors[] = 'Your Name can only contain letters. Please do not add any other numbers or symbols.<br>';
                    }
                } else {
                    $errors[] = 'You forgot to enter your First Name. <br>';
                }

                // Check for a proper Last name
                if (!empty($_REQUEST['lastname'])) {
                    $lname = $_REQUEST['lastname'];
                    $pattern = "/^[a-zA-Z0-9\_]{2,20}/"; // This is a regular expression that checks if the name is valid characters
                    if (preg_match($pattern, $lname)) {
                        $lname = $_REQUEST['lastname'];
                    } else {
                        $errors[] = 'Your Name can only contain letters. Please do not add any other numbers or symbols.<br>';
                    }
                } else {
                    $errors[] = 'You forgot to enter your Last Name. <br>';
                }

                //Check for a valid phone number
                if (!empty($_REQUEST['phone'])) {
                    $phone = $_REQUEST['phone'];
                    $pattern = "(^((\+\d{1,2}|1)[\s.-]?)?\(?[2-9](?!11)\d{2}\)?[\s.-]?\d{3}[\s.-]?\d{4}$|^$)"; // This is a regular expression that checks if the name is valid characters
                    if (preg_match($pattern, $phone)) {
                        $phone = $_REQUEST['phone'];
                    } else {
                        $errors[] = 'Please enter a valid phone number in a common format. <br>';
                    }
                } else {
                    $errors[] = 'You forgot to enter your Phone number. <br>';
                }

                if (!empty($_REQUEST['email'])) {
                    $email = $_REQUEST['email'];
                    $pattern = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i";
                    if (preg_match($pattern, $email)) {
                        $email = $_REQUEST['email'];
        } else {
            $errors[] = 'Please enter a valid email address.<br>';
                    }
                } else {
                    $errors[] = 'You forgot to enter your Email address. <br>';
                }
            }
//End of validation 

            if (isset($_REQUEST['submitted'])) {
                if (empty($errors)) {
                    $from = "From: Guitar Haven!"; //Site name
                    // Change this to your email address you want the form sent to
                    $to = "guitarhaven@gmail.com";
                    $subject = "Admin - Guitar Haven! ";

                    $message = "Message from " . $fname . " " . $lname . " 
  Phone: " . $phone . " 
  Email: " . $email . "";
                    mail($to, $subject, $message, $from);
                }
            }
            ?>

            <?php
//Print Errors
            if (isset($_REQUEST['submitted'])) {
                // Print any error messages. 
                if (!empty($errors)) {
//                    echo '<hr /><h3>The following occurred:</h3><ul>';
//                    // Print each error.
//                    foreach ($errors as $msg) {
//                        echo '<li>' . $msg . '</li>';
//                    }
//                    echo '</ul><h3>Your mail could not be sent due to input errors.</h3><hr />';
//                    ?>
                    <script>

        function runAlert() {

            swal({
                title: "Message Failed",
                text: "</ul'><h3'>Your mail could not be sent due to input errors.</h3><br> <?php  foreach ($errors as $msg) {
                        echo '<span2>' . $msg . '</span2>';
                    }?>",
                type: "error",
                showConfirmButton: true,
                html: true

            });

        }

        $(document).ready(function () {
            runAlert();


        });


    </script>
    <?php
                } else {
?>
                    <script>

        function runAlert() {

            swal({
                title: "Message Sent!",
                text: "<hr /><h3 class='reColor'>Your mail was sent. Thank you!</h3><hr /><p>Below is the message that you sent.</p><br> <?php echo "Message from " . $fname . " " . $lname . " <br />Phone: " . $phone . "<br />Email: " . $email . " <br />" ?>",
                type: "success",
                showConfirmButton: true,
                html: true

            });

        }

        $(document).ready(function () {
            runAlert();


        });


    </script>
    <?php
                }
            }
//End of errors array
            ?>

            <div class="contactHolder">
            <h2>Contact us</h2>
            <p>Fill out the form below.</p>
            <form class="formHolder" action="" method="post">
                <label>First Name: <br />
                    <input class="inputContact" name="firstname" type="text" placeholder="- Enter First Name -" /><br /></label>
                <label>Last Name: <br />
                    <input class="inputContact" name="lastname" type="text" placeholder="- Enter Last Name -" /><br /></label>
                <label>Phone Number: <br />
                    <input class="inputContact" name="phone" type="text" placeholder="- Enter Phone Number -" /><br /></label>
                <label>Email Address: <br />
                    <input class="inputContact" name="email" type="text" placeholder="- Enter Email Address -" /><br /></label>
                <label> How May We Help You?<br />
                    <textarea name="Enter your message here " rows="4" cols="50"></textarea> <br/>

                    <input class="inputContact" name="submitted" type="submit" value="Submit" />

            </div>
            </form>

        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
?> 
