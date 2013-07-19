<?php
session_start();
include('../config/config1.php');
require_once("../lib/db.function.php");

if($_SESSION['login_user_id']=="")
{
header("Location: index.php");
}
$member_id = $_SESSION['login_user_id'];

$LargeVideoId = 0;	
	$myProfileSql = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,
	`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."' AND active = '1'"; 
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	
	$selectStatusQry = "SELECT `status` FROM `friend` WHERE `frnd_req_from_id`='".$_REQUEST['id']."' AND `frnd_req_to_id`='$member_id'";
	$selectStatusRes = mysql_query($selectStatusQry); 
	$selectStatusInfo = mysql_fetch_array($selectStatusRes);  
	
	if($_POST['btnSend'] == 'Send')
	{
		$content = str_replace(array("'")," ",$_POST['txtContent']);
		$insertMsgQry = "INSERT INTO `message`(`message_from_id`,`message_to_id`,`message_content`) VALUES('$member_id','".$_REQUEST['id']."','$content')"; 
	mysql_query($insertMsgQry);
	}
	
	if(isset($_REQUEST['vid']) > 0){		
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,a.member_id,a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$_REQUEST['id']."' AND u.status!='2'  AND u.video_id = ".$_REQUEST['vid']."  LIMIT 1";
	}else{
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,a.member_id,a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$_REQUEST['id']."' AND u.status!='2'  ORDER BY `like` DESC LIMIT 1";
	}
	
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
	if($iframeVideoPostNUM > 0)
	{
		$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
		$LargeVideoId = $iframeVideoPostInfo['video_id'];
		$iframeVidObject = $iframeVideoPostInfo['video_object'];
		$update = "UPDATE `upload_video` SET visit = visit + 1 WHERE video_id = '".$LargeVideoId."'";
		mysql_query($update);
		if($iframeVidObject == '0' || $iframeVidObject == "")
		{
		echo 'This is not a valid youtube video url. Please, give a valid url...';
		} 
		else
		{
			if($iframeVideoPostInfo['video_type'] == 'youtube')
			{
				/*$videoInfo = parseVideoEntry($iframeVidObject);		
				$description = $videoInfo->description;
				$title = $videoInfo->title;
				$duration = $videoInfo->length;*/
			}else{
				$vimeoDetails = vimeoVideoDetails($iframeVidObject);
				$description = $vimeoDetails->description;
				$title = $vimeoDetails->title;
				$duration = $vimeoDetails->duration;
			}
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
		 
		$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
		FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
		WHERE member_id='".$_REQUEST['id']."' AND u.status!= '2'  AND u.video_id != '".$iframeVideoPostInfo['video_id']."' ORDER BY `like` DESC LIMIT 4";
		$videoPostRes = mysql_query($videoPostQry); 
	}
	
$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$_REQUEST['id']."' AND `status` != '2'";
$totalPostsRes = mysql_query($totalPostsQry);
$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>alacut: User Profile</title>
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
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
var userId = '<?php echo $_REQUEST['id']?>';

$(document).ready(function () {
	$(".openColorBox").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
	
	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val());	
		});	
	
	if($("#div_youTube").attr("iframeVideoType") == "youtube")
	{
		$("#div_youTube").attr("src" ,"http://www.youtube.com/embed/"+$("#div_youTube").attr("object"));
	}
	else if($("#div_youTube").attr("iframeVideoType") == "vimeo")
	{	
		$("#div_youTube").attr("src","http://player.vimeo.com/video/"+$("#div_youTube").attr("object"));
	}
	
	MarkLikeDisLike();
});

function MarkLikeDisLike()
{
	$(".like").click(function()
	{ 
		var name=$(this).attr("name");		
		var id = $("#div_youTube").attr("VidID");
		$.ajax
		({    
 			type: "POST",
			url: "ajax/rating.php",
			data: 'id='+id+'&name='+name+'&uid='+userId,
			cache: false,
			success: function(data)
			{	
				$('.choice').html(data);
				MarkLikeDisLike();					
			}
		});
		return false;
	});
}

function addFriend(frndFromID,frndToID)
{	
	$.ajax({
		type: "POST",
		url: 'ajax/findFriendInAjax.php',
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
		url: 'ajax/unFriendInAjax.php',
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
		url: 'ajax/otherProfileFriendsInAjax.php',
		data: 'FriendID='+otherFrndId,
		success: function(data) {
			$(".inner_left").html(data);
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}

function postComment(userID,vID)
{
	var textAreaComment = $("#txtComment").val();
	if(textAreaComment != ""){
	$.ajax({
		type: "POST",
		url: 'ajax/commentPostInAjax.php',
		data: 'loginID='+userID+'&comment='+textAreaComment+'&videoId='+vID,
		success: function(data) {
			$("#vid_comment_box").html(data);	
			$("#txtComment").val("");
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}else{
	}
}
</script>
</head>
<body>
<form name="findFriends" method="post" action="">
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
    <section class="left_body_box">
    	<iframe id="div_youTube" width="640" height="360" src="" object="<?php echo $iframeVideoPostInfo['video_object']?>" iframeVideoType = "<?php echo $iframeVideoPostInfo['video_type'] ?>" vidID = "<?php echo $iframeVideoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <section class="left_vid_cont">
          <div class="vid_name"><?php echo $title;?></div>
          <div class="user_name"><?php echo $iframeVideoPostInfo['full_name'];?></div>
          <div class="sn_img"><a onclick="window.open('http://www.linkedin.com/shareArticle?mini=false&url=<?php echo $iframeVideoPostInfo['video_url'];?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0)"><img src="../images/in.jpg" width="30" height="30" alt="in" /></a><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $iframeVideoPostInfo['video_url']; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" href="javascript: void(0)"><img src="../images/fb.jpg" width="30" height="30" /></a><a onclick="window.open('http://twitter.com/home?status= video url shred -  <?php echo $iframeVideoPostInfo['video_url'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0)"><img src="../images/twt.jpg" width="30" height="30" /></a><a href="javascript: void(0)"><img src="../images/alacut.jpg" width="30" height="30" /></a></div>
          <div class="choice">
                <div class="top">	
                <?php if($iframeVideoPostInfo['ldStatus'] == 'like' ){ ?>		 
                  <a href="#" class="like" id="dislike" name="dislike"><img src="../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
                <?php } 
					elseif($iframeVideoPostInfo['ldStatus'] == 'dislike'){ ?>
                  		<a href="#" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>
                 <?php } else{?>
                 			<a href="#" class="like" id="dislike" name="dislike"><img src="../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
                            <a href="#" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>
                 <?php } ?>
                </div>
                <?php if($showBar){?>
                <div class="bot">
                    <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                    <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
                </div>
                <?php }?>
              </div>
        </section>
        <div class="left_vid_desc"><?php echo $description;?></div>
        <div id="vid_comment_box">
        <?php include("loginUserCommentPost.php");?>
        </div>
        <section class="left_vid_desc">
          <article class="user_img"><?php if($userImageInfo['profile_photo_name'] != ''){
                    echo '<img src="../upload/profilePhotos/'.$userImageInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
                     }?></article>
       	  <div class="textbox"><textarea id="txtComment" name="txtComment" class="desc"></textarea>
       	  </div>
       	  <div class="button"><button name="btnPost" id="btnPost" type="button" onClick="postComment('<?php echo $member_id?>','<?php echo $LargeVideoId;?>')">Post</button></div>
        </section>
    </section>
  
</section><aside class="inner_right">
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
    <nav class="button" id="msg"><a class='openColorBox' href="message.php?id=<?php echo $_REQUEST['id'];?>">Message</a></nav>
    <nav class="button" onclick="otherFriend('<?php echo $_REQUEST['id'];?>')"><a herf="#">Friends</a></nav>
    <nav class="button"><a href="allPosts.php?id=<?php echo $_REQUEST['id'];?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></nav>
    <?php if($selectStatusInfo['status'] != 'C') {?>
    <nav class="button" onclick="addFriend('<?php echo $member_id;?>','<?php echo $_REQUEST['id'];?>')"><a href="#" style="margin: 0;">Add as friend</a></nav>
    <?php } else {?>
    <nav class="button" onclick="unFriend('<?php echo $_REQUEST['id'];?>','<?php echo $member_id;?>')"><a class="button" href="#" style="margin: 0;">Unfriend</a>
    <?php }?>                                           
    </nav>
  </section> 

      
  <section class="right_thumb">
  <?php while($videoPostInfo = mysql_fetch_array($videoPostRes)) {
	  $thumbImgPath = '';
		if($videoPostInfo['video_type']=="youtube"){
			$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
		}else{
			$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
			$thumbImgPath = $vimeoInfo->thumbnail_medium;
		}
  ?>     
        <article class="thumb"><a href="otherUserProfile.php?id=<?php echo $_REQUEST['id'];?>&vid=<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
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