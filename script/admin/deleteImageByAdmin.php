<?php
include('../../config/config1.php'); 
	
	$activateQry = "UPDATE `upload_image` SET `status`='2' WHERE `image_id`='".$_REQUEST['id']."'";
	mysql_query($activateQry);
	header("location: imageDetail.php");
?>