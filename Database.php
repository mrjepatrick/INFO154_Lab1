<?php

////////////////////////////////////////////////////////////////////////////////
//  DATABASE MANAGEMENT OBJECT CLASS
////////////////////////////////////////////////////////////////////////////////
    
class Database{
    var $db;
    
    public function __construct(){
        
        // Setup variables
        $username = 'root';
        $passwd = '';
        
        $host = 'localhost';

////////////////////////////////////////////////////////////////////////////////
//  CONNECT TO DATABASE
////////////////////////////////////////////////////////////////////////////////
        
        $dsn = 'mysql:host='.$host.';dbname=twitter';
        
        // Create new querying object
        try{
            $this->db = new PDO($dsn, $username, $passwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br> The "twitter" database does not exist. Creating it now...';
            try{
                
////////////////////////////////////////////////////////////////////////////////
//  BUILD NEW DATABASE STRUCTURE
////////////////////////////////////////////////////////////////////////////////

                $this->db = new PDO('mysql:host=localhost', $username, $password);
                $sql = "CREATE DATABASE twitter;
                        USE twitter;
                        CREATE TABLE tweets (
                            id VARCHAR(30) NOT NULL,
                            created_at DateTime,
                            from_user_id INT,
                            from_user_name VARCHAR(30),
                            profile_image_url VARCHAR(200),
                            text VARCHAR(150),
                            repeats INT,
                            PRIMARY KEY(id, created_at, from_user_id)
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
            (id, created_at, from_user_id, from_user_name, profile_image_url, text, repeats)
            VALUES (:id, :created_at, :from_user_id, :from_user_name, :profile_image_url, :text, :repeats)";
        try{
            $x = $this->db->prepare($sql);
            foreach($tweets as $t){
                $parameters = array(
                    ':id' => $t->id,
                    ':created_at' => date('Y-m-d H:i:s', strtotime($t->created_at)),
                    ':from_user_id' => $t->from_user_id,
                    ':from_user_name' => $t->from_user_name,
                    ':profile_image_url' => $t->profile_image_url,
                    ':text' => $t->getText(),
                    ':repeats' => $t->repeats
                );
                $x->execute($parameters);
            }
        } catch(PDOException $e) {
            die('insert attempt failed: '.$e->getMessage());
        }
    }

}

?>
