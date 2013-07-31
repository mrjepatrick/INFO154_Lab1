<?php

////////////////////////////////////////////////////////////////////////////////
//  DATABASE MANAGEMENT OBJECT CLASS
////////////////////////////////////////////////////////////////////////////////
    
class Database{
    var $db;
    
    public function __construct($dbname){
        
        // Setup variables
        $username = 'root';
        $passwd = '';
        
        $host = 'localhost';

////////////////////////////////////////////////////////////////////////////////
//  CONNECT TO DATABASE
////////////////////////////////////////////////////////////////////////////////
        
        $dsn = 'mysql:host='.$host.';dbname='.$dbname;
        
        // Create new querying object
        try{
            $this->db = new PDO($dsn, $username, $passwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br> The '.$dbname.' database does not exist. Creating it now...';
            try{
                
////////////////////////////////////////////////////////////////////////////////
//  BUILD NEW DATABASE STRUCTURE
////////////////////////////////////////////////////////////////////////////////

                $this->db = new PDO('mysql:host=localhost', $username, $passwd);
                //$sql = addToDB($results, $dbname, $tableName, $columns);
                $sql = "CREATE DATABASE $dbname;
                        USE $dbname;
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
    public function clearTable(){
        try{
            $x = $this->db->prepare('TRUNCATE TABLE tweets');
            $x->execute();
        } catch (PDOException $e){
            die('Attempt failed: '.$e->getMessage());
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

////////////////////////////////////////////////////////////////////////////////
//  COUNT TWEETS IN LOCAL DATABASE
////////////////////////////////////////////////////////////////////////////////
    public function countEntries(){
        try{
            // Count the tweets!
            $y = $this->db->prepare('SELECT COUNT(*) FROM tweets');
            $y->execute();
        } catch (PDOException $e){
            die('Attempt failed: '.$e->getMessage());
        }
        // Return the counted value
        return ($y->fetchColumn());
    }
    
////////////////////////////////////////////////////////////////////////////////
//  SEARCH LOCAL DATABASE
////////////////////////////////////////////////////////////////////////////////
    public function search($query){
        try {
            $z = $this->db->prepare($query);
            $z->execute();
        } catch (PDOException $e){
            die('Query failed: '.$e->getMessage());
        }
        
        $tableData =  '<table border=1>';
        
        $heading = true;
        while (($row = $z->fetch(PDO::FETCH_ASSOC))){
            
            $tableData .= '<tr>';
            
            if($heading){
                $keys = array_keys($row);
                foreach($keys as $k){
                    $tableData .= '<th>' . $k . '</th>';
                }
                $tableData .= '</tr><tr>';
                $heading = false;
            }
            
            foreach($row as $r => $v){
                $tableData .= '<td>'.$v.'</td>';
            }
            $tableData .= '</tr>';
        }
        $tableData .= '</table>';
        
        return $tableData;
    }
    
    

////////////////////////////////////////////////////////////////////////////////
//////  Print directly from Twitter response
        
//    function printData($results){
//        // Print results
//        echo '<table border="1">';
//        echo '<tr>';
//        foreach( array_keys($results) as $key ){
//            echo '<th>'.ucfirst($key).'</th>';
//        }
//        echo '</tr>';
//
//        foreach($results as $row){
//            echo '<tr><td>'.$row['user_id'].'</td><td>'.$row['time'].'</td><td>'.$row['text'].'</td></tr>';
//        }
//        echo '</table>';
//
//        return true;
//    }
//    
//    function printSpec($db){
//        // Construct query string
//        $sql = "SELECT user_id,time,text FROM tweets LIMIT 5";
//        // Grab data from Twitter
//        $results = $db->query($sql);
//
//        printData($results);
//    }

}

?>
