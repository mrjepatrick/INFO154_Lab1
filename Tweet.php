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
    
    // Constructor
    public function __construct($json){
        $this->id = $json->id;
        $this->created_at = $json->created_at;
        $this->text = $json->text;
        $this->source = $json->source;
        $this->screen_name = $json->user->screen_name;
        $this->geo = $json->geo;
        $this->coordinates = $json->coordinates;
    }
    
}

?>
