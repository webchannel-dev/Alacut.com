<?php
	include('../../config/config1.php');
	echo $_POST['Cstatus']; echo "1";
	mysql_query("UPDATE `post_comments` SET `status` = '1' WHERE `post_comment_id`='".$_POST['Cstatus']."'");
?>