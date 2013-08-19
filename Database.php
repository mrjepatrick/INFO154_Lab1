<!--============================================================================
   Name   : Database.php
   Purpose: INFO154 - Lab4
   Author : Jeremy Patrick
   Date   : August 2, 2013
 ============================================================================-->

<?php

////////////////////////////////////////////////////////////////////////////////
//  DATABASE MANAGEMENT OBJECT CLASS
////////////////////////////////////////////////////////////////////////////////
    
class Database{
    
    // Setup variables
    var $db;
    
    public function __construct($username, $password){
        
        $host = 'localhost';

////////////////////////////////////////////////////////////////////////////////
//  CONNECT TO DATABASE
////////////////////////////////////////////////////////////////////////////////
        
        $dsn = 'mysql:host='.$host.';dbname=twitter';
                
    ////////////////////////////////////////////////////////////////////////////
    //  CHECK FOR EXISTING DATABASE
    ////////////////////////////////////////////////////////////////////////////
        
        try{
        // Create new querying object
            $this->db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br> The "twitter" database does not exist. Creating it now...';
            try{
                
    ////////////////////////////////////////////////////////////////////////////
    //  BUILD NEW DATABASE STRUCTURE
    ////////////////////////////////////////////////////////////////////////////

                $this->db = new PDO('mysql:host=localhost', $username, $password);
                $sql = "CREATE DATABASE twitter;
                        USE twitter;
                        CREATE TABLE tweets (
                            id VARCHAR(30) NOT NULL,
                            created_at DateTime,
                            text VARCHAR(150),
                            source VARCHAR(200),
                            screen_name VARCHAR(30),
                            iso_language_code VARCHAR(2),
                            near VARCHAR(30),
                            within VARCHAR(6),
                            PRIMARY KEY(id, created_at)
                        );";
                $this->db->exec($sql);
                echo 'Done!<br>';
            } catch (PDOException $e) {
                echo $e->getMessage();
                exit();
            }
        }
    }
    
////////////////////////////////////////////////////////////////////////////////
//  CLEAR CONNECTION CREDENTIALS
////////////////////////////////////////////////////////////////////////////////
    public function close(){
        try{
            $this->db = null;
        } catch (PDOException $e){
            echo $e->getMessage()." Exit!";
            exit();
        }
    }
    
////////////////////////////////////////////////////////////////////////////////
//  ADD TWEETS TO LOCAL DATABASE
////////////////////////////////////////////////////////////////////////////////
    public function insertTweets($tweets){
        $sql = "INSERT INTO tweets
            (id, created_at, text, source, screen_name, iso_language_code, near, within)
            VALUES (:id, :created_at, :text, :source, :screen_name, :iso_language_code, :near, :within)";
        try{
            $x = $this->db->prepare($sql);
            foreach($tweets as $t){
                $parameters = array(
                    ':id' => utf8_encode($t->id),
                    ':created_at' => utf8_encode(date('Y-m-d H:i:s', strtotime($t->created_at))),
                    ':text' => utf8_encode($t->text),
                    ':source' => utf8_encode($t->source),
                    ':screen_name' => utf8_encode($t->screen_name),
                    //':geo' => utf8_encode($t->geo),
                    //':coordinates' => utf8_encode($t->coordinates),
                    ':iso_language_code' => utf8_encode($t->iso_language_code),
                    ':near' => utf8_encode($t->near),
                    ':within' => utf8_encode($t->within)
                );
                $x->execute($parameters);
            }
        } catch(PDOException $e) {
            die('insert attempt failed: '.$e->getMessage());
        }
    }
        
////////////////////////////////////////////////////////////////////////////////
//  SELECT TWEETS FROM LOCAL DATABASE
////////////////////////////////////////////////////////////////////////////////
    public function selectTweets($location, $distance){
        $sql = "SELECT * FROM tweets
                WHERE (near = :near) AND (within = :within)
                ORDER BY created_at DESC LIMIT 50;";
        try{
            $z = $this->db->prepare($sql);
            $z->execute( array(':near' => $location, ':within' => $distance) );
            $result = $z->fetchAll();
            
            if( empty($result) ){
                return false;
            } else {
                return $result;
            }
        } catch(PDOException $e) {
            die('select attempt failed: '.$e->getMessage());
        }
    }

}

?>
