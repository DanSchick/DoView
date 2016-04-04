<?php
include "lib/constants.php";
require_once('lib/custom-functions.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DoView</title>
        <meta charset="utf-8">
        <meta name="author" content="Seal Team 6">
        <meta name="description" content="Registration">

        <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700|Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <link rel="stylesheet" href="reset.css" type="text/css" media="screen">
        <link rel="stylesheet" href="custom.css" type="text/css" media="screen">
        <link rel="stylesheet" href="DoView.css" type="text/css" media="screen" title="creative">
        <link rel="shortcut icon" href="doView_3-1.png">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->


        <!-- ############################################################################# ->
        <1-- SPIN JS -->
<!--         <style>
    #spin {
        background: #333;
        color: white;
        float: left;
        width: 200px;
        height: 200px;
        margin: 0 20px 20px 0;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        }
    </style>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://fgnass.github.com/spin.js/spin.js"></script>
    <script type="text/javascript">
        $.fn.spin = function(opts) {
            this.each(function() {
                var $this = $(this),
                    spinner = $this.data('spinner');
                if (spinner) spinner.stop();
                if (opts !== false) {
                  opts = $.extend({color: $this.css('color')}, opts);
                  spinner = new Spinner(opts).spin(this);
                  $this.data('spinner', spinner);
                }
            });
            return this;
        };
        $(function() {
            $(".spinner-link").click(function(e) {
                e.preventDefault();
                $(this).hide();
                var opts = {
                  lines: 12, // The number of lines to draw
                  length: 7, // The length of each line
                  width: 5, // The line thickness
                  radius: 10, // The radius of the inner circle
                  color: '#fff', // #rbg or #rrggbb
                  speed: 1, // Rounds per second
                  trail: 66, // Afterglow percentage
                  shadow: true // Whether to render a shadow
                };
                $("#spin").show().spin(opts);
            });

        });

        setTimeout(function(){ $("#spin").spin(false); }, 3000);

    </script>
 -->




   <div class="nav-wrap" id="link">
        <!-- <a class="spinner-link" href="/cs008">About Us</a> -->
    <div id= "spin" style="display:none;"></div>
    <a href='index.php'><img src="uvmlogo2014.svg"></a>
    <nav>
        <ol>
            <?php
            if ($path_parts['filename'] == "index") {
                 print '<li class="active">Home</li>';
            }else{
                 print '<li><a href="index.php">Home</a></li>';
            }
            if ($path_parts['filename'] == "courseForm") {
                 print '<li class="active">Select Courses</li>';
            }else{
                print '<li><a href="courseForm.php">Select Courses</a></li>';
            }
              if ($path_parts['filename'] == "schedule") {
                 print '<li class="active">View Schedule</li>';
            }else{
                print '<li><a href="schedule.php">View Schedule</a></li>';
            }

              if ($path_parts['filename'] == "profile") {
                 print '<li class="active">Profile</li>';
            }else{
                print '<li><a href="profile.php">Profile</a></li>';
            }
         ?>
        </ol>
    </nav>
</div>


    <!-- ####################################################################################################### -->


        <?php
        $debug = false;

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. Note some are in lib and some are in bin
        // bin should be located at the same level as www-root (it is not in
        // github)
        //
        // yourusername
        //     bin
        //     www-logs
        //     www-root


        $includeDBPath = "../bin/";
        $includeLibPath = "../lib/";


        //require_once($includeLibPath . 'mailMessage.php');

        require_once('lib/Database.php');

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // PATH SETUP
        //

        // sanitize the server global variable
        $_SERVER = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
        foreach ($_SERVER as $key => $value) {
            $_SERVER[$key] = sanitize($value, false);
        }

        $domain = "//"; // let the server set http or https as needed

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }

        $yourURL = $domain . $phpSelf;

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        // sanatize global variables
        // function sanitize($string, $spacesAllowed)
        // no spaces are allowed on most pages but your form will most likley
        // need to accept spaces. Notice my use of an array to specfiy whcih
        // pages are allowed.
        // generally our forms dont contain an array of elements. Sometimes
        // I have an array of check boxes so i would have to sanatize that, here
        // i skip it.

        $spaceAllowedPages = array("form.php");

        if (!empty($_GET)) {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            foreach ($_GET as $key => $value) {
                $_GET[$key] = sanitize($value, false);
            }
        }

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //

        $dbUserName = 'dschick_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = 'dschick_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = 'dschick_admin';
        $whichPass = "a";
        $thisDatabaseAdmin = new Database($dbUserName, $whichPass, $dbName);
        include "lib/validation-functions.php";
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- JQUERY -->
        <script   src="https://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
        <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>



    </head>

    <!-- **********************     Body section      ********************** -->
    <?php
    $username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
    print '<body id="' . $path_parts['filename'] . '">';
    ?>


