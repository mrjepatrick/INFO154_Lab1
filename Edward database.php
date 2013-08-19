 <?php
 //connect to your database
 mysql_connect("your.hostaddress.com", "within", "near") or die(mysql_error()); 
 mysql_select_db("Database_Name") or die(mysql_error()); 
 ?> 
 
 CREATE TABLE construct (within VARCHAR(6), near VARCHAR (30));
 insert into construct VALUES ("5 mile", "15 mile", "25 mile"), ("Philadelphia", "New Jersey", "New York", "Delaware")
 
 
 
 
 
