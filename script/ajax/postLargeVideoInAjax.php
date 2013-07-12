<?php

include('../../config/config1.php');
$isYouTube = FALSE;
 $videoPostQry ="SELECT u.video_id,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id, a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$_POST['userId']."' AND u.status!='2'  AND u.video_id = ".$_REQUEST['lvId']."  LIMIT 1"; 
$getStatus=mysql_query("SELECT status FROM video_like WHERE videoID='".$_REQUEST['lvId']."' AND memberID='".$_POST['userId']."'");
$likestatus=mysql_fetch_array($getStatus);				 
	$videoPostRes = mysql_query($videoPostQry);
	$videoPostInfo = mysql_fetch_array($videoPostRes);
	
	if($videoPostInfo['video_type'] == 'youtube')
	{
		$isYouTube = TRUE;
		
	}
	$summary = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_desc']);
	$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	$image = $videoPostInfo['video_image'];
	
	if($videoPostInfo['video_type'] == "youtube"){
			$videoSrc = "http://www.youtube.com/embed/" . $videoPostInfo['video_object'];
	 }else if($videoPostInfo['video_type'] == "vimeo"){
		 $videoSrc = "http://player.vimeo.com/video/" . $videoPostInfo['video_object'];
	 }
	 $showBar = FALSE;
  	if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
	{
		$up_value = $videoPostInfo['like'];
		$down_value = $videoPostInfo['dislike'];
		$total = $up_value + $down_value;
		$up_per = ($up_value*100)/$total; 
		$down_per = ($down_value*100)/$total;
		$showBar = TRUE;
	 }
?>
<script type="text/javascript">
function MarkLikeDisLike(lnk)
{
		var name=$(lnk).attr("name");		
		var id = $("#div_youTube").attr("VidID");
		if($(lnk).attr("clickable")!="false")
		{
		$.ajax
		({
			type: "POST",
			url: "ajax/rating.php",
			data: 'id='+id+'&name='+name,
			cache: false,
			success: function(data)
			{
				if(data!='')
					setLikeBar(name,data);
			}
			});
		}
		return false;
}	
function setLikeBar(name,data)
{
	var l=data.split(':');
	
	var lk=Number(l[0]);
	var uk=Number(l[1]);
	
	var t=lk+uk;
	$('.bot').show();
	if(name=="like")
	{
		
		$("#like").attr("clickable","false");
		$('#dislike').removeAttr("clickable");
		$('#spn_cnt').text(lk);
		
	}
	else
	{
		$("#dislike").attr("clickable","false");
		$('#like').removeAttr("clickable");
		$('#spn_cnt').text(uk);
	}
	var lp=(lk*100/t)+'%;';
	var up=(uk*100/t)+'%;';
	$('.bot > .like').attr("style","width:"+lp);
	$('.bot > .dislike').attr("style","width:"+up);
}
</script>
<!--<div id="largeVideo">-->
 <iframe id="div_youTube" width="640" height="360" src="<?php echo $videoSrc;?>" vidID = "<?php echo $videoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
  <div class="left_vid_cont">
      <div class="vid_name" id="vidTitle" title="<?php echo $title;?>"><?php if (strlen($title) >= 30) {echo $title= substr($title, 0, 27) . '...';}else{echo $title;}?></div>
      <div class="user_name"><?php echo $videoPostInfo['full_name']?></div>
      <div class="sn_img">
      	<a onclick="window.open('http://www.linkedin.com/shareArticle?mini=false&url=<?php echo 'http://www.alacut.com';?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0)"><img src="../images/in.jpg" width="30" height="30" alt="in" />
      		
      	</a>
      	<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $videoPostInfo['video_url']; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" href="javascript: void(0)"><img src="../images/fb.jpg" width="30" height="30" />
      		
      	</a><a onclick="window.open('http://twitter.com/home?status= video url shred -  <?php echo $videoPostInfo['video_url'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0)"><img src="../images/twt.jpg" width="30" height="30" /></a><a href="javascript: void(0)"><img src="../images/alacut.jpg" width="30" height="30" /></a></div>
      <div class="choice">
                <div class="top">	
                <?php if($likestatus['status'] == 'like' ){ 
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" ><img src="../images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>';
					echo '<div id="spn_cnt" class="hits">'.$videoPostInfo['like'].'</div>';
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" clickable="false"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>'
				?>		 
                  
                <?php } 
					else if($likestatus['status'] == 'dislike'){
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" clickable="false"><img src="../images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>'; 
						echo '<div id="spn_cnt" class="hits">'.$videoPostInfo['dislike'].'</div>';
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" ><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>'
					?>
                  		
                 <?php } else{?>
                 	<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="dislike" id="dislike" name="dislike"><img src="../images/dislike.jpg" width="24" height="24" title="I Don't like it"></a>
                 		<div id="spn_cnt" class="hits"><?php echo $videoPostInfo['like']>$videoPostInfo['dislike']?$videoPostInfo['like']:$videoPostInfo['dislike'];?></div>	
             			
                         <a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>   
                            
                 <?php } ?>
              </div>
                
                <div class="bot" style="display:<?php if($showBar) echo'block;'; else echo 'none;';?>">
                    <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                    <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
                </div>
                
              </div>
</div>
<!--</div>-->