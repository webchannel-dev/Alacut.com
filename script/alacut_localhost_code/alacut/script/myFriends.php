<?php
session_start();
include('../config/config1.php');	

if($_SESSION['login_user_id']=="")
{
header("Location: index.php");
}	
$member_ID = $_SESSION['login_user_id'];

	$selectUserInfoQry = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name`,`profile_photo_name` FROM `alacut_member` 
	 WHERE member_id = '".$member_ID."' AND active = '1'";
	$selectUserInfoRes = mysql_query($selectUserInfoQry);		
	$selectUserInfo = mysql_fetch_array($selectUserInfoRes);
	
	$searchFriendName = $_REQUEST['name'];
	
	$myFriendListQry = "SELECT a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id
						FROM `alacut_member` a INNER JOIN `friend` f ON f.frnd_req_from_id = a.member_id 
						WHERE f.frnd_req_to_id='$member_ID' AND f.status='C' AND member_id != '".$member_ID."' AND active = '1'";
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
$(document).ready(function () {
	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val())	
		});	
});

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

function Friend(frnd)
{
	$.ajax({
		type: "POST",
		url: 'ajax/friendsOfFriendInAjax.php',
		data: 'ID='+frnd,
		success: function(data) {
			$(".inner_left").html(data);
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});		
}
</script>
</head>

<body>
<form name="friends" method="post" action="">
<div class="wrapper">
<?php include("header.php");?>
   <div class="inner">
    <div class="inner_left">
      <div class="left_head1">
        <div class="head">
          <h1>List of Friends</h1>
        </div>
      </div>
      <div class="left_body">
        <div class="group">	
        <?php
        while($myFriendListInfo = mysql_fetch_array($myFriendListRes)){
		?>
          <div class="thumb">
            <div class="title"><?php echo $myFriendListInfo['full_name'];?></div>
            <div class="img"><?php if($myFriendListInfo['profile_photo_name'] != ''){
					echo '<img src="../upload/profilePhotos/'.$myFriendListInfo['profile_photo_name'].'" alt="" width="90" height="90">';
				}else{
						echo '<img src="../images/no-image.jpg" alt="" height="90" width="90">';
					 }?>
            </div>
            <button name="" type="button" class="unfriend" onclick="unFriend('<?php echo $myFriendListInfo['frnd_req_from_id'];?>','<?php echo $myFriendListInfo['frnd_req_to_id'];?>')">unfriend</button>
            <button name="" type="button" class="friend" onclick="Friend('<?php echo $myFriendListInfo['frnd_req_from_id'];?>')">friend</button>
          </div>
          <?php
          }
		  ?>
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
        <div class="button"><a href="#">Find&nbsp;Friends</a></div>
        <div class="button"><a href="myFriends.php">Friends</a></div>
        <div class="button"><a href="allPosts.php?id=<?php echo $selectUserInfo['member_id']?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
        <div class="button"><a href="editUserInfo.php?id=<?php echo $selectUserInfo['member_id']?>" style="margin: 0;">Edit&nbsp;Info</a></div>
    </div>
  </div>
<?php include("footer.php");?>
  </div>
</div>
</form>
</body>
</html>