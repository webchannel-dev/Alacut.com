<?php
include('../../config/config1.php');

$videoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,u.video_name,a.member_id ,a.full_name, u.visit, l.status AS ldStatus
				FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
				LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
				WHERE a.member_id='".$_POST['userId']."' AND u.status!='2'  AND u.video_id = '".$_POST['lvId']."'  LIMIT 1";
				 
	$videoPostRes = mysql_query($videoPostQry);
	$videoPostInfo = mysql_fetch_array($videoPostRes);
	
	if($videoPostInfo['video_type'] == "youtube"){
			$videoSrc = "http://www.youtube.com/embed/" . $videoPostInfo['video_object'];
	 }else if($videoPostInfo['video_type'] == "vimeo"){
		 $videoSrc = "http://player.vimeo.com/video/" . $videoPostInfo['video_object'];
	 }
?>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script>
$(document).ready(function () {	
	MarkLikeDisLike();
});

function MarkLikeDisLike()
{
	$(".like").click(function()
	{ 
		var name=$(this).attr("name");		
		var id = $("#div_youTube").attr("VidID");
		$.ajax
		({
			type: "POST",
			url: "ajax/rating.php",
			data: 'id='+id+'&name='+name,
			cache: false,
			success: function(data)
			{
				$('.choice').html(data);
				MarkLikeDisLike();					
			}
		});
		return false;
	});
}	
</script>
<div id="largeVideo">
 <iframe id="div_youTube" width="640" height="360" src="<?php echo $videoSrc;?>" vidID = "<?php echo $videoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
  <div class="left_vid_cont">
      <div class="vid_name"><?php echo $videoPostInfo['video_name']?></div>
      <div class="user_name"><?php echo $videoPostInfo['full_name']?></div>
      <div class="sn_img"><a href="#"><img src="../images/in.jpg" width="30" height="30" alt="in" /></a><a href="#"><img src="../images/fb.jpg" width="30" height="30" /></a><a href="#"><img src="../images/twt.jpg" width="30" height="30" /></a><a href="#"><img src="../images/alacut.jpg" width="30" height="30" /></a></div>
      <div class="choice">
        <div class="top">	
        <?php if($videoPostInfo['ldStatus'] == 'like' ){ ?>		 
          <a href="#" class="like" id="dislike" name="dislike"><img src="../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
        <?php } 
            elseif($videoPostInfo['ldStatus'] == 'dislike'){ ?>
                <a href="#" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>
         <?php } else{?>
                    <a href="#" class="like" id="dislike" name="dislike"><img src="../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
                    <a href="#" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>
         <?php } ?>
        </div>
        <?php if($showBar){?>
        <section class="bot">
            <nav class="dislike" style="width:<?php echo $down_per; ?>%;"></nav>
            <nav class="like" style="width:<?php echo $up_per; ?>%;"></nav>
        </section>
        <?php }?>
      </div>
    </div>
</div>