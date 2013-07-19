<?php
session_start();
include('../config/config1.php');

if($_SESSION['login_user_id']=="")
{
header("Location: index.php");
}		
$member_ID = $_SESSION['login_user_id'];

	$userInfoSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '". $member_ID."' AND active = '1'";
	$userInfoRes = mysql_query($userInfoSql); 
	$userInfo = mysql_fetch_array($userInfoRes);	

$maritalStatus = 'Single';
if($userInfo['relationship'] == 'E'){
	$maritalStatus = 'Engaged';
}
if($userInfo['relationship'] == 'M'){
	$maritalStatus = 'Married to';
}
$handleStatus = 'Individial';
if($userInfo['handle'] == 'E'){
	$handleStatus = 'Entity';
}
	
$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_ID."' AND `status` != '2'";
$totalPostsRes = mysql_query($totalPostsQry);
$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>alacut: User Info</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
$(document).ready(function () {
	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val())	
		});	
	
	$(".single").click(function () {
		$("#txtMarried").hide();
			});
	$(".engaged").click(function () {
		$("#txtMarried").hide();
			});
	$(".marriedTo").click(function () {
		$("#txtMarried").show();
			});
});
</script>
</head>

<body>
<form name="readProfile" method="post" action="">
<div class="wrapper">
  <?php include("header.php");?>
  <section class="inner">
<section class="inner_left">
    <section class="left_body">
    	<form id="frmUserInfo" name="frmUserInfo" method="POST" action="<?php echo $PHP_SELF;?>" enctype="multipart/form-data">
      <section class="user_info">
        <section class="mid">
          <section class="img">
          	<?php if($userInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$userInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
          </section>
         
          <section class="cont">
            <div class="head">Name</div>
            <article class="field">
              <label for="textfield"></label>
              <?php echo $userInfo['full_name']?>
            </article>
            <div class="head">Job</div>
            <article class="field">
              <label for="textfield6"></label>
              <?php echo $userInfo['job']?>
            </article>
            <div class="head">Education</div>
            <article class="field">
              <label for="textfield7"></label>
              <?php echo $userInfo['education']?>
            </article>
            <div class="head">Location</div>
            <article class="field">
              <label for="textfield8"></label>
              <?php echo $userInfo['address']?>
            </article>
            <div class="head">Marital</div>
            <article class="field">
              <?php echo $maritalStatus?>
              <?php echo $userInfo['married_to']?>
            </article>
            <div class="head">URL</div>
            <article class="field">
            	<div style="width: 50px; line-height: 15px;"></div>
            	<label for="textfield10"></label>
              <?php echo "alacut.com/";echo $userInfo['url']?>
            </article>
            <div class="head">Handle</div>
            <div class="field">
              	<?php echo $handleStatus?>
            </div>
          </section>

        </section>
        
      </section>
     </form>
    </section>
</section>
  <aside class="inner_right">
    
      <section class="user_img">
        <section class="pic">
        	<?php if($userInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$userInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
        </section>
        <section class="detail_box">
          <h1><?php echo $userInfo['full_name']?></h1>
          <div class="detail"><strong><img src="../images/work.jpg" width="15" height="11" />Works at:</strong><?php echo "   "; echo $userInfo['job']?></div>
          <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $userInfo['education']?></div>
          <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $userInfo['address']?></div>
          <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $userInfo['married_to']?></div>
        </section>
      </section><section class="user_btn">
        <nav class="button"><a href="#">Find&nbsp;Friends</a></nav>
        <nav class="button"><a href="myFriends.php">Friends</a></nav>
        <nav class="button"><a href="allPosts.php?id=<?php echo $userInfo['member_id']?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></nav>
        <nav class="button"><a href="editUserInfo.php?id=<?php echo $_REQUEST['id']?>" style="margin: 0;">Edit&nbsp;Info</a></nav>
    </section>
  </aside>
  </section><?php include("footer.php");?>
</div>
</form>
</body>
</html>