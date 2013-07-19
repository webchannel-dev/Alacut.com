<?php
include('../../config/config1.php');
session_start();
$user_check = $_SESSION['login_user_id'];

	$myProfileSql = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,`profile_photo_name` FROM `alacut_member` 				 					   WHERE member_id = '".$_POST['id']."' AND active = '1'"; 
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	
	$selectStatusQry = "SELECT `status` FROM `friend` WHERE `frnd_req_from_id`='".$_POST['id']."' AND `frnd_req_to_id`='$user_check'";
	$selectStatusRes = mysql_query($selectStatusQry); 
	$selectStatusInfo = mysql_fetch_array($selectStatusRes);  
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
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
			$(".user_btn").hide();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}

$(document).ready(function () {
	
		$(".openColorBox").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
	
	$(".video").click(function(){
		$("#div_youTube").attr("src",$(this).attr("data"));
		});
});
</script>
</head>
<div class="inner">
<div class="inner_left">
    <div class="left_body_box">
    	<iframe id="div_youTube" width="640" height="360" src="http://www.youtube.com/embed/1_GeQmhxc6g" frameborder="0" allowfullscreen></iframe>
        <div class="left_vid_cont">
          <div class="vid_name">Brave the Movie</div>
          <div class="user_name">John Dow</div>
          <div class="sn_img"><a href="#"><img src="../images/in.jpg" width="30" height="30" alt="in" /></a><a href="#"><img src="../images/fb.jpg" width="30" height="30" /></a><a href="#"><img src="../images/twt.jpg" width="30" height="30" /></a><a href="#"><img src="../images/alacut.jpg" width="30" height="30" /></a></div>
          <div class="choice">
            <div class="top">
           	  <div class="like"><a href="#"><img src="../images/dislike.jpg" width="50" height="24" /></a></div>
              <div class="hits">99999999</div>
              <div class="like"><a href="#"><img src="../images/like.jpg" width="50" height="24" /></a></div>
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
       	  <div class="user_img"><img src="../images/user_img.jpg" width="40" height="40" /></div>
       	  <div class="user_name">AMIR JAHANLOU.
          	<div class="post_date">posted on august 31st 2012 15:36</div>
       	  </div>
       	  <div class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</div>
        </div>
        <div class="left_vid_comment_box">
          <div class="user_img"><img src="../images/user_img.jpg" alt="" width="40" height="40" /></div>
          <div class="user_name">AMIR JAHANLOU.
            <div class="post_date">posted on august 31st 2012 15:36</div>
          </div>
          <div class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</div>
        </div>
        <div class="left_vid_comment_box">
          <div class="user_img"><img src="../images/user_img.jpg" alt="" width="40" height="40" /></div>
          <div class="user_name">AMIR JAHANLOU.
            <div class="post_date">posted on august 31st 2012 15:36</div>
          </div>
          <div class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock</div>
        </div>
        <div class="left_vid_comment_box">
          <div class="user_img"><img src="../images/user_img.jpg" alt="" width="40" height="40" /></div>
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
    <!--<a class='openColorBox' href="emp_inactive_status.php?id=<?php echo $loginID?>"><span>Mark Inactive</span></a>-->
    <div class="button" id="msg"><a class='openColorBox' href="message.php?id=<?php echo $_POST['id'];?>">Message</a></div>
    <div class="button" onclick="otherFriend('<?php echo $_POST['id'];?>')"><a href="#">Friends</a></div>
    <div class="button"><a href="allPosts.php">345 Posts</a></div>
    <?php if($selectStatusInfo['status'] != 'C') {?>
    <div class="button" onclick="addFriend('<?php echo $user_check;?>','<?php echo $_POST['id'];?>')"><a href="#" style="margin: 0;">Add as friend</a></div>
    <?php } else {?>
    <div class="button" onclick="unFriend('<?php echo $_POST['id'];?>','<?php echo $user_check;?>')"><a class="button" href="#" style="margin: 0;">Unfriend</a>
    <?php }?>                                            
    </div>
  </div>
  
  </div>
  
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
  </div>