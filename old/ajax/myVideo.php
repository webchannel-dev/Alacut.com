<?php 
session_start();

include('../config/config1.php');

if(isset($_SESSION['login_user_id'])){
	
	$member_id = isset($_REQUEST["u"])?$_REQUEST["u"]:0;
	if($member_id!=0)
	{
		$pages=isset($_REQUEST["p"])?$_REQUEST["p"]:0;
	if($_SESSION['page']!=$pages)
	{
		$_SESSION['page']=$pages;
	$size=isset($_REQUEST["s"])?$_REQUEST["s"]:0;
	$strt=$pages*$size;
	$vid="";
	if($_REQUEST['where']=="profile" && isset($_REQUEST["iFrameID"]))
		$vid=" AND u.video_id!='".$_REQUEST["iFrameID"]."'";
	 $videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_image,u.visit,u.video_type,u.like,u.dislike,a.full_name,u.uploaded_date, 
     u.video_name,u.video_desc,u.video_url FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
     WHERE u.video_upload_by ='".$member_id."' AND u.status != '2'".$vid." ORDER BY u.visit DESC,u.like DESC,u.uploaded_date DESC LIMIT $strt,$size";
	$videoPostRes = mysql_query($videoPostQry);
	$videoPostNum = mysql_num_rows($videoPostRes);
?>
<?php if($videoPostNum > 0)
{
	$req=1;
	if($_REQUEST['where']=="post"){
    	
	 while($videoPostInfo = mysql_fetch_array($videoPostRes)) {
		 $thumbImgPath = $videoPostInfo['video_image'];
		$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	 ?>
        <div class="left_thumb">
          <div class="posts" <?php if($req%4==0) echo 'style="margin:0;"'; $req++;?> onclick="lageVideoId('<?php echo $videoPostInfo['video_id'];?>','<?php echo $member_id;?>')"><a href="javascript:void(0);"><img class="video" src="<?php echo $thumbImgPath;?>" alt="" width="140" height="74" data="<?php echo $videoPostInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>"/></a>
            <div class="home_des_thumb">
              <div class="post_title" title='<?php echo $title;?>'><?php if(strlen($title) > 24) {echo substr($title, 0, 21) . '...';}else{echo $title;}?></div>
              <div class="name"><?php echo $videoPostInfo['full_name']?></div>
            </div>
            <?php
			if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
			{
				$up_value = $videoPostInfo['like'];
				$down_value = $videoPostInfo['dislike'];
				$total = $up_value + $down_value;
				$up_per = ($up_value*100)/$total; 
				$down_per = ($down_value*100)/$total;?> 
				<div class="like_bar3">
				  <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
				  <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
				</div>
			<?php } else {?>
				<div class="like_bar3"></div>
				<?php } ?>
          </div>
        </div><?php } 
}
else {
	while($videoPostInfo = mysql_fetch_array($videoPostRes)) { 
		$thumbImgPath = '';
			if($videoPostInfo['video_image']==""){
				$thumbImgPath = "images/no-image.jpg";
			}else{
				$thumbImgPath = $videoPostInfo['video_image'];
			}
			$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	  ?> 
		  <div class="right_thumb" >
		  <article class="thumb" <?php if($req%2==0) echo("style='margin:0;'"); $req++;?>>
		  	<a href="<?php if($member_id==$_SESSION['login_user_id']) echo "myProfile.php?vid="; else echo "otherUserProfile.php?id=".$member_id."&vid=";?><?php echo $videoPostInfo['video_id'];?>" ><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $videoPostInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
		  <div class="home_des_thumb">
			<div class="title" title="<?php echo $title;?>"><?php if (strlen($title) > 20) {echo $title= substr($title, 0,18) . '...';}else{echo $title;}?></div>
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
			<?php } else {?>
				<div class="like_bar2"></div>
				<?php } ?>
		</article>
	   </div>
<?php }
}} else{ echo "0";}}}} ?>