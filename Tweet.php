<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab3
   Author : Jeremy Patrick
   Date   : August 2, 2013
 ============================================================================-->

<?php

////////////////////////////////////////////////////////////////////////////////
//  TWEET OBJECT CLASS
////////////////////////////////////////////////////////////////////////////////

class Tweet{
    
    // Given properties
    var $id;
    var $created_at;
    var $text;
    var $source;
    var $screen_name;
    var $geo;
    var $coordinates;
    var $iso_language_code;
    
    // Constructor
    public function __construct($json){
        $this->id = $json->id;
        $this->created_at = $json->created_at;
        $this->text = $json->text;
        $this->source = $json->source;
        $this->screen_name = $json->user->screen_name;
        $this->geo = $json->geo;
        $this->coordinates = $json->coordinates;
        $this->iso_language_code = $json->metadata->iso_language_code;
        
//        $this->profile_image_url = mysql_real_escape_string($json->user->profile_image_url);
//        $this->in_reply_to_user_id = $json->retweeted_status->in_reply_to_user_id;
//        $this->user_id = $json->user->id;
//        $this->user_name = $json->user->name;
//        $this->user_created_at = $json->user->created_at;
    }
    
}

?>
