
<?php
session_start();
require_once("lib/db.function.php"); 
include('config/config1.php');

if($_SESSION['login_user_id']=="")
{
	echo '<h1 style="color:red;">You Should Login To www.alacut.com!!</h1>';
	exit();
} 

//print_r($_REQUEST);
$shareUrl =$_REQUEST['url'];

$objectVal='';
$name='';
$vid=0;
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
	 	$objectVal = $shareUrl;
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
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://gdata.youtube.com/feeds/api/videos/'.$objectVal);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$response = curl_exec($ch);
	curl_close($ch);
		
	if ($response) {
	    $xml   = new SimpleXMLElement($response);
		
	    $title = str_replace(array("'"),array(''),(string) $xml->title);
		$desc=str_replace(array("'"),array(''),(string) $xml->content);
		require_once("youtubeLength.php");
		$lngth=getYouTubeVideoLength($objectVal);
		if($lngth==0 || $lngth>240)
		{
			echo '<h1 style="color:red;">Video Length is more than 4 minute.Please pin video that are less than 4 minute!!</h1>';
			exit();
		}
	} else {
	    $title='';$desc='';
	}	
	
	
	$uploadVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`,`video_image`) VALUES ('".$user_check."','".$title."','".$_REQUEST['url']."','".$objectVal."','".$desc."','".$name."','http://i1.ytimg.com/vi/".$objectVal."/mqdefault.jpg')";
	$qry=mysql_query($uploadVideoSql);
	$vid= mysql_insert_id();
	/*$uploadVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`) VALUES ('".$user_check."','$videoTitle','".$_REQUEST['url']."','".$videoObject."','$Description','".$name."')";*/
	}
	else if($name == "vimeo")
	{
	 $videoObject = $objectVal;
 	  $vimeoDetails = vimeoVideoDetails($videoObject);
		$description = $vimeoDetails->description;
		$desc = str_replace(array("'")," ",$description);
		$title = $vimeoDetails->title;
		$tit = str_replace(array("'")," ",$title);
		$duration = $vimeoDetails->duration;
		$img=$vimeoDetails->thumbnail_medium;
	  if($duration==0 || $duration > 240)
		{
			echo '<h1 style="color:red;">Video Length is more than 4 minute.Please pin video that are less than 4 minute!!</h1>';
			exit();
		}
 $vimeoVideoSql = "INSERT INTO `upload_video`(`video_upload_by`,`video_name`,`video_url`,`video_object`,`video_desc`,`video_type`,`video_image`) VALUES ('".$user_check."','$tit','".$_REQUEST['url']."','".$videoObject."','$desc','".$name."','".$img."')";
 $qry=mysql_query($vimeoVideoSql);
	$vid= mysql_insert_id();
		}
header("location:home.php");exit();
}
	
?>
