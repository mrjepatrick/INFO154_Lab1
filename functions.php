<!--============================================================================
   Name   : functions.php
   Purpose: INFO154 - Lab4
   Author : Jeremy Patrick
   Date   : August 18, 2013
 ============================================================================-->

<?php

function executeRequest($distance){
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
    
    // Form inputs
    $searchTerm = $_REQUEST['keyword'];
    $location = $_REQUEST['location'];
    $lang = $_REQUEST['lang'];
    $result_type = $_REQUEST['result_type'];
    $count = $_REQUEST['count'];
    $until = $_REQUEST['untilYear'].'-'.$_REQUEST['untilMonth'].'-'.$_REQUEST['untilDay'];
    $since_id = $_REQUEST['since_id'];
    $max_id = $_REQUEST['max_id'];
        
    // Concatenated search parameters
    $queryString = '?q='.urlencode($searchTerm);
    if ( $since_id && $since_id != '' && $since_id != "" ){
        $queryString .= '&since_id='.urlencode($since_id);
    }
    if ( $max_id && $max_id != '' && $max_id != "" ){
        $queryString .= '&max_id='.urlencode($max_id);
    }
    if ( $result_type && $result_type != '' && $result_type != "" ){
        $queryString .= '&result_type='.urlencode($result_type);
    }
    if ( $count && $count != '' && $count != "" ){
        $queryString .= '&count='.urlencode($count);
    }
    if ( $location && $location != '' && $location != "" ){
        if($location==='ph'){
            $near = '39.975278,-75.152321,';
        } else if ($location==='ny'){
            $near = '40.714353,-74.005973,';
        } else if ($location==='sf'){
            $near = '37.77493,-122.419416,';
        } else if ($location==='ch'){
            $near = '41.970722,-87.6297,';
        } else {
            $near = null;
        }
        
        $queryString .= '&geocode='.urlencode($near.$distance);
        
    }
    if ( $lang && $lang != '' && $lang != "" ){
        $queryString .= '&lang='.urlencode($lang);
    }
    if ( $until && $until != '' && $until != "" ){
        $queryString .= '&until='.urlencode($until);
    }
    
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
        $tweetObjects[] = new Tweet($tweet, $location, $distance);
    }

    // Local mySQL credentials
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    
    // Connect to database and insert data
    $db = new Database($username, $password);
    $db->insertTweets($tweetObjects);
    $db->close();
}

?>
