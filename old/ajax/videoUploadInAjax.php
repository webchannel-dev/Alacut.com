<?php
session_start();
include('../config/config1.php');
require_once("../lib/db.function.php"); 
$member_id = $_SESSION['login_user_id'];
if($member_id!=0 || $member_id!="")
{
	if($_POST['type'] == 'youtube')
	{
		$videoObject = $_POST['object'];
		$description=$_POST['desc'];
		$videoTitle=$_POST['title'];
		 
	  $youtubeVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`,`video_image`) VALUES ('".$member_id."','".$videoTitle."','".$_POST['url']."','".$_POST['object']."','".$description."','".$_POST['type']."','http://i1.ytimg.com/vi/".$_POST['object']."/mqdefault.jpg')";
	mysql_query($youtubeVideoSql);
	$videoID = mysql_insert_id();
	$data[] = array(
			'type' => 'y'  ,
			'obj' => $videoObject,
			'vid'=>$videoID	
		);
		echo json_encode($data);flush();
	//echo 'y~'.$videoObject.'~'.$videoID;
		
	}else if($_POST['type'] == 'vimeo'){
		$videoObject = $_POST['object'];
		
		$vimeoDetails = vimeoVideoDetails($videoObject);
		$description = $vimeoDetails->description;
		$desc = str_replace(array("'")," ",$description);
		$title = $vimeoDetails->title;
		$tit = str_replace(array("'")," ",$title);
		$duration = $vimeoDetails->duration;
		$img=$vimeoDetails->thumbnail_medium;
		if($duration < 240 && $title!="" && $desc!="" && $img!=""){
	   $vimeoVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`,`video_image`) VALUES ('".$member_id."','".$tit."','".$_POST['url']."','".$_POST['object']."','".$desc."','".$_POST['type']."','".$img."')";
	mysql_query($vimeoVideoSql);
	$videoID = mysql_insert_id();
	$data[] = array(
			'type' => 'v'  ,
			'obj' => $videoObject,
			'vid'=>$videoID	,
			'desc'=>$desc,
			'title'	=> $tit,
			'img'=>$img
		);
		echo json_encode($data);flush();
	
		}else{
			echo "ERROR";
		}
	}
	}
?>