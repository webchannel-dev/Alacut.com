<?php
session_start();
include('../config/config1.php');
$member_id = $_SESSION['login_user_id'];
$q = strtolower($_POST["keyword"]);
$SearchVideoQry = "SELECT u.`video_id` , u.`video_upload_by` , u.`video_name` ,u.`video_image`, u.`video_url` , u.`video_object` , u.`video_type` , 
					m.`member_id` , m.`full_name` , m.`profile_photo_name`
					FROM `upload_video` u
					INNER JOIN alacut_member m ON m.`member_id` = u.`video_upload_by`
					WHERE `video_name` LIKE '%".$q."%' AND u.status !='2' ";
$SearchVideoRes = mysql_query($SearchVideoQry);
?>
<h1>Videos</h1>
<?php 
	  if(mysql_num_rows($SearchVideoRes)>0)
	  {
	  while($videoPostInfo = mysql_fetch_array($SearchVideoRes)) { ?>  
	  	<?php if($videoPostInfo['member_id']== $member_id){?>
	  		<a href="myProfile.php?vid=<?php echo $videoPostInfo['video_id']?>">
	  		<?php } else {?>
        <a href="otherUserProfile.php?id=<?php echo $videoPostInfo['member_id'];?>&vid=<?php echo $videoPostInfo['video_id']?>">
        <?php }?>                         															
    	<div class="search_post_box">
               	  <div class="user_img"><?php if($videoPostInfo['profile_photo_name'] != ''){
					  
					  $thumbImgPath = $videoPostInfo['video_image'];
					
              		  echo '<img src="upload/profilePhotos/thumb/t_40/'.$videoPostInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                		}else{
                    echo '<img src="upload/profilePhotos/thumb/t_40/no-image.jpg" alt="" width="40" height="40"/>';
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