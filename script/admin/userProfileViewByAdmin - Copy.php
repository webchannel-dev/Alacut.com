<?php
session_start();
include('../../config/config1.php');
$user_check = $_SESSION['login_user_id'];

	$myProfileSql = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,
	`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."' AND active = '1'"; 
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	
	$selectStatusQry = "SELECT `status` FROM `friend` WHERE `frnd_req_from_id`='".$_REQUEST['id']."' AND `frnd_req_to_id`='$user_check'";
	$selectStatusRes = mysql_query($selectStatusQry); 
	$selectStatusInfo = mysql_fetch_array($selectStatusRes);  
	
	if($_POST['btnSend'] == 'Send')
	{
		$content = str_replace(array("'")," ",$_POST['txtContent']);
		$insertMsgQry = "INSERT INTO `message`(`message_from_id`,`message_to_id`,`message_content`) VALUES('$user_check','".$_REQUEST['id']."','$content')"; 
	mysql_query($insertMsgQry);
	}
	
	if($_POST['btnSearch'] == '2')
	{ 	
		header("location:findFriends.php?name=".$_POST['txtSearch']."");
	}
	
	$mostLikeVideoQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,
	a.full_name FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
	WHERE member_id='".$_REQUEST['id']."' AND u.like != (SELECT `like` FROM `upload_video` WHERE `video_upload_by`=
	'".$_REQUEST['id']."' ORDER BY `like` DESC LIMIT 1) ORDER BY `like` DESC LIMIT 4";
	$mostLikeVideoRes = mysql_query($mostLikeVideoQry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$(".openColorBox").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
	
	if($("#div_youTube").attr("iframeVideoType") == "youtube")
	{
		$("#div_youTube").attr("src" ,"http://www.youtube.com/embed/"+$("#div_youTube").attr("object"));
	}
	else if($("#div_youTube").attr("iframeVideoType") == "vimeo")
	{	
		$("#div_youTube").attr("src","http://player.vimeo.com/video/"+$("#div_youTube").attr("object"));
	}
});

function addFriend(frndFromID,frndToID)
{	
	$.ajax({
		type: "POST",
		url: '../ajax/findFriendInAjax.php',
		data: 'fromId='+frndFromID+'&toId='+frndToID,
		success: function(data) {
			alert('Friend request has been sent');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});			
}

function unFriend(fromID,toID)
{
	$.ajax({
		type: "POST",
		url: '../ajax/unFriendInAjax.php',
		data: 'unFrndFromID='+fromID+'&unFrndToID='+toID,
		success: function(data) {
			alert('Your friend has been un-friend');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}

function otherFriend(otherFrndId)
{	
	$.ajax({
		type: "POST",
		url: '../ajax/otherProfileFriendsInAjax.php',
		data: 'FriendID='+otherFrndId,
		success: function(data) {
			$(".inner_left").html(data);
			$(".user_btn").hide();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}
</script>
</head>
<body>
<form name="findFriends" method="post" action="">
<div class="wrapper">
  <div class="top_bar">
    <div class="logo"><a href="index.php"><img src="../../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="home.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search">
      <input type="submit" name="btnSearch" id="btnSearch" value="2" class="button" />
      <input type="text" name="txtSearch" id="txtSearch" class="input" />
    </div>
    <!--<?php include('notification.php');?>-->
  </div>
<div class="inner">
<div class="inner_left">
    <div class="left_body_box">
    	<iframe id="div_youTube" width="640" height="360" src="" object="<?php echo $mostLikeVideoInfo['video_object']?>" iframeVideoType = "<?php echo $mostLikeVideoInfo['video_type'] ?>" vidID = "<?php echo $mostLikeVideoInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <div class="left_vid_cont">
          <div class="vid_name">Brave the Movie</div>
          <div class="user_name">John Dow</div>
          <div class="sn_img"><a href="#"><img src="../../images/in.jpg" width="30" height="30" alt="in" /></a><a href="#"><img src="../../images/fb.jpg" width="30" height="30" /></a><a href="#"><img src="../../images/twt.jpg" width="30" height="30" /></a><a href="#"><img src="../../images/alacut.jpg" width="30" height="30" /></a></div>
          <div class="choice">
            <div class="top">
           	  <div class="like"><a href="#"><img src="../../images/dislike.jpg" width="50" height="24" /></a></div>
              <div class="hits">99999999</div>
              <div class="like"><a href="#"><img src="../../images/like.jpg" width="50" height="24" /></a></div>
            </div>
            <div class="bot">
            	<div class="dislike" style="width: 124px;"></div>
	            <div class="like" style="width: 50px;"></div>
            </div>
          </div>
        </div>
        <div class="left_vid_desc">
        is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,</div>
          <div class="left_vid_comment_box">
          <div class="user_img"><img src="../../images/user_img.jpg" alt="" width="40" height="40" /></div>
          <div class="user_name">AMIR JAHANLOU.
            <div class="post_date">posted on august 31st 2012 15:36</div>
          </div>
          <div class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</div>
        </div>
    </div>
  </div>
  <div class="inner_right">
    <div class="user_img">
      <div class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="../../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </div>
      <div class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="../../images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="../../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="../../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="../../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </div>
    </div>
  <div class="head">
  <div class="right_thumb">
  <?php while($mostLikeVideoInfo = mysql_fetch_array($mostLikeVideoRes)){?>     
        <div class="thumb"><img  class="video" src="<?php echo $mostLikeVideoInfo['video_type']=="youtube"?"http://img.youtube.com/vi/".$mostLikeVideoInfo['video_object']."/1.jpg":"../../images/no-image.jpg"?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $mostLikeVideoInfo['video_type'] ?>" vidID = "<?php echo $mostLikeVideoInfo['video_id']?>"/>
      <div class="home_des_thumb">
        <div class="title"><?php echo $mostLikeVideoInfo['video_name']?></div>
        <div class="username"><?php echo $mostLikeVideoInfo['full_name']?></div>
      </div>
      <div class="like_bar2">
      <div class="dislike" style="width: 100px;"></div>
      <div class="like" style="width: 40px;"></div>
      </div>
    </div>   
    <?php } ?>
    </div>
  </div>
  </div>
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
</div>
</div>
</form>
</body>
</html>