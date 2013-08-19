<!--============================================================================
   Name   : controller.php
   Purpose: INFO154 - Lab4
   Author : Jeremy Patrick
   Date   : August 5, 2013
 ============================================================================-->

<?php

    ini_set('display_errors', 1);
    require_once('TwitterAPIExchange.php');
    require 'Tweet.php';
    require 'Database.php';
    require 'functions.php';

    //Perform request using user inputs for 3 different distance values
    executeRequest('5mi');
    executeRequest('10mi');
    executeRequest('15mi');

    //Redirect to results.php when finished
//    header("Location: results.php");

?>

