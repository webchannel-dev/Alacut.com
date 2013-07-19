<?php 
session_start();
include('../../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

	$userImageQry = "SELECT `profile_photo_name`,`full_name` FROM `alacut_member` WHERE `member_id`='$member_ID'"; 
	$userImageRes = mysql_query($userImageQry);
	$userImageInfo = mysql_fetch_array($userImageRes);
	
	$postCommentQry = "SELECT a.full_name,a.profile_photo_name,p.videoID,p.date_time,p.comment,p.post_type FROM `alacut_member` a INNER JOIN `post_comments` p ON p.memberID=a.member_id WHERE p.videoID='".$LargeVideoId."'";
	$postCommentRes = mysql_query($postCommentQry);

 while($postCommentInfo = mysql_fetch_array($postCommentRes)) { ?>
    <section class="left_vid_comment_box">
      <div class="user_img">
        <?php if($postCommentInfo['profile_photo_name'] != ''){
            echo '<img src="../../upload/profilePhotos/'.$postCommentInfo['profile_photo_name'].'" alt="" width="40" height="40">';
    }else{
            echo '<img src="../../images/no-image.jpg" alt="" height="40" width="40">';
         }?>
      </div>
      <div class="user_name"><?php echo $postCommentInfo['full_name']?>
        <div class="post_date">posted on <?php echo $postCommentInfo['date_time']?></div>
      </div>
      <div class="desc"><?php echo $postCommentInfo['comment']?></div>
    </section>
<?php } ?> 


