<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab1 c
   Author : 
   Date   : 
 ============================================================================-->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lab1 - Alpha Numeric Validation Scripts</title>
        <link rel="stylesheet" type="text/css" href="jep322_INFO154_Lab1c_styles.css">
    </head>
    
    <!-- Includes script to validate alphabetic entries -->
    <script type="text/javascript" src="jep322_INFO154_Lab1a.js"></script>
    
    <!-- Includes script to validate numeric entries -->
    <script type="text/javascript" src="lnn25_INFO154_Lab1b.js"></script>
    
    <body>
        
    <!--/////////////////////////////////////////////////////////////////////
        // MAIN HEADER
        /////////////////////////////////////////////////////////////////////-->
            <h1>Lab1 Alpha Numeric Validation</h1>
        
    <!--/////////////////////////////////////////////////////////////////////
        // ALPHABETIC VALIDATION FORM
        /////////////////////////////////////////////////////////////////////-->
            <form action="jep322_INFO154_Lab1c.php" method="POST" name="alphaForm" onsubmit="return checkAlpha();" >
                <em>Validate alphabetic</em> <input type="text" name="keyword" size="25" maxlength="25" value="" />
                <input type="submit" name="validateAlpha" value="Validate" />
            </form>
    
            <br />
            <br />
            <br />
            
    <!--/////////////////////////////////////////////////////////////////////
        // NUMERIC VALIDATION FORM
        /////////////////////////////////////////////////////////////////////-->
            <form action="jep322_INFO154_Lab1c.php" method="POST" name="bForm" onsubmit="return checkB();" >
                <em>Validate Numeric</em> <input type="text" name="number" size="25" maxlength="25" value="" />
                <input type="submit" name="validateB" value="Validate" />
             </form>
            
    </body>
</html>

