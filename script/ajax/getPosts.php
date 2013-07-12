<?php
session_start();
include('../../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

	$postQry ="SELECT p.post_comment_id,p.comment,p.videoID,p.memberID,a.full_name,a.profile_photo_name,u.video_name,u.video_upload_by,u.video_object,u.video_type,u.video_image 
	FROM `post_comments` p INNER JOIN `upload_video` u ON u.video_id=p.videoID
			INNER JOIN `alacut_member` a ON a.member_id=p.memberID
			WHERE u.video_upload_by=$member_ID AND p.memberID!=$member_ID AND p.status='0'"; 
	
	$postRes = mysql_query($postQry);
	$postNum = mysql_num_rows($postRes);
?>
<script type="text/javascript" src="../js/jquery.min.1.7.2.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.vcmnt').click(function(){changeCmntStatus($(this));});
	});

function changeCmntStatus(status)
{
	
	if(status && $(status).attr('cid'))
	{
	$.ajax({
		type: "POST",
		url: 'ajax/commentStatusInAjax.php',
		data: 'Cstatus='+$(status).attr('cid'),
		success:function(data){
			window.location.href="home.php?vid="+$(status).attr('vid');
		}
	});	
}
}
</script>
<h1>Posts</h1>
        <div id="_boxscroll" style="overflow: auto; overflow-x: hidden; height: 170px; display:none2"> 
       <?php if($postNum > 0){
		 while($postInfo = mysql_fetch_array($postRes)) 
		 {
		
			$thumbImgPath = $postInfo['video_image'];
		 ?>
         
          <a class='vcmnt' href="javascript:void(0);" cid='<?php echo $postInfo['post_comment_id'];?>' vid=<?php echo $postInfo['videoID'];?>>
          	<div class="post_box" >
            <div class="post_box_c">
                  <div class="post_name"><?php echo $postInfo['full_name']?></div>
                  <div class="post_box_cont"><?php echo $postInfo['comment']?></div>
                </div>
            
            <div class="post_img"> <a href="javascript:void(0);"><img src="<?php echo $thumbImgPath;?>" alt="" width="75" height="40" /></a> </div>
         </div> 
         </a>  
		  <?php } }else{?>
          	<div class="post_box" style="text-align:center">
            	<strong>No comment post</strong>
            </div>
          <?php } ?>    
           		</div>