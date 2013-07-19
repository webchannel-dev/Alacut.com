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
			echo $Desc = $videoInfo->description;
		}*/
	}else if($_POST['type'] == "vimeo"){
		$vimeoDetails = vimeoVideoDetails($videoObject);
		$time = $vimeoDetails->duration;
		if($time < 240){
			$desc = replceSpecialChar($vimeoDetails->description);
			$title = replceSpecialChar($vimeoDetails->title);
			$arr=array(0=>$title,1=>$desc);
			echo json_encode($arr);
		}
	}
}
function replceSpecialChar($msg)
{
	return str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n"),array("&acute;", "<br/>", "<br/>", "", "", ""),$msg);
	}
?>