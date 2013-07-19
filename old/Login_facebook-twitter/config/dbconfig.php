<?php

/*define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');  //user_alacut
define('DB_PASSWORD', '');  //Al@cut#2012
define('DB_DATABASE', 'work');  //mydomains_alacut
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());*/

define('DB_SERVER', 'mavajsunco.netfirmsmysql.com');
define('DB_USERNAME', 'alacut');  //user_alacut
define('DB_PASSWORD', '123456789');  //Al@cut#2012
define('DB_DATABASE', 'alacut');  //mydomains_alacut
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
