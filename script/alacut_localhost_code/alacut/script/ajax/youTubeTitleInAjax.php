<?php
include('../../config/config1.php');  
require_once("../../lib/db.function.php");  
	
	$videoObject = $_POST['object'];
	if($videoObject == '0' || $videoObject == "")
	{
		echo 'This is not a valid youtube video url. Please, give a valid url...';
	} 
	else
	{
		/*$videoInfo = parseVideoEntry($videoObject);		
		echo $title = $videoInfo->title;
		$time = $videoInfo->length;*/
    }
?>