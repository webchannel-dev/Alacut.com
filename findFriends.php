<?php
session_start();
include('config/config1.php');
$member_ID = $_SESSION['login_user_id'];

if($_SESSION['login_user_id']=="")
{
header("Location: ".SITE_URL);exit();
}
	$selectUserInfoQry = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,
	`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$member_ID."' AND active = '1'"; 
	$selectUserInfoRes = mysql_query($selectUserInfoQry);		
	$selectUserInfo = mysql_fetch_array($selectUserInfoRes);//echo $selectUserInfo;exit();
	
	$searchFriendName = $_REQUEST['name'];
	
	$searchFriendQry = "SELECT `member_id`,`full_name`,`profile_photo_name` FROM `alacut_member` WHERE `first_name` LIKE '%$searchFriendName%' AND member_id !='".$member_ID."' AND active = '1'  AND `isAdmin` !='1' ORDER BY `full_name`";
	$searchFriendRes = mysql_query($searchFriendQry);
	
	if($_POST['btnSearch'] == '2')
	{ 	
		header("location:findFriends.php?name=".$_POST['txtSearch']."");
	} 
	
	$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_ID."' AND `status` != '2'";
	$totalPostsRes = mysql_query($totalPostsQry);
	$totalPostsInfo = mysql_fetch_array($totalPostsRes);
	
	$mostLikedVideoQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
		FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
		WHERE member_id='".$member_ID."' AND u.status!= '2'  ORDER BY `like` DESC LIMIT 4";
	$mostLikedVideoRes = mysql_query($mostLikedVideoQry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
$(document).ready(function () {
      
});
		
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
</script>

</head>

<body>
<form name="findFriends" method="post" action="">
<div class="wrapper">
  <div class="top_bar">
    <div class="logo"><a href="index.php"><img src="images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="home.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search">
      <input type="submit" name="btnSearch" id="btnSearch" value="2" class="button" />
      <input type="text" name="txtSearch" id="txtSearch" class="input" />
    </div>
    <?php include('notification.php');?>
  </div>
  <div class="inner">
    <div class="inner_left">
      <div class="left_head1">
        <div class="head">
          <h1>Add Some Friends</h1>
        </div>
      </div>
      <div class="left_body">
        <div class="group">	
        <?php
        while($searchFriendInfo = mysql_fetch_array($searchFriendRes)){
		?>
          <div class="thumb">      <!--onclick="otherUserProfile('<?php echo $searchFriendInfo['member_id'];?>')"-->
            <div class="title"><?php echo $searchFriendInfo['full_name'];?></div>
            <a href="otherUserProfile.php?id=<?php echo $searchFriendInfo['member_id'];?>"><div class="img"><?php if($searchFriendInfo['profile_photo_name'] != ''){
					echo '<img src="upload/profilePhotos/'.$searchFriendInfo['profile_photo_name'].'" alt="" width="90" height="90">';
				}else{
						echo '<img src="images/no-image.jpg" alt="" height="90" width="90">';
					 }?>
            </div></a>
            <button name="btnAddFriend" id="btnAddFriend" type="button" onclick="addFriend('<?php echo $member_ID;?>','<?php echo $searchFriendInfo['member_id'];?>')">add as friend</button>
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
                echo '<img src="upload/profilePhotos/'.$selectUserInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
        </div>
        <div class="detail_box">
          <h1><?php echo $selectUserInfo['full_name']?></h1>
          <div class="detail"><strong><img src="images/work.jpg" width="15" height="11" />Works at:</strong><?php echo "   "; echo $selectUserInfo['job']?></div>
          <div class="detail"><strong><img src="images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $selectUserInfo['education']?></div>
          <div class="detail"><strong><img src="images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $selectUserInfo['address']?></div>
          <div class="detail"><strong><img src="images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $selectUserInfo['married_to']?></div>
        </div>
      </div>
      <div class="user_btn">
        <div class="button"><a href="#">Find&nbsp;Friends</a></div>
        <div class="button"><a href="myFriends.php">Friends</a></div>
        <div class="button"><a href="allPosts.php?id=<?php echo $member_ID?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
        <div class="button"><a href="editUserInfo.php?id=<?php echo $member_ID?>" style="margin: 0;">Edit&nbsp;Info</a></div>
    </div>
    <div class="head">
      <div class="right_thumb">
      <?php while($mostLikedVideoInfo = mysql_fetch_array($mostLikedVideoRes)) { ?>
        <div class="thumb"><img  class="video" src="<?php echo $mostLikedVideoInfo['video_type']=="youtube"?"http://img.youtube.com/vi/".$mostLikedVideoInfo['video_object']."/1.jpg":"images/no-image.jpg"?>" width="140" height="74" data="<?php echo $mostLikedVideoInfo['video_object']?>" videoType = "<?php echo $mostLikedVideoInfo['video_type'] ?>" vidid = "<?php echo $mostLikedVideoInfo['video_id']?>"/>
      <div class="home_des_thumb">
        <div class="title">Man of Steel</div>
        <div class="username">Posted by: User2</div>
      </div>
      <?php
	  	if($mostLikedVideoInfo['like'] != 0 OR $mostLikedVideoInfo['dislike'] !=0)
		{
			$up_value = $mostLikedVideoInfo['like'];
			$down_value = $mostLikedVideoInfo['dislike'];
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
  </div>
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
  </div>
</div>
</form>
</body>
</html>

            