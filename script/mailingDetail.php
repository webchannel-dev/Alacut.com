<?php
session_start();
include('../config/config1.php');
if($_SESSION['login_user_id']=="")
{
header("Location: index.php");exit();
}
$member_id = $_SESSION['login_user_id'];

	$myProfileSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$member_id."' AND active = '1'";
	$myfrndnm = mysql_query("SELECT `full_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."' AND active = '1'");
	$myfrndnm=mysql_fetch_array($myfrndnm);
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	$msgstatus="UPDATE `message` SET `status` = '1' WHERE `message_from_id` = '".$_REQUEST['id']."' AND `message_to_id`='".$member_id."' AND `status`='0'";
	mysql_query($msgstatus);
	
	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_image,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
		FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
		WHERE member_id='".$member_id."' AND u.status!= '2' ORDER BY `like` DESC LIMIT 4";
		$videoPostRes = mysql_query($videoPostQry);
		
	$messagefrmID = $_REQUEST['id'];
	$mailingQry = "SELECT m.message_id,m.message_from_id,m.message_content,m.message_to_id,fm.full_name AS fmName,tm.full_name AS tmName,fm.profile_photo_name AS fmPhoto,tm.profile_photo_name AS tmPhoto FROM `message` m
INNER JOIN `alacut_member` fm ON fm.member_id = m.message_from_id
INNER JOIN `alacut_member` tm ON m.message_to_id = tm.member_id  WHERE (`message_to_id`='".$member_id."' AND `message_from_id`='".$messagefrmID."') OR (`message_to_id`='".$messagefrmID."' AND `message_from_id`='".$member_id."') ORDER BY m.message_id";
	$mailingRes = mysql_query($mailingQry);
	$mailingNum = mysql_num_rows($mailingRes);
	
	$mailToRES = mysql_query($mailingQry);
	$mailToINFO = mysql_fetch_row($mailToRES);
	$fromID = $member_id;
	if($mailToINFO[1] == $fromID){
		$toID = $mailToINFO[3];
	}else{
		$toID = $mailToINFO[1];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>alacut: mailing page</title>
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
<script>
var $=jQuery.noConflict();
/*var msgId = '<?php echo $messageID?>';*/
$(document).ready(function()
{
	$(".VisibleLogin").click(function()
	{  
		$("#txtUName").hide();
		$("#btnLogin").show();
		$("#div_button").hide();
		$("#btnSignup").show();
		$("#div_forgotPwd").hide();
	});
	$("#btnSignup").click(function(){
		$("#txtUName").show();
		$("#btnLogin").hide();
		$("#div_button").show();
		$("#btnSignup").hide();
		return false;
		});
	$("#btnForgot").click(function(){
		$("#div_forgotPwd").show();
		return false;
		});
});
function checkSubmit(txt,e,fromId,toID)
{
   if(e && e.keyCode == 13 )
   {
	   if($(txt).val()!="")
      		replyMail(fromId,toID);
		else
			alert("Please Enter Comment!!");
   }
   
}
function replyMail(fromId,toID)
{	
	var txtArea = $("#txtComment").val();
	if(Number(fromId)!=0 && Number(toID)!=0)
	{
	$.ajax({
		type: "POST",
		url: 'ajax/mailReplyInAjax.php',
		data: 'fromMsgID='+fromId+'&toMsgID='+toID+'&content='+txtArea,
		success: function(data) {
			$("#mail").append(data);
			$("#txtComment").val("");
			
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});
	}
}

</script>

</head>

<body>
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
      <header class="head">
        <h1><span>Conversation with:</span> <?php echo $myfrndnm['full_name'];?> </h1>
      </header>

    <section class="left_body_box">
    <div id="mail">
      <?php while($mailingInfo = mysql_fetch_array($mailingRes)) {?>
      <article class="chat">
        <div class="user_img">
			<a href='<?php if($mailingInfo['message_from_id']==$member_id) echo "myProfile.php"; else echo "otherUserProfile.php?id=".$_REQUEST['id'];?>'>
				<?php if($mailingInfo['fmPhoto'] != ''){
				 echo '<img src="../upload/profilePhotos/'.$mailingInfo['fmPhoto'].'" alt="" width="40" height="40"/>';
            }else{
                echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
        	}?></a>
         </div>
        <strong><?php echo $mailingInfo['fmName'];?></strong>
        <article class="chat_text"><?php echo $mailingInfo['message_content'];?></article>
        </article>
		<?php }?>
       </div> 
      <div class="chat_inp">
      <section class="left_vid_desc" style="width: 615px;">
          <article class="user_img">
          	
          	<a href='myProfile.php'><?php if($myProfileInfo['profile_photo_name'] != ''){
                    echo '<img src="../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
                     }?></a></article>
       	  <div><textarea id="txtComment" name="txtComment" class="desc" onKeyPress="checkSubmit(this,event,<?php echo $fromID;?>,<?php echo $toID;?>)" ></textarea>
       	  </div>
       	  
        </section>
       
        
    </div>
    </section>
  </section>
<aside class="inner_right">
    <div class="user_img">
      <div class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </div>
      <div class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="../images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </div>
    </div>
    <div class="user_btn">
    <div class="button"><a href="#">Find&nbsp;Friends</a></div>
    <div class="button"><a href="myFriends.php">Friends</a></div>
    <div class="button"><a href="allPosts.php?id=<?php echo $myProfileInfo['member_id']?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
    <div class="button"><a href="editUserInfo.php?id=<?php echo $myProfileInfo['member_id']?>" style="margin: 0;">Edit&nbsp;Info</a></div>
  </div>
  <div class="head">
  <div class="right_thumb">
  <?php 
  $req=1;
  while($videoPostInfo = mysql_fetch_array($videoPostRes)){
  	$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name'])?> 
  	   
        <div class="thumb" <?php if($req%2==0) echo('style="margin:0;"'); $req++;?>>
        	<a href='myProfile.php?vid=<?php echo $videoPostInfo['video_id'];?>'><img  class="video" src="<?php echo $videoPostInfo['video_image'];?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" /></a>
      <div class="home_des_thumb">
        <div class="title" title="<?php echo $title;?>"><?php if (strlen($title) > 20) {echo $title= substr($title, 0, 18) . '...';}else{echo $title;}?></div>
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
    </div>   
    <?php } ?>
    </div>
  </div>
</aside>
<?php include("footer.php");?>
  </section>
</div>

</body>
</html>

         