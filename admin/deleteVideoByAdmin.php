<?php
include('../config/config1.php'); 
	
	$activateQry = "UPDATE `upload_video` SET `status`='2' WHERE `video_id`='".$_REQUEST['id']."'";
	mysql_query($activateQry);
	header("location: videoDetail.php");
?>