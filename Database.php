<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab3
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
                            geo VARCHAR(100),
                            coordinates VARCHAR(100),
                            iso_language_code VARCHAR(2),
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
            (id, created_at, text, source, screen_name, geo, coordinates, iso_language_code)
            VALUES (:id, :created_at, :text, :source, :screen_name, :geo, :coordinates, :iso_language_code)";
        try{
            $x = $this->db->prepare($sql);
            foreach($tweets as $t){
                $parameters = array(
                    ':id' => $t->id,
                    ':created_at' => date('Y-m-d H:i:s', strtotime($t->created_at)),
                    ':text' => $t->text,
                    ':source' => $t->source,
                    ':screen_name' => $t->screen_name,
                    ':geo' => $t->geo,
                    ':coordinates' => $t->coordinates,
                    ':iso_language_code' => $t->iso_language_code
                );
                $x->execute($parameters);
            }
        } catch(PDOException $e) {
            die('insert attempt failed: '.$e->getMessage());
        }
    }

}

?>
