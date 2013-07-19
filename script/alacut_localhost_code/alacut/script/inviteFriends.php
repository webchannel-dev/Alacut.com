<?php
session_start();
include('../config/config1.php');;
require_once("../lib/db.function.php");
$member_ID = $_SESSION['login_user_id'];

	$myProfileSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$member_ID."' AND active = '1'";
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);

	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
		FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
		WHERE member_id='$member_ID' AND u.status!= '2' ORDER BY `visit` DESC LIMIT 4";
		$videoPostRes = mysql_query($videoPostQry);
	
	$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_ID."' AND `status` != '2'";
	$totalPostsRes = mysql_query($totalPostsQry);
	$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>alacut: My Profile</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<!--<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>-->
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui-1.8.15.custom.css" />
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
$(document).ready(function () {
	
	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val())
		
		});
	
});
</script>
</head>

<body>
<form name="profile" method="post" action="">
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
      <header class="head">
        <h1>Find your friends on alacut!</h1>
      </header>
      <section class="left_body_box">
      <section class="serch_friend">
      <article class="sfriend_box">
        <div class="sfriend_menu"><a href="gmail_invite/"><img src="../images/gmail.jpg" width="150" height="40"></a></div>
        <div class="sfriend_menu_unsel"><img src="../images/hotmail.jpg" width="87" height="40"></div>  
        <div class="sfriend_menu_unsel"><img src="../images/yahoomail.jpg" width="150" height="40"></div>
        <div class="sfriend_menu_unsel"><img src="../images/facebook.jpg" width="150" height="40"></div>
      </article>
        <article class="sfriend">
        	<h1>Check your Hotmail Address Book</h1>
             <article>&nbsp;</article>
             <article>&nbsp;</article>
        </article>
      </section>
  </section>
</section>
<aside class="inner_right">
    <section class="user_img">
      <section class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </section>
      <section class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="../images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </section>
    </section>
    <section class="user_btn">
    <nav class="button"><a href="#">Find&nbsp;Friends</a></nav>
    <nav class="button"><a href="myFriends.php">Friends</a></nav>
    <nav class="button"><a href="allPosts.php?id=<?php echo $myProfileInfo['member_id']?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></nav>
    <nav class="button"><a href="editUserInfo.php?id=<?php echo $myProfileInfo['member_id']?>" style="margin: 0;">Edit&nbsp;Info</a></nav>
  </section>

<section class="right_thumb">
  <?php while($videoPostInfo = mysql_fetch_array($videoPostRes)){
 	$thumbImgPath = '';
		if($videoPostInfo['video_type']=="youtube"){
			$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
		}else{
			$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
			$thumbImgPath = $vimeoInfo->thumbnail_medium;
		}
 ?>     
        <article class="thumb"><a href="myProfile.php?vid=<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
      <div class="home_des_thumb">
        <div class="title"><?php echo $videoPostInfo['video_name']?></div>
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
    <?php } ?>
</section>
  </aside>
  </section><?php include("footer.php");?>
</div>
</form>
</body>
</html>

            