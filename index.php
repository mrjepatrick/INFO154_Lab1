<!--============================================================================
   Name   : index.php
   Purpose: INFO154 - Lab3
   Author : Jeremy Patrick
   Date   : August 5, 2013
 ============================================================================-->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>INFO 154 - Lab 3</title>
    </head>
    <body>
    <form action='controller.php' method="POST" name="tweetForm">
        <b>Twitter search term:</b><input type="text" name="keyword" size="25" maxlength="25" value="Real Madrid" /><br>
        <b>SQL username:</b> <input type="text" name="username" size="25" maxlength="25" value="root" /><br>
        <b>SQL password:</b> <input type="text" name="password" size="25" maxlength="25" value="root" /><br>
        <input type="submit" name="submit" value="Add to Database" />
    </form>
    </body>
</html>