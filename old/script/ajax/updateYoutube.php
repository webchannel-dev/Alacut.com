<?php
include('../../config/config1.php');
 
$videoObject = $_POST['object'];
$videoId = $_POST['id'];
$description=$_POST['desc'];
$videoTitle=$_POST['title'];
 
	  $youtubeVideoSql = "UPDATE `upload_video` SET `video_name`='".$videoTitle."',`video_desc`='".$description."',`video_image`='http://img.youtube.com/vi/".$_POST['object']."/1.jpg' WHERE video_id=".$videoId;
	mysql_query($youtubeVideoSql);
	
?>