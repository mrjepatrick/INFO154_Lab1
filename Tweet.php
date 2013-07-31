<?php

////////////////////////////////////////////////////////////////////////////////
//  TWEET OBJECT CLASS
////////////////////////////////////////////////////////////////////////////////

class Tweet{
    
    // Given properties
    var $id;
    var $created_at;
    var $from_user_id;
    var $from_user_name;
    //var $to_user_id;
    //var $to_user_name;
    //var $geo;
    var $profile_image_url;
    private $text;
    var $repeats;
    
    // Constructor
    public function __construct($json){
        $this->id = strval($json->id);
        //$this->date = $json->date;
        $this->from_user_id = $json->from_user_id;
        //$this->to_user_id = $json->to_user_id;
        //$this->to_user_name = $json->to_user_name;
        //$this->geo = $json->geo;
        $this->profile_image_url = $json->profile_image_url;
        $this->created_at = $json->created_at;
        $this->from_user_name = $json->from_user_name;
        $this->text = $json->text;
        $this->repeats = 0;
    }
    
    function getText(){
        return $this->text;
    }
    
    function getStringInHTML(){
        return "Time: ".$this->created_at."Name: ".$this->from_user_name."Text: ".$this->getText()."<br>";
    }
    
}

?>
