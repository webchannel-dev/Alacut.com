<?php
require '../config/config1.php';
if(isset($_REQUEST['email']))
{
	$val = mysql_query("SELECT count(member_id) AS countuser FROM alacut_member WHERE email ='".$_REQUEST['email']."'");
	$val = mysql_fetch_array($val);
	if($val["countuser"]>0)
		echo "showError";
	else 
		echo "hideError";
		include('../script/emailValidate.php');
}
?>