<?php
	include('../config/config1.php');
	session_start();
	if($_SESSION['login_user_id']!=0 && $_SESSION['login_user_id']!="" )
	{
		mysql_query("UPDATE `post_comments` SET `status` = '1' WHERE `post_comment_id`='".$_POST['Cstatus']."'");
	}
?>