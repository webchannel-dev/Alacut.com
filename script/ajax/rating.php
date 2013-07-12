<?php
session_start();
include('../../config/config1.php');
$member_id = $_SESSION['login_user_id'];

if($_SESSION['login_user_id']!=0 || $_SESSION['login_user_id']!="")
{
	$id=$_POST['id'];  
	$name=$_POST['name']; 
	$Qry = "SELECT `like_id`,`status` FROM `video_like` WHERE memberID = '".$member_id."' AND videoID = '".$id."' ";
	$QryRes = mysql_query($Qry);
	$QryL=mysql_fetch_array($QryRes);
	$QryNum = mysql_num_rows($QryRes);
		if($QryNum > 0 )
		{
		if($QryL['status']!=$name && ($name == 'like' || $name == 'dislike'))
		{
			mysql_query("UPDATE `video_like` SET `status`='".$name."' WHERE videoID='".$id."' AND memberID = '".$member_id."'");
			if($name == 'like')
			{
				$updateLikeQry = "UPDATE `upload_video` SET `like` = `like` + 1,`dislike` = CASE `dislike` WHEN 0 THEN 0 ELSE `dislike` - 1 END,`status`='1'   WHERE video_id = '".$id."'";
				mysql_query($updateLikeQry);
				$QryRes = mysql_query("SELECT `like`,`dislike` FROM `upload_video` WHERE  video_id ='".$id."'");
				$QryRes=mysql_fetch_array($QryRes);
				echo ($QryRes["like"].':'.$QryRes["dislike"]);
			}
		else
			{
				$updateDisLikeQry = "UPDATE `upload_video` SET `like` = CASE `like` WHEN 0 THEN 0 ELSE `like` - 1 END,`dislike` = `dislike` + 1,`status`='1'   WHERE video_id = '".$id."'";
				mysql_query($updateDisLikeQry);
				$QryRes = mysql_query("SELECT `like`,`dislike` FROM `upload_video` WHERE  video_id ='".$id."'");
				$QryRes=mysql_fetch_array($QryRes);
				echo ($QryRes["like"].':'.$QryRes["dislike"]);
			}
		}
}else
{
	if($name == 'like')
		{
			$insertQry = "INSERT INTO `video_like`(`videoID`,`memberID`,`status`) VALUES('".$id."','".$member_id."','".$name."')";
			mysql_query($insertQry);
			$updateLikeQry = "UPDATE `upload_video` SET `like` = `like` + 1,`dislike` = CASE `dislike` WHEN 0 THEN 0 ELSE `dislike` - 1 END,`status`='1'   WHERE video_id = '".$id."'";
			mysql_query($updateLikeQry);
			$QryRes = mysql_query("SELECT `like`,`dislike` FROM `upload_video` WHERE  video_id ='".$id."'");
			$QryRes=mysql_fetch_array($QryRes);
			echo ($QryRes["like"].':'.$QryRes["dislike"]);
		}
	else
		{
			$insertQry = "INSERT INTO `video_like`(`videoID`,`memberID`,`status`) VALUES('".$id."','".$member_id."','".$name."')";
			mysql_query($insertQry);
			$updateDisLikeQry = "UPDATE `upload_video` SET `like` = CASE `like` WHEN 0 THEN 0 ELSE `like` - 1 END,`dislike` = `dislike` + 1,`status`='1'   WHERE video_id = '".$id."'";
			mysql_query($updateDisLikeQry);
			$QryRes = mysql_query("SELECT `like`,`dislike` FROM `upload_video` WHERE  video_id ='".$id."'");
			$QryRes=mysql_fetch_array($QryRes);
			echo ($QryRes["like"].':'.$QryRes["dislike"]);
		}
}
		
}
?>
    

