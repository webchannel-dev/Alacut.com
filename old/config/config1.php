<?php
define('SITE_URL','http://www.alacut.com/'); 
$HOST   = '176.32.230.29:3306';
$DBNAME = 'cl49-alacut';				
$DBUSER = 'cl49-alacut';				
$DBPASSWORD = 'alacut';			
$DBCONNECT = mysql_connect($HOST,$DBUSER,$DBPASSWORD) or die("Connection failed");
mysql_select_db($DBNAME,$DBCONNECT) or die("Connection to Database failed");


?>
