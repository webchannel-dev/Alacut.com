<?php
session_start();
require_once("../lib/db.function.php"); 
include('../config/config1.php');

if($_SESSION['login_user_id']=="")
{
header("Location: index.php");
}

//print_r($_REQUEST);
$shareUrl =$_REQUEST['url'];
$objectVal='';
$name='';
if(strstr($shareUrl, "youtu.be" ))
	{
		for($i=0;$i<strlen($shareUrl);$i++)
		{
			$last=$index;
			if($index == '')
			{
				$start=0;
			}
			else
				$start=$index+1;
			$index=strpos($shareUrl,"/",$start);
			if(!$index)
				break;
		}
		
   		$shareUrl=substr($shareUrl,$last+1,strlen($shareUrl));
		$name = "youtube";
		$objectVal = $shareUrl;
	}
	else if(strstr($shareUrl, "www.youtube.com"))
	{
		$pos=strpos($shareUrl,"v=",0);
		$shareUrl=substr($shareUrl,$pos+2,strlen($shareUrl));
		 $pos2=strpos($shareUrl,"&",0);
			
			if($pos2>0)
			{
				 $shareUrl=substr($shareUrl,0,$pos2);
				}
		
		/*if(url.lastIndexOf("&")!=-1)
   		{
	   		url=url.split("&")[0];
	   	}*/
		$name = "youtube";
		echo $objectVal = $shareUrl;
	}
	else if(strstr($shareUrl,"vimeo.com"))
	{
		$pos1=strpos($shareUrl,"#",0);
		if($pos1 >0)
		{
			$shareUrl=substr($shareUrl,0,$pos);
		}
		 $pos2=strpos($shareUrl,"/",0);
		if($pos2 >0)
		{
			$last='';
			for($i=0;$i<strlen($shareUrl);$i++)
		{
			$last=$index;
			if($index == '')
			{
				$start=0;
			}
			else
				$start=$index+1;
			$index=strpos($shareUrl,"/",$start);
			if(!$index)
				break;
		}
		
		 $shareUrl=substr($shareUrl,$last+1,strlen($shareUrl));
		}
		/*url=url.split("#")[0];
		if(url.lastIndexOf("/")!=-1)
			url=url.substring(url.lastIndexOf("/")+1,url.length);
		$("#div_youTube").attr("src","http://player.vimeo.com/video/"+url);*/
		
		$name = "vimeo";
		$objectVal = $shareUrl;
	}
$user_check = $_SESSION['login_user_id'];
	$qry='';
	if($user_check !='')
	{
	if($name == "youtube" )	
	{
		$videoObject =$objectVal;
		/*$videoInfo = parseVideoEntry($videoObject);	
		$title = $videoInfo->title;
		$videoTitle = str_replace(array("'")," ",$title); 
		$Desc = $videoInfo->description; 
		$Description = str_replace(array("'")," ",$Desc);*/
	 $uploadVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$user_check."','','".$_REQUEST['url']."','".$videoObject."','','".$name."')";
	$qry=mysql_query($uploadVideoSql);
	/*$uploadVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$user_check."','$videoTitle','".$_REQUEST['url']."','".$videoObject."','$Description','".$name."')";*/
	}
	else if($name == "vimeo")
	{
	 $videoObject = $objectVal;
 	  $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$videoObject.".php")); 	
	  $hash = $hash[0];
	  $description = $hash['description'];
	  $desc = str_replace(array("'")," ",$description);
	  $title = $hash['title'];
	  $tit = str_replace(array("'")," ",$title);
	  $duration = $hash['duration'];
 echo $vimeoVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$user_check."','$tit','".$_REQUEST['url']."','".$videoObject."','$desc','".$name."')";
 $qry=mysql_query($vimeoVideoSql);
	
		}
if($qry>0)
{header("location:home.php?videoObj=".$videoObject);}
	
	}
	else
	{
		header("location:index.php?videourl=".$_REQUEST['url']);
	}
	
?>
