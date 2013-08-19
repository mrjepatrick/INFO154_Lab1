<!--============================================================================
   Name   : Tweet.php
   Purpose: INFO154 - Lab4
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
    var $near;
    var $within;
    
    // Constructor
    public function __construct($json, $near, $within){
        $this->id = $json->id;
        $this->created_at = $json->created_at;
        $this->text = $json->text;
        $this->source = $json->source;
        $this->screen_name = $json->user->screen_name;
        //$this->geo = $json->geo;
        //$this->coordinates = $json->coordinates;
        $this->iso_language_code = $json->metadata->iso_language_code;
        $this->near = $near;
        $this->within = $within;
    }
    
}

?>
