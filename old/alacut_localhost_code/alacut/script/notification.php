<?php
$member_ID = $_SESSION['login_user_id'];

	$friendNameQry = "SELECT a.full_name,a.profile_photo_name,f.frnd_req_from_id, f.friend_id, f.frnd_req_to_id FROM `alacut_member` a INNER JOIN `friend` f ON f.frnd_req_from_id = a.member_id WHERE f.frnd_req_to_id='$member_ID' AND f.status='P' AND a.active = '1' LIMIT 10";
	$friendNameRes = mysql_query($friendNameQry);
	$friendNameNum = mysql_num_rows($friendNameRes);
	
	$messageDisplayQry = "SELECT m.message_id,m.reply_id,m.message_content,m.message_from_id,m.message_to_id,a.profile_photo_name,a.full_name FROM `message` m INNER JOIN `alacut_member` a ON m.message_from_id=a.member_id WHERE m.message_to_id='$member_ID' AND m.status != '1' AND m.status !='2' LIMIT 10";
	$messageDisplayRes = mysql_query($messageDisplayQry);
	$messageDisplayNum = mysql_num_rows($messageDisplayRes);
		
	$postQry = "SELECT c.post_comment_id,c.videoID,c.comment, c.post_type, m.full_name, m.profile_photo_name, m.member_id, v.video_object, v.video_type 
	FROM `post_comments` AS c 
	INNER JOIN `alacut_member` AS m ON m.member_id = c.memberID 
	INNER JOIN `upload_video` AS v ON v.video_id = c.videoID
	WHERE m.member_id = '$member_ID' AND c.status != '1' LIMIT 10"; 
	$postRes = mysql_query($postQry);
	$postNum = mysql_num_rows($postRes);
	/*$messageDisplayRes = mysql_query($messageDisplayQry);
	$messageDisplayNum = mysql_num_rows($messageDisplayRes);*/
	
	$qry = "SELECT `login_user_name` FROM `alacut_member` WHERE member_id='$member_ID' AND active = '1'";
	$ses_sql = mysql_query($qry);
	$row = mysql_fetch_array($ses_sql);
	$login_session = $row['login_user_name'];
?>
<script>
$(document).ready(function () {
	 $(".slide1").click(function () {
      $("#div_slide_content1").slideToggle("fast");
      $("#div_slide_content2").hide();
      $("#div_slide_content3").hide();
	  $("#div_slide_content4").hide();
            });
   $(".slide2").click(function () {
      $("#div_slide_content2").slideToggle("fast");
      $("#div_slide_content1").hide();
      $("#div_slide_content3").hide();
	  $("#div_slide_content4").hide();
            });
   $(".slide3").click(function () {
       $("#div_slide_content3").slideToggle("fast");
       $("#div_slide_content1").hide();
       $("#div_slide_content2").hide();
	   $("#div_slide_content4").hide();
            });
	$(".slide4").click(function () {
       $("#div_slide_content4").slideToggle("fast");
       $("#div_slide_content1").hide();
       $("#div_slide_content2").hide();
	   $("#div_slide_content3").hide();
            });	
});

function confirmFriend(confFromID)
{	
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: 'frndFromID='+confFromID,
		success: function(data) { 
			alert('Friend request has been confirmed');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});			
}

