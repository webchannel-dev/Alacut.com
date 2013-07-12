<?php
$HOST   = 'localhost';
$DBNAME = 'alacut';				
$DBUSER = 'root';				
$DBPASSWORD = '';			
$DBCONNECT = mysql_connect($HOST,$DBUSER,$DBPASSWORD) or die("Connection failed");
mysql_select_db($DBNAME,$DBCONNECT) or die("Connection to Database failed");
?>
