<!--============================================================================
   Name   : controller.php
   Purpose: INFO154 - Lab3
   Author : Jeremy Patrick
   Date   : August 5, 2013
 ============================================================================-->

<?php

ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
require 'Tweet.php';
require 'Database.php';

$settings = array(
    'oauth_access_token' => "1613577200-6ldEX4qSq1SfcpNssZyWrfnciJGBERAXJ5sve18",
    'oauth_access_token_secret' => "WSkDpmUpGqC7lZhUtC0KPgKfLgQg2hS94MxgZbec",
    'consumer_key' => "V0bsxLk1HOfUx6GQa3Rw9g",
    'consumer_secret' => "IzWMPjlcKondE9DdVUFtmY6XB3WLUrIktcyGCCTmo0"
);


/*******************************************************************************
 *  PERFORM A GET REQUEST
 ******************************************************************************/
    // Base target url
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    
    // Search term
    $searchTerm = urlencode($_REQUEST['keyword']);
    
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
    
/*******************************************************************************
 *  ECHO RESPONSE
 ******************************************************************************/
    // Test output
    //print_r($twitterArray);
    
    // View individual tweet by index
    //print_r($twitterArray[0]);
    
    // Export json to local file
    //file_put_contents('twitter.json', print_r($jsonResponse, 1), FILE_APPEND );
    
/*******************************************************************************
 *  ADD TWEETS TO DATABASE
 ******************************************************************************/
    // Organize incoming data
    foreach($twitterArray as $tweet){
        $tweetObjects[] = new Tweet($tweet);
    }

    // Local mySQL credentials
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    
    // Connect to database and insert data
    $db = new Database($username, $password);
    $db->insertTweets($tweetObjects);
    $db->close();
    
?>

