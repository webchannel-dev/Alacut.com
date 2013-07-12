<?php
include('../config/config1.php');

	$deleteCommentQry = "UPDATE `post_comments` SET `status` = '2' WHERE `post_comment_id`='".$_REQUEST['id']."'";
	mysql_query($deleteCommentQry);
	header("location: commentDetail.php");
?>
