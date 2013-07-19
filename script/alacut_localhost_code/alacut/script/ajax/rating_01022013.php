<?php
include('../../config/config1.php');
session_start();
$user_check = $_SESSION['login_user_id'];

if($_POST['id'])
{
	$id=mysql_escape_String($_POST['id']);  //echo $id;
	$name=mysql_escape_String($_POST['name']); //echo $name;
	
	$insertQry = "INSERT INTO `video_like`(`videoID`,`memberID`,`status`) VALUES('$id','$user_check','$name')";
	mysql_query($insertQry);
	
	if($name == 'like')
		{
			$updateLikeQry = "UPDATE `upload_video` SET `like` = `like` + 1 WHERE video_id = '$id'";
			mysql_query($updateLikeQry);
		}
	else
		{
			$updateDisLikeQry = "UPDATE `upload_video` SET `dislike` = `dislike` + 1 WHERE video_id = '$id'";
			mysql_query($updateDisLikeQry);
		}
	}
?>