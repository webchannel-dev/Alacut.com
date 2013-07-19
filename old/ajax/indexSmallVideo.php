<?php
include('../config/config1.php');
require_once("../lib/db.function.php");

	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_image,u.video_type,u.like,u.dislike,a.full_name 
	FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
	WHERE u.status!= '2'  AND u.video_id != '".$_REQUEST['lvId']."' ORDER BY u.`visit` DESC,u.`like` DESC  LIMIT 6";
	$videoPostRes = mysql_query($videoPostQry);
	$req=1;
while($videoPostInfo = mysql_fetch_array($videoPostRes)){
		$thumbImgPath = $videoPostInfo['video_image'];
		$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	?>     
        <div <?php if($req%6==0) echo "style='margin:0'";$req++;?> class="thumb smallVideo" svId="<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/>
      <div class="home_des_thumb">
        <div class="title" title="<?php echo $title;?>"><?php if (strlen($title) > 24) {echo substr($title, 0, 21) . '...';}else{echo $title;}?></div>
        <div class="username"><?php echo $videoPostInfo['full_name']?></div>
      </div>
      <div class="like_bar2">
      <?php
      
	  	if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
		{
			$up_value = $videoPostInfo['like'];
			$down_value = $videoPostInfo['dislike'];
			$total = $up_value + $down_value;
			$up_per = ($up_value*100)/$total; 
			$down_per = ($down_value*100)/$total;?> 
            
              <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
              <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
            
		<?php }?>
		</div>
    </div>   
    <?php } ?>