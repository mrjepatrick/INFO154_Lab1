<!--============================================================================
   Name   : results.php
   Purpose: INFO154 - Lab4
   Author : Le Nguyen
   Date   : August 18, 2013
 ============================================================================-->
<?php
    require 'Database.php';
    session_start();
    
    $searchTerm = $_SESSION['keyword'];

    $location = $_SESSION['location'];
    
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    
    $dbA = new Database($username, $password);
    $fiveMiles = $dbA->selectTweets($location, '5mi');
    $dbA->close();
    
    $dbB = new Database($username, $password);
    $tenMiles = $dbB->selectTweets($location, '10mi');
    $dbB->close();
    
    $dbC = new Database($username, $password);
    $fifteenMiles = $dbC->selectTweets($location, '15mi');
    $dbC->close();

?>

<html>
    <head>	
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INFO 154 - Lab 4 - Results</title>
        
        <style type="text/css">
            h1 {
                font-size: 48pt;
                color: #FFFFFF;
                background-color: #666666;
                margin-top: 0px;
                line-height: 56pt;
                text-align: center;
            }
            .links{
                text-align: left;
            }
            table {
                font-size: 10pt;
                display: inline-table;
                margin: 5px;
                text-align: left;
            }
            body{
                text-align: center;
            }
        </style>
        
    </head>
    <body>
        <h1>INFO 154 - Lab 4 - Results</h1>
        <hr>
        <span class="links">
            <?php echo 'Tweets containing "<b><em>'.$searchTerm.'</em></b>" in the'; ?>
            <?php
                if($location==='ph'){
                    $near = 'Philadelphia';
                } else if ($location==='ny'){
                    $near = 'New York';
                } else if ($location==='sf'){
                    $near = 'San Francisco';
                } else if ($location==='ch'){
                    $near = 'Chicago';
                }
                echo '<b><em>'.$near.'</em></b> area.';
                
            ?>
            -
            <a href="index.html">Back to inputs page</a>
        </span>
        <hr>
        <table width="30%" border ="1" cellspacing = "0" cellpadding = "1">
            <tr>
                <td colspan= "3" align="center"><b>Within 5 miles</b></td>
            </tr>
            <tr>
                <td> Name</td>
                <td> Tweet</td>
                <td> Date created</td>
            </tr>
            <?php
                foreach($fiveMiles as $tweet){
                    $fiveString = "<tr>
                        <td>".$tweet['screen_name']."</td>
                        <td>".$tweet['text']."</td>
                        <td>".$tweet['created_at']."</td>
                    </tr>";
                    echo $fiveString;
                }
            ?>
        </table>
        <table  width = "30%" border ="1" cellspacing = "0" cellpadding = "1">
            <tr>
                <td colspan= "3" align="center"><b>Within 10 miles</b></td>
            </tr>
            <tr>
                <td> Name</td>
                <td> Tweet</td>
                <td> Date created</td>
            </tr>
            <?php
                foreach($tenMiles as $tweet){
                    $tenString = "<tr>
                        <td>".$tweet['screen_name']."</td>
                        <td>".$tweet['text']."</td>
                        <td>".$tweet['created_at']."</td>
                    </tr>";
                    echo $tenString;
                }
            ?>
        </table>
        <table  width = "30%" border ="1" cellspacing = "0" cellpadding = "1">
            <tr>
                <td colspan= "3" align="center"><b>Within 15 miles</b></td>
            </tr>
            <tr>
                <td> Name</td>
                <td> Tweet</td>
                <td> Date created</td>
            </tr>
            <?php
                foreach($fifteenMiles as $tweet){
                    $fifteenString = "<tr>
                        <td>".$tweet['screen_name']."</td>
                        <td>".$tweet['text']."</td>
                        <td>".$tweet['created_at']."</td>
                    </tr>";
                    echo $fifteenString;
                }
            ?>
        </table>
    </body>
</html>
