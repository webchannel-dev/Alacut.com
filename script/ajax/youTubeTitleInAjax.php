<?php
include('../../config/config1.php');  
require_once("../../lib/db.function.php");  
	
$videoObject = $_POST['object'];

if($videoObject != '0' || $videoObject != "")
{	
	if($_POST['type'] == "youtube")
	{
		/*$videoInfo = parseVideoEntry($videoObject);	
		$time = $videoInfo->length;
		if($time < 240){
			$title = $videoInfo->title;
			if (strlen($title) > 28) {echo $title= substr($title, 0, 25) . '...';}else{echo $title;}
		}*/
	}else if($_POST['type'] == "vimeo"){
		$vimeoDetails = vimeoVideoDetails($videoObject);
		$time = $vimeoDetails->duration;
		if($time < 240){
			$title = $vimeoDetails->title;
			if (strlen($title) > 25) {echo $title= substr($title, 0, 22) . '...';}else{echo $title;}
		}
	}
}
?>