<?php
session_start();
include('../config/config1.php');
require_once("../lib/db.function.php"); 

$sqlquery="SELECT video_id,video_object,video_desc from `upload_video` WHERE `video_type`='vimeo' AND (video_image IS NULL OR video_desc='')";
$result=mysql_query($sqlquery);

while($resultArr = mysql_fetch_array($result)) { 
	$vimeoDetails = vimeoVideoDetails($resultArr["video_object"]);
	
	$img=$vimeoDetails->thumbnail_medium;
	$vimeoVideoSql = "UPDATE `upload_video` SET `video_image`='".$img."' WHERE video_id=".$resultArr["video_id"];
	mysql_query($vimeoVideoSql);
}
echo 'finished';
?>