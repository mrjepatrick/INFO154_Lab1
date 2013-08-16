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
    <body style="line-height:20pt;">
    <form action='controller.php' method="POST" name="tweetForm">
        <b>Twitter search term:</b> <input type="text" name="keyword" size="25" maxlength="25" value="Real Madrid" /><br>
        <b>Tweet near:</b> <input type="text" name="near" size="25" maxlength="25" value="philadelphia" /> <br>
        <b>Within distance:</b> <input type="text" name="within" size="6" maxlength="6" value="15mi" /> <br>
        <!--<b>Tweet geocode:</b> <input type="text" name="geocode" size="25" maxlength="25" value="37.781157,-122.398720,1mi" /> <br>-->
        <b>Language:</b> <select name="lang">
            <option value="en">English</option>
            <option value="ja">Japanese</option>
            <option value="pt">Portuguese</option>
            <option value="in">Indonesian</option>
        </select><br>
        <b>Result page to return:</b> <input type="text" name="page" size="4" maxlength="4" value="1" /> <br>
        <b>Result type:</b> <select name="result_type">
            <option value="mixed">Mixed</option>
            <option value="recent">Recent</option>
            <option value="popular">Popular</option>
        </select> <br>
        <b>Number of results:</b> <input type="text" name="rpp" size="4" maxlength="4" value="100" /> <br>
        <b>Return before:</b> <input type="text" name="until" size="10" maxlength="10" value="2010-03-28" /> <br>
        <b>Return tweet ids after:</b> <input type="text" name="since_id" size="25" maxlength="25" value="12345" /> <br>
        <b>Return tweet ids before:</b> <input type="text" name="max_id" size="25" maxlength="25" value="54321" /><br><br>
       
        <b>SQL username:</b> <input type="text" name="username" size="25" maxlength="25" value="root" /><br>
        <b>SQL password:</b> <input type="text" name="password" size="25" maxlength="25" value="root" /><br>
        <input type="submit" name="submit" value="Add to Database" />
    </form>
    </body>
</html>