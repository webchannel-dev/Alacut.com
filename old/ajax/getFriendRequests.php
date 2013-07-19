<?php
session_start();
include('../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

	$friendNameQry = "SELECT a.full_name,a.profile_photo_name,f.frnd_req_from_id, f.friend_id, f.frnd_req_to_id FROM `alacut_member` a INNER JOIN `friend` f ON f.frnd_req_from_id = a.member_id WHERE f.frnd_req_to_id='$member_ID' AND f.status='P' AND a.active = '1' LIMIT 10";
	$friendNameRes = mysql_query($friendNameQry);
	$friendNameNum = mysql_num_rows($friendNameRes);
?>
<h1>New Friends</h1>
        <div id="_boxscroll" style="overflow: auto; overflow-x: hidden; height: 170px; display:none2"> 
        <?php if($friendNameNum > 0){
         while($friendNameInfo = mysql_fetch_array($friendNameRes)) 
		 {	?>
          <div class="frnd_req_box">
            <div class="user_img">
            	<a href='otherUserProfile.php?id=<?php echo $friendNameInfo['frnd_req_from_id'];?>'>
            	<?php if($friendNameInfo['profile_photo_name'] != ''){
                echo '<img src="upload/profilePhotos/'.$friendNameInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="40" height="40"/>';
            }?></a>
            </div>
            <div class="frnd_req_name"><?php echo $friendNameInfo['full_name'];?></div>
            <div class="frnd_req_but">
              <div class="but"><input class="confirm green" type="button" id="btnConfirm" name="btnConfirm" value="Confirm" alt="" width="60" height="20" onclick="confirmFriend('<?php echo $friendNameInfo['frnd_req_from_id'];?>','<?php echo $friendNameInfo['frnd_req_to_id'];?>',this)" rtype='a'/></div>
              <div class="but"><input class="ignore red" type="button" id="btnIgnore" name="btnIgnore" value="Ignore" alt="" width="60" height="20" onclick="ignoreFriend('<?php echo $friendNameInfo['frnd_req_from_id'];?>','<?php echo $friendNameInfo['frnd_req_to_id'];?>',this)" rtype='u'/></div>
            </div>
          </div>
         <?php
		}  } else{?>
        	<div class="frnd_req_box" style="text-align:center">
            	<strong>No friend request</strong>
            </div>
        <?php } ?>   
        </div>