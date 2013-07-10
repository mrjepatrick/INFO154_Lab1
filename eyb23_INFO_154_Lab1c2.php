<!--============================================================================
   Name   : eyb23_INFO_154_Lab1c.php
   Purpose: INFO154 - Lab1 c
   Author : Edward Budihardjo
   Date   : July 8, 2013
 ============================================================================-->

<!DOCTYPE html>
<html>
    <head>
          <title>
                Welcome to Lab 1 - Alpha Numeric Validation 
           </title>        

    </head>

    <body>
        <center>
            <font face = 'times new roman' size = '5'>
                Welcome to Alpha Numeric Search Engine
                <br/>
                <br/>
                Please Input Alpha or Numeric to test!
                <br />
                <br />
                <form action="eyb23_INFO_154_Lab1c.php" method="POST" name="alphaForm" onsubmit="return checkAlpha();" >
                    <em>Validate alphabetic</em> <input type="text" name="keyword" size="25" maxlength="25" value="" />
                    <input type="submit" name="validateAlpha" value="Validate" />
                </form>
                <br/>
                <form action="eyb23_INFO_154_Lab1c.php" method="POST" name="bForm" onsubmit="return checkB();" >
                    <em>Validate Numeric</em> <input type="text" name="number" size="25" maxlength="25" value="" />
                    <input type="submit" name="validateB" value="Validate" />
                </form>
            </font>
        </center>
    </body>

</html>
