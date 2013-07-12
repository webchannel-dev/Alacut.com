<?php
include('../config/config1.php');

	$CommentApproveQry = "UPDATE `post_comments` SET `active` = '1' WHERE `post_comment_id`='".$_REQUEST['id']."'";
	mysql_query($CommentApproveQry);
	header("location: commentDetail.php");
?>