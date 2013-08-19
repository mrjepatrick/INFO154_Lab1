<?php

function queryString($distance){
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
    $searchTerm = $_REQUEST['keyword'];
    //$geocode = $_REQUEST['geocode'];
    $near = $_REQUEST['near'];
    $within = $distance;//$_REQUEST['within'];
    $lang = $_REQUEST['lang'];
    $page = $_REQUEST['page'];
    $result_type = $_REQUEST['result_type'];
    $count = $_REQUEST['count'];
    $until = $_REQUEST['untilYear'].'-'.$_REQUEST['untilMonth'].'-'.$_REQUEST['untilDay'];
    $since_id = $_REQUEST['since_id'];
    $max_id = $_REQUEST['max_id'];
    
    $location = false;
    
    // Concatenated search parameters
    $queryString = '?q='.urlencode($searchTerm);
    //if ( $geocode && $geocode != '' && $geocode != "" ){
        //$queryString .= '&geocode='.urlencode($geocode);
    //}
//    if ( $near && $near != '' && $near != "" ){
//        $queryString .= '&near="'.urlencode($near).'"';
//        if ( $within && $within != '' && $within != "" ){
//            $queryString .= '&within='.urlencode($within);
//            $location = true;
//        }
//    }
    if ( $lang && $lang != '' && $lang != "" ){
        $queryString .= '&lang='.urlencode($lang);
    }
//    if ( $page && $page != '' && $page != "" ){
//        $queryString .= '&page='.urlencode($page);
//    }
    if ( $result_type && $result_type != '' && $result_type != "" ){
        $queryString .= '&result_type='.urlencode($result_type);
    }
    if ( $count && $count != '' && $count != "" ){
        $queryString .= '&count='.urlencode($count);
    }
    if ( $until && $until != '' && $until != "" ){
        $queryString .= '&until='.urlencode($until);
    }
//    if ( $since_id && $since_id != '' && $since_id != "" ){
//        $queryString .= '&since_id='.urlencode($since_id);
//    }
//    if ( $max_id && $max_id != '' && $max_id != "" ){
//        $queryString .= '&max_id ='.urlencode($max_id);
//    }
    
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
        if($location){
            $tweetObjects[] = new Tweet($tweet, $near, $within);
        } else {
            $tweetObjects[] = new Tweet($tweet);
        }
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
