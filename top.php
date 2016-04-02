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


        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->


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
        if ($path_parts['filename'] == "profileUpdate") {
            include "lib/validation-functions.php";
        }
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.8/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.8/slick-theme.css"/> -->



    </head>

    <!-- **********************     Body section      ********************** -->
    <?php
    $username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
    print '<body id="' . $path_parts['filename'] . '">';

    ?>


