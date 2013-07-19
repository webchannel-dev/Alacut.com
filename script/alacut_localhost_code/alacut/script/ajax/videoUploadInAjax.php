<?php
session_start();
include('../../config/config1.php');
require_once("../../lib/db.function.php"); 
$member_id = $_SESSION['login_user_id'];

	if($_POST['type'] == 'youtube')
	{
		$videoObject = $_POST['object'];
		$videoInfo = parseVideoEntry($videoObject);		
		$title = $videoInfo->title;
		$videoTitle = str_replace(array("'")," ",$title); 
		$Desc = $videoInfo->description; 
		$Description = str_replace(array("'")," ",$Desc);
	 $youtubeVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$member_id."','".$videoTitle."','".$_POST['url']."','".$_POST['object']."','".$Description."','".$_POST['type']."')";
	/*$youtubeVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$member_id."','".$videoTitle."','".$_POST['url']."','".$_POST['object']."','".$Description."','".$_POST['type']."')";*/
	mysql_query($youtubeVideoSql);
	}else if($_POST['type'] == 'vimeo'){
		$videoObject = $_POST['object'];
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$videoObject.".php")); 
		$hash = $hash[0];
		$description = $hash['description'];
		$desc = str_replace(array("'")," ",$description);
		$title = $hash['title'];
		$tit = str_replace(array("'")," ",$title);
		$duration = $hash['duration'];
	 $vimeoVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$member_id."','".$tit."','".$_POST['url']."','".$_POST['object']."','".$desc."','".$_POST['type']."')";
	mysql_query($vimeoVideoSql);
	}
?>