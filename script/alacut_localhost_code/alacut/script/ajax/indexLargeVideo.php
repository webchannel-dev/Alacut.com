<?php 
include('../../config/config1.php');
	$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_name,u.like,u.dislike,a.member_id,a.full_name
	FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id  
	WHERE u.status!='2' AND u.video_id = ".$_REQUEST['svId']."  LIMIT 1";
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes); 
	$videoSrc = "";
	if($iframeVideoPostInfo['video_type'] == "youtube"){
			$videoSrc = "http://www.youtube.com/embed/" . $iframeVideoPostInfo['video_object'];
	}else if($iframeVideoPostInfo['video_type'] == "vimeo"){
		$videoSrc = "http://player.vimeo.com/video/" . $iframeVideoPostInfo['video_object'];
	}
	
	$showBar = FALSE;
	if($iframeVideoPostInfo['like'] != 0 OR $iframeVideoPostInfo['dislike'] !=0)
	{
		$up_value = $iframeVideoPostInfo['like'];
		$down_value = $iframeVideoPostInfo['dislike'];
		$total = $up_value + $down_value;
		$up_per = ($up_value*100)/$total; 
		$down_per = ($down_value*100)/$total;
		$showBar = TRUE;
	 }
?>

<div class="home_video" id="div_video">
<iframe id="div_youTube" width="960" height="540" src="<?php echo $videoSrc;?>" frameborder="0" allowfullscreen></iframe>
</div>
<div class="home_des">
  <div class="title"><?php echo $iframeVideoPostInfo['video_name']?></div>
  <div class="username">Posted by : <?php echo $iframeVideoPostInfo['full_name']?></div>
</div>
<?php if($showBar){?>
    <div class="like_bar">
        <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
        <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
    </div>
 <?php }?>