<?php
session_start();
include('../config/config1.php');	
//include('gmail/GmailConnect.php');
if($_SESSION['login_user_id']=="")
{
header("Location: index.php");exit();
}	
$member_ID = $_SESSION['login_user_id'];

	$selectUserInfoQry = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name`,`profile_photo_name` FROM `alacut_member` 
	 WHERE member_id = '".$member_ID."' AND active = '1'";
	 
	$selectUserInfoRes = mysql_query($selectUserInfoQry);		
	$selectUserInfo = mysql_fetch_array($selectUserInfoRes);
	
	$searchFriendName = $_REQUEST['name'];
	
	 $myFriendListQry = "SELECT f.friend_id,a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id,f.status
						 FROM `friend` f INNER JOIN `alacut_member` a ON f.frnd_req_from_id = a.member_id 
						 WHERE f.frnd_req_to_id='$member_ID' AND a.active = '1' AND f.status IN ('C','P')
						 UNION ALL 
						 SELECT f.friend_id,a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id,f.status
						  FROM `friend` f INNER JOIN `alacut_member` a ON f.frnd_req_to_id = a.member_id 
						  WHERE f.frnd_req_from_id='$member_ID' AND a.active = '1' AND f.status='C'";
	$myFriendListRes = mysql_query($myFriendListQry);

	$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_ID."' AND `status` != '2'";
	$totalPostsRes = mysql_query($totalPostsQry);
	$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alacut: List of Friends</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
var uid=<?php echo $member_ID;?>;
$(document).ready(function () {
	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val())	
		});	
		$('#lnk_ff').click(function(){
		$('#dv_video').hide();
		$('#dv_frnd').show();
	});
	$('.cancel').click(function(){
		$('#dv_video').show();
		$('#dv_frnd').hide();
	});

});

function unFriend(fromID,toID,src)
{
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			if(toID==uid)
				$(src).parent().html('<button class ="friend"  type="button"  onclick="addFriend('+toID+','+fromID+',this)" rtype="n">'+data+'</button>');
			else
				$(src).parent().html('<button class ="friend"  type="button"  onclick="addFriend('+fromID+','+toID+',this)" rtype="n">'+data+'</button>');
			$(src).remove();
			
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}

function addFriend(fromID,toID,src)
{
	
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			alert('Added as friend');
			$(src).parent().html('<button class ="unfriend"  type="button" onclick="unFriend('+fromID+','+toID+',this)" rtype="u">'+data+'</button>');
			$(src).remove();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});
	}			
}
function Friend(frnd)
{
	$.ajax({
		type: "POST",
		url: 'ajax/otherProfileFriendsInAjax.php',
		data: 'FriendID='+frnd,
		success: function(data) {
			$(".inner_left").html(data);
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});		
}
function changeLeftpanel(flag)
{
	if(flag==1){
		
		$('#dv_video').hide();
		$('.dv_frnd').show();
	}
	else if(flag==0){
		$('#dv_video').show();
		$('.dv_frnd').hide();
	}
}
</script>
</head>

<body>
<div class="wrapper">
<?php include("header.php");?>
   <div class="inner">
    <div class="inner_left">
    	<div class="dv_frnd" style="display:none;">
		<header class="head">
        <h1>Find your friends on alacut!</h1>
        
      </header>
      <section class="left_body_box">
      <section class="serch_friend">
      	<nav class="button"><a href="javascript:void(0);" onclick="changeLeftpanel(0)" class="cancel">Cancel</a></nav>
      <article class="sfriend_box">
        <div class="sfriend_menu_unsel"><img src="../images/hotmail.jpg" width="150" height="40"></div>  
        <div class="sfriend_menu"><img src="../images/gmail.jpg" width="87" height="40"></div>
        
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

	</div>

    	<div id="dv_video">
      <div class="left_head1">
        <div class="head">
          <h1>List of Friends</h1>
        </div>
      </div>
      <div class="left_body">
        <div class="group">	
        <?php
        $req=1;
        while($myFriendListInfo = mysql_fetch_array($myFriendListRes)){
		?>
          <div class="thumb" <?php if($req%6==0)echo "style=margin:0;";$req++;?>>
            <div class="title">
            	<?php echo $myFriendListInfo['full_name'];?></div>
            <div class="img"><a href='otherUserProfile.php?id=<?php echo $myFriendListInfo['member_id'];?>'><?php if($myFriendListInfo['profile_photo_name'] != ''){
					echo '<img src="../upload/profilePhotos/'.$myFriendListInfo['profile_photo_name'].'" alt="" width="90" height="90">';
				}else{
						echo '<img src="../images/no-image.jpg" alt="" height="90" width="90">';
				}?></a>
            </div>
            <div>
            	<div>
            	<?php if($myFriendListInfo['status']=="P") {?>
            		<button name="" type="button" class="friend" onclick="addFriend('<?php echo $myFriendListInfo['frnd_req_from_id'];?>','<?php echo $myFriendListInfo['frnd_req_to_id'];?>',this)" rtype="a">Accept</button>
            		<?php } else if($myFriendListInfo['status']=="C"){?>
            		<button name="" type="button" class="unfriend" onclick="unFriend('<?php echo $myFriendListInfo['frnd_req_from_id'];?>','<?php echo $myFriendListInfo['frnd_req_to_id'];?>',this)" rtype="u">unfriend</button>
            		<?php } ?>
            		</div>
            <button name="" type="button" class="friend" onclick="Friend('<?php echo ($myFriendListInfo['frnd_req_from_id']== $member_ID? $myFriendListInfo['frnd_req_to_id']:$myFriendListInfo['frnd_req_from_id']); ?>')">friends</button>
            </div>
          </div>
          <?php
          }
		  ?>
        </div>
      </div>
      </div>
    </div>
    <div class="inner_right">
      <div class="user_img">
        <div class="pic">
			<?php if($selectUserInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$selectUserInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
        </div>
        <div class="detail_box">
          <h1><?php echo $selectUserInfo['full_name']?></h1>
          <div class="detail"><strong><img src="../images/work.jpg" width="15" height="11" />Works at:</strong><?php echo "   "; echo $selectUserInfo['job']?></div>
          <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $selectUserInfo['education']?></div>
          <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $selectUserInfo['address']?></div>
          <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $selectUserInfo['married_to']?></div>
        </div>
      </div>
      <div class="user_btn">
        <div class="button"><a id="lnk_ff" href="javascript:void(0);" onclick="changeLeftpanel(1)">Find&nbsp;Friends</a></div>
        <div class="button"><a href="myFriends.php">Friends</a></div>
        <div class="button"><a href="allPosts.php"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
        <div class="button"><a href="editUserInfo.php" style="margin: 0;">Edit&nbsp;Info</a></div>
    </div>
  </div>
<?php include("footer.php");?>
  </div>
</div>

</body>
</html>