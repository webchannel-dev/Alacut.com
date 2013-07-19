<?php
include('../config/config1.php');
$q = strtolower($_GET["q"]);
if (!$q) return;
$sql = "SELECT distinct `full_name` FROM `alacut_member` where `full_name` LIKE '$q%' limit 10";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) 
{
	$cname = $rs['full_name'];
	echo "$cname\n";
}

?>