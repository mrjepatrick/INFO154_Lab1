<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab2
   Author : Jeremy Patrick
   Date   : July 27, 2013
 ============================================================================-->

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1613577200-6ldEX4qSq1SfcpNssZyWrfnciJGBERAXJ5sve18",
    'oauth_access_token_secret' => "WSkDpmUpGqC7lZhUtC0KPgKfLgQg2hS94MxgZbec",
    'consumer_key' => "V0bsxLk1HOfUx6GQa3Rw9g",
    'consumer_secret' => "IzWMPjlcKondE9DdVUFtmY6XB3WLUrIktcyGCCTmo0"
);


/*******************************************************************************
 * Perform a POST request and echo the response
 ******************************************************************************/
// URL for REST request, see: https://dev.twitter.com/docs/api/1.1/
//$url = 'https://api.twitter.com/1.1/blocks/create.json';
//$requestMethod = 'POST';
//
//    $postfields = array(
//        'screen_name' => 'usernameToBlock', 
//        'skip_status' => '1'
//    );
//
//    $twitter = new TwitterAPIExchange($settings);
//    echo $twitter->buildOauth($url, $requestMethod)
//                 ->setPostfields($postfields)
//                 ->performRequest();


/*******************************************************************************
 *  Perform a GET request and echo the response
 ******************************************************************************/
    /** Note: Set the GET field BEFORE calling buildOauth(); **/
    // follower_ids
    //$url = 'https://api.twitter.com/1.1/followers/ids.json';
    // tweets
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $getfield = '?q=corgi';

    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    echo $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
    //file_put_contents('tweets.json', print_r($output, 1), FILE_APPEND );
?>
