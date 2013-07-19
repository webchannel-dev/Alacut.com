<?php
include('../../config/config1.php'); 
	
	$CommentDisApproveQry = "UPDATE `post_comments` SET `active` = '0' WHERE `post_comment_id`='".$_REQUEST['id']."'";
	mysql_query($CommentDisApproveQry);
	header("location: commentDetail.php");
?>