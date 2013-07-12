<?php
session_start();
include('../config/config1.php');
$member_id = $_SESSION['login_user_id'];
$q = strtolower($_POST["keyword"]);
$SearchUserQry = "SELECT a.member_id,a.profile_photo_name,a.full_name FROM `alacut_member` a WHERE a.`full_name` like '%".$q."%' 
					AND a.isAdmin !='1' AND a.member_id != '".$member_id."' a.`active`=1 ";

$SearchUserRes = mysql_query($SearchUserQry); 

?>
<h1>Friends</h1>
<?php

		 if(mysql_num_rows($SearchUserRes)>0)
		  {
		  while($SearchUserInfo = mysql_fetch_array($SearchUserRes)) {
          ?>
           <div class="frnd_req_box">
           <div class="user_img">
           <a href="otherUserProfile.php?id=<?php echo $SearchUserInfo['member_id'];?>">
			  <?php if($SearchUserInfo['profile_photo_name'] != ''){
                    echo '<img src="upload/profilePhotos/thumb/t_40/'.$SearchUserInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="upload/profilePhotos/thumb/t_40/no-image.jpg" alt="" height="40" width="40">';
                }?>
             </a>
            </div>
              <div class="frnd_req_name"><?php echo $SearchUserInfo['full_name'];?></div>
              <?php if($member_id)  {?>
              <!--<div class="frnd_req_but"> 
              	<button style="border: 1px solid #333;" name="btnAddFriend" id="btnAddFriend" type="button" onclick="addFriend('<?php echo $member_id;?>','<?php echo $SearchUserInfo['member_id'];?>',this)" rtype='n'>add as friend</button>
            </div>-->
            <?php } ?>
   	       </div>
			 <?php }  }else{
                echo "No Friends Found.";}
            ?> 