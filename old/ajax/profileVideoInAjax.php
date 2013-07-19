<?php
require_once("../lib/db.function.php");
include('../config/config1.php');

$memberID = $_REQUEST['loginID'];
$iFrameVideoID = $_REQUEST['iFrameID'];

if($iFrameVideoID > 0){
	
	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
	FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
	WHERE member_id='".$memberID."' AND u.status!= '2'  AND u.video_id != '".$iFrameVideoID."' ORDER BY `visit` DESC LIMIT 4";
	$videoPostRes = mysql_query($videoPostQry);
	$videoPostNum = mysql_num_rows($videoPostRes);
	?>
	<?php if($videoPostNum > 0){
	   while($videoPostInfo = mysql_fetch_array($videoPostRes)) { 
		$thumbImgPath = '';
			if($videoPostInfo['video_type']=="youtube"){
				$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
			}else{
				$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
				$thumbImgPath = $vimeoInfo->thumbnail_medium;
			}
	  ?> 
		  <div class="right_thumb">
		  <article class="thumb"><a href="myProfile.php?vid=<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $videoPostInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
		  <div class="home_des_thumb">
			<div class="title"><?php if (strlen($videoPostInfo['video_name']) > 24) {echo $title= substr($videoPostInfo['video_name'], 0, 21) . '...';}else{echo $videoPostInfo['video_name'];}?></div>
			<div class="username"><?php echo $videoPostInfo['full_name']?></div>
		  </div>
		  <?php
			if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
			{
				$up_value = $videoPostInfo['like'];
				$down_value = $videoPostInfo['dislike'];
				$total = $up_value + $down_value;
				$up_per = ($up_value*100)/$total; 
				$down_per = ($down_value*100)/$total;?> 
				<div class="like_bar2">
				  <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
				  <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
				</div>
			<?php }?>
		</article>
	   </div><?php } }else{
		   echo "Only One Post...";
	   }
   }else{
	   echo "No Post By You";
   }
?>