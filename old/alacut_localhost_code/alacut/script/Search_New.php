<?php
session_start();
include('../config/config1.php');
require_once("../lib/db.function.php");

$member_id = $_SESSION['login_user_id'];
$search=$_REQUEST['search'];

$per_page = 5; 

if($_GET)
{
$page=$_GET['page'];
}

$start = ($page-1)*$per_page;
$SearchUserQry = "SELECT member_id,profile_photo_name,full_name FROM `alacut_member` WHERE `full_name` like '%".$search."%' AND isAdmin !='1' AND member_id != '".$member_id."' limit $start,$per_page";
$SearchUserRes = mysql_query($SearchUserQry); 

$SearchCommentQry = "SELECT c.`videoID`,c.`post_comment_id`,c.`memberID`,c.`comment`,c.`date_time`,c.`status`,m.`full_name`,m.`profile_photo_name`,
					v.`video_name`,v.`video_upload_by`,v.video_type,v.video_object FROM `post_comments` c 
					INNER JOIN  `alacut_member` m on m.`member_id`= c.`memberID`
					INNER JOIN  `upload_video` v on v.`video_id`= c.`videoID`
					WHERE `comment` LIKE  '".$search."%' AND c.status !='2' limit $start,$per_page";
$SearchCommentRes = mysql_query($SearchCommentQry);

$SearchVideoQry = "SELECT u.`video_id` , u.`video_upload_by` , u.`video_name` , u.`video_url` , u.`video_object` , u.`video_type` , 
					m.`member_id` , m.`full_name` , m.`profile_photo_name`
					FROM `upload_video` u
					INNER JOIN alacut_member m ON m.`member_id` = u.`video_upload_by`
					WHERE `video_name` LIKE '%".$search."%' AND u.status !='2' limit $start,$per_page";
$SearchVideoRes = mysql_query($SearchVideoQry);
?>
<div style="width: 220px; float: left; padding: 10px;" >
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
                    echo '<img src="../upload/profilePhotos/'.$SearchUserInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
                }?>
             </a>
            </div>
              <div class="frnd_req_name"><?php echo $SearchUserInfo['full_name'];?></div>
              <div class="frnd_req_but">
                <!--<a href=".php?id=<?php echo $searchFriendInfo['member_id'];?>">
                  Add Friend
                </a>--> 
                <button name="btnAddFriend" id="btnAddFriend" type="button" onclick="addFriend('<?php echo $member_id;?>','<?php echo $SearchUserInfo['member_id'];?>')">add as friend</button>
            </div>
   	       </div>
			 <?php }  }else{
                echo "No Friends Found.";}
            ?> 
     </div>
     
    <div style="width: 300px; float: left; padding: 10px;">
    <h1>Videos</h1>
      <?php 
	  if(mysql_num_rows($SearchVideoRes)>0)
	  {
	  while($videoPostInfo = mysql_fetch_array($SearchVideoRes)) {?>  
        <a href="otherUserProfile.php?id=<?php echo $videoPostInfo['member_id'];?>&vid=<?php echo $videoPostInfo['video_id']?>">                         															
    	<div class="post_box">
               	  <div class="user_img"><?php if($videoPostInfo['profile_photo_name'] != ''){
					  
					  $thumbImgPath = '';
					if($videoPostInfo['video_type']=="youtube"){
						$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
					}else{
						$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
						$thumbImgPath = $vimeoInfo->thumbnail_medium;
					}
              		  echo '<img src="../upload/profilePhotos/'.$videoPostInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                		}else{
                    echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
           			 }?></div>
                  <div class="post_box_cont"><?php echo $videoPostInfo['video_name']?></div>
                  <div class="post_img">
                    <img src="<?php echo $thumbImgPath;?>" alt="" width="75" height="40"  data="<?php echo $SearchVideoInfo['video_object']?>" videotype = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/>
                  </div>
            	</div>
           </a>     
       <?php }}  else {
		  echo "No Videos Found.";}
		 ?>
	</div>
    
    <div style="width: 280px; float: left; padding: 10px;">
    <h1>Comments</h1>
     <?php 
	  if(mysql_num_rows($SearchCommentRes)>0)
	  {
	  while($SearchCommentInfo = mysql_fetch_array($SearchCommentRes)) { 
	  ?>
    <div class="msg_box">
               	  <div class="user_img"><a href="otherUserProfile.php?id=<?php echo $SearchCommentInfo['memberID'];?>&vid=<?php echo $SearchCommentInfo['videoID']?>"><?php if($SearchCommentInfo['profile_photo_name'] != ''){
              		  echo '<img src="../upload/profilePhotos/'.$SearchCommentInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                		}else{
                    echo '<img src="../images/no-image.jpg" alt="" width="40" height="40"/>';
           			 }?></a></div>
                  <div class="msg_box_name"><?php echo  $SearchCommentInfo['full_name'];?></div>
                  <div class="msg_box_msg">
                  	<?php echo  $SearchCommentInfo['comment'];?>
                  </div>
           	  </div>
   <?php 
      }}
	  else
	  {echo "No comments found.";}
    ?>
	</div>
