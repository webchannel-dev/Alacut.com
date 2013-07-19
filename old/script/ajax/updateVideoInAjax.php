<?php
include('../../config/config1.php');

$title = mysql_real_escape_string($_POST['title']);
echo $desc = mysql_real_escape_string($_POST['desc']);

 
	$updateQry = "UPDATE `upload_video` SET `video_name`='".$title."',`video_desc`='".$desc."' WHERE `video_id`='".$_POST['id']."' ";
	mysql_query($updateQry);
?>