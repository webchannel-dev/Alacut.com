<?php 
session_start();
include('../config/config1.php');
$member_id = $_SESSION['login_user_id'];
$q = strtolower($_POST["keyword"]);
$SearchCommentQry = "SELECT c.`videoID`,c.`post_comment_id`,c.`memberID`,c.`comment`,c.`date_time`,c.`status`,m.`full_name`,m.`profile_photo_name`,
					v.`video_name`,v.`video_upload_by`,v.`video_type`,v.`video_object`,v.`video_image` FROM `post_comments` c 
					INNER JOIN  `alacut_member` m on m.`member_id`= c.`memberID`
					INNER JOIN  `upload_video` v on v.`video_id`= c.`videoID`
					WHERE `comment` LIKE  '".$q."%' AND c.status !='2' ";
$SearchCommentRes = mysql_query($SearchCommentQry);
?>
<h1>Comments</h1>
<?php 
	  if(mysql_num_rows($SearchCommentRes)>0)
	  {
	  while($SearchCommentInfo = mysql_fetch_array($SearchCommentRes)) { 
	  	$thumbImgPath = $SearchCommentInfo['video_image'];
  ?>
    <div class="search_post_box">
               	  <div class="user_img"><a href="otherUserProfile.php?id=<?php echo $SearchCommentInfo['memberID'];?>&vid=<?php echo $SearchCommentInfo['videoID']?>"><?php if($SearchCommentInfo['profile_photo_name'] != ''){
              		  echo '<img src="upload/profilePhotos/thumb/t_40/'.$SearchCommentInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                		}else{
                    echo '<img src="upload/profilePhotos/thumb/t_40/no-image.jpg" alt="" width="40" height="40"/>';
           			 }?></a></div>
                  <div class="msg_box_name"><?php echo  $SearchCommentInfo['full_name'];?></div>
                  <div class="msg_box_msg">
                  	<?php echo  $SearchCommentInfo['comment'];?>
                  </div>
                  <div class="post_img"><img src="<?php echo $thumbImgPath;?>" alt="" width="75" height="40"/></div>
           	  </div>
   <?php 
      }}
	  else
	  {echo "No comments found.";}
    ?>