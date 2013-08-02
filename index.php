<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab3
   Author : Jeremy Patrick
   Date   : July 27, 2013
 ============================================================================-->

<?php

header('Content-type: text/html; charset=utf-8');

ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
require 'Tweet.php';
require 'Database.php';

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1613577200-6ldEX4qSq1SfcpNssZyWrfnciJGBERAXJ5sve18",
    'oauth_access_token_secret' => "WSkDpmUpGqC7lZhUtC0KPgKfLgQg2hS94MxgZbec",
    'consumer_key' => "V0bsxLk1HOfUx6GQa3Rw9g",
    'consumer_secret' => "IzWMPjlcKondE9DdVUFtmY6XB3WLUrIktcyGCCTmo0"
);


/*******************************************************************************
 *  Perform a GET request and echo the response
 ******************************************************************************/
    // Base target url
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    
    // Search term
    $searchTerm = 'corgi';
    
    // Concatenated search parameters
    $queryString = '?q='.$searchTerm;

    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    
    // The json string response
    $jsonResponse = $twitter->setGetfield($queryString)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
    
    // Data converted to an array
    $twitterArray = json_decode($jsonResponse)->statuses;
    
    //test output
    print_r($twitterArray);
    // view individual tweet by index
    //print_r($twitterArray[0]);
   
    
    //file_put_contents('twitter.json', print_r($jsonResponse, 1), FILE_APPEND );
?>