function ignoreFriend(rejectFromID)
{
	$.ajax({
		type: "POST",
		url: 'ajax/rejectFriendInAjax.php',
		data: 'FromID='+rejectFromID,
		success: function(data) {
			alert('Friend request has been rejected');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}

function postCommentStatus(status)
{
	$.ajax({
		type: "POST",
		url: 'ajax/commentStatusInAjax.php',
		data: 'Cstatus='+status,
		success: function(data) {
			alert('F');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
}
</script>
<div class="notification">
      <div class="slide1"><a href="#"><img src="../images/note_1.jpg" alt="" width="30" height="30" /></a></div>
      <div id="div_slide_content1">
        <div class="arrow">&nbsp;</div>
        <div class="note">
        <?php if($friendNameNum > 0){
         while($friendNameInfo = mysql_fetch_array($friendNameRes)) 
		 {	?>
          <div class="frnd_req_box">
            <div class="user_img">
            	<?php if($friendNameInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$friendNameInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
            }?>
            </div>
            <div class="frnd_req_name"><?php echo $friendNameInfo['full_name'];?></div>
            <div class="frnd_req_but">
              <div class="but"><input class="confirm" type="button" id="btnConfirm" name="btnConfirm" value="Confirm" alt="" width="60" height="20" onclick="confirmFriend('<?php echo $friendNameInfo['friend_id'];?>')"/></div>
              <div class="but"><input class="ignore" type="button" id="btnIgnore" name="btnIgnore" value="Ignore" alt="" width="60" height="20" onclick="ignoreFriend('<?php echo $friendNameInfo['friend_id'];?>')"/></div>
            </div>
          </div>
         <?php
		}  } else{?>
        	<div class="frnd_req_box" style="text-align:center">
            	<strong>No friend request</strong>
            </div>
        <?php } ?>   
        </div>
         
      </div>
      <div class="slide2"><a href="#"><img src="../images/note_2.jpg" alt="" width="30" height="30" /></a></div>
      <div id="div_slide_content2">
        <div class="arrow">&nbsp;</div>
       <div class="note3">
       <?php if($postNum > 0){
		 while($postInfo = mysql_fetch_array($postRes)) 
		 {	?>
          <div class="post_box" onclick="postCommentStatus('<?php echo $postInfo['post_comment_id'];?>')">
            <div class="user_img"><?php if($postInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$postInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
            }?>
            </div>
            <div class="post_box_cont"><?php echo $postInfo['comment']?></div>
            <div class="post_img"> <a href="#"><img src="<?php echo $postInfo['video_type']=="youtube"?"http://img.youtube.com/vi/".$postInfo['video_object']."/1.jpg":"../images/no-image.jpg"?>" alt="" width="75" height="40" /></a> </div>
          </div>
		  <?php } }else{?>
          	<div class="post_box" style="text-align:center">
            	<strong>No comment post</strong>
            </div>
          <?php } ?>        		
        </div>
      </div>
      <div class="slide3" ><a href="#"><img src="../images/note_3.jpg" alt="" width="30" height="30" /></a></div>
      <div id="div_slide_content3">
        <div class="arrow">&nbsp;</div>
        <div class="note2">
       <?php if($messageDisplayNum > 0) {
          while($messageDisplayInfo = mysql_fetch_array($messageDisplayRes)) 
		 {	?>
           <a href="mailingDetail.php?id=<?php echo $messageDisplayInfo['message_id']."&pid=".$messageDisplayInfo['reply_id'];?>">
           <div class="msg_box" >
            <div class="user_img">
            	<?php if($messageDisplayInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$messageDisplayInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
            }?>
            </div>
            <div class="msg_box_name"><?php echo $messageDisplayInfo['full_name'];?></div>
            <div class="msg_box_msg"><?php echo $messageDisplayInfo['message_content'];?></div>
          </div></a>
          <?php
		} }else{?>  
        	<div class="msg_box" style="text-align:center">
            	<strong>No comment post</strong>
            </div>
        <?php } ?>
        </div>
      </div>
      <div class="user slide4"><a href="#"><?php echo $login_session;?></a></div>
      <div id="div_slide_content4">
        <div class="user_option"><a href="myProfile.php">My Profile</a></div>
        <div class="user_option"><a href="logout.php">Logout</a></div>
        <div class="user_option"><a id="grabButton" title="Grab It" href="javascript:void((function(){var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://www.alacut.com/test/js/alacutpinscript.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" onclick="alert('Drag me to the bookarks bar'); return false;">GRAB IT</a></div>
      </div>
    </div>