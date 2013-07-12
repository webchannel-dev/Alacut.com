<?php
include('../../config/config1.php');

$insertCommentQry = "INSERT INTO `post_comments`(`videoID`,`memberID`,`comment`) VALUES('".$_POST['videoId']."','".$_POST['loginID']."','".$_POST['comment']."')"; 
	mysql_query($insertCommentQry);
	
	$postCommentQry = "SELECT a.full_name,a.profile_photo_name,p.videoID,p.date_time,p.comment,p.post_type FROM `alacut_member` a INNER JOIN `post_comments` p ON p.memberID=a.member_id WHERE p.videoID='".$_POST['videoId']."'";
	$postCommentRes = mysql_query($postCommentQry);
	while($postCommentInfo = mysql_fetch_array($postCommentRes)) {
?>
<div class="left_vid_comment_box">
  <div class="user_img">
  	<?php if($postCommentInfo['profile_photo_name'] != ''){
		echo '<img src="../upload/profilePhotos/'.$postCommentInfo['profile_photo_name'].'" alt="" width="40" height="40">';
}else{
		echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
	 }?>
  </div>
  <div class="user_name"><?php echo $postCommentInfo['full_name']?>
    <div class="post_date">posted on <?php echo $postCommentInfo['date_time']?></div>
  </div>
  <div class="desc"><?php echo $postCommentInfo['comment']?></div>
  </div>
<?php } ?>