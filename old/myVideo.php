<?php

?>
<!--<body>-->
	<script type="text/javascript" src="js/jquery_1.9.0.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/prettify/prettify.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.js"></script>
<link href="css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript">
 var newJQuery = jQuery.noConflict(true);
    newJQuery(function(){
		 	
      	callscroller();
		
    });
	function callscroller()
	{
		newJQuery('#homeFrame').slimscroll({
        	disableFadeOut: true,
        	height:'520px'  			
      	});
		newJQuery('#vid_desc').slimscroll({
        	disableFadeOut: true,
        	width:'635px',
        	height: '50px'
      	});
      	$('#vid_desc ').parent('.slimScrollDiv').attr('style','position: relative; overflow: hidden; min-height: 50px;');
      	$('#homeFrame ').parent('.slimScrollDiv').attr('style','position: relative; overflow: hidden; min-height: 520px;box-shadow: 0 0 1px #333;');
      	
	}
	</script>
	<section id="homeFrame" class="left_body_box" <?php  if($numberOfVideoNum == 0){ echo "style='display:none;'"; }?>>
    	<iframe id="div_youTube" width="640" height="360" src="<?php echo $videoSrc;?>" object="<?php echo $iframeVideoPostInfo['video_object']?>" iframeVideoType = "<?php echo $iframeVideoPostInfo['video_type'] ?>" vidID = "<?php echo $iframeVideoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <section class="left_vid_cont">
          <div class="vid_name" id="vidTitle" title="<?php echo $title;?>"><?php if (strlen($title) >= 30) {echo $title= substr($title, 0, 27) . '...';}else{echo $title;}?></div>
          <a style='text-decoration: none;' href="<?php if($iframeVideoPostInfo['video_upload_by']==$_SESSION['login_user_id']) echo "myProfile.php"; else echo "otherUserProfile.php?id=".$iframeVideoPostInfo['video_upload_by']?>"><div class="user_name"><?php echo $iframeVideoPostInfo['full_name'];?></div></a>
          <div class="sn_img">
          <a id="li" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id'];?>&title=<?php echo urlencode($title);?>&summary=<?php echo urlencode($description);?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0);">
          <img src="images/in.jpg" width="30" height="30" alt="in" />
          </a>
          <a id='fb' href="javascript: void(0);" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode($title);?>&amp;p[summary]=<?php echo urlencode($description);?>&amp;p[url]=<?php echo  'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id']; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" uri='<?php echo $iframeVideoPostInfo['video_url']; ?>' pic='<?php echo $image;?>'>
          <img src="images/fb.jpg" width="30" height="30" />
          </a>
		  <a id="tw" onclick="window.open('https://twitter.com/intent/tweet?source=webclient&text=<?php echo urlencode($title);?>&url=<?php echo 'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0);"><img src="images/twt.jpg" width="30" height="30" /></a>
          <a href="javascript: void(0);"><img src="images/alacut.jpg" width="30" height="30" /></a>
          </div>
          <!--<?php if($showBar){ echo "<div class='hits' id='hits'>".$total."</div>";}?>-->
			
              <div class="choice">
                <div class="top">	
                <?php if($likestatus['status'] == 'like' ){ 
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" ><img src="images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>';
					echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['like'].'</div>';
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" clickable="false"><img src="images/like.jpg" title="I like it" width="24" height="24"></a>';
				?>		 
                  
                <?php } 
					else if($likestatus['status'] == 'dislike'){
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" clickable="false"><img src="images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>'; 
						echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['dislike'].'</div>';
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" ><img src="images/like.jpg" title="I like it" width="24" height="24"></a>';
					?>
                 <?php } else{?>
                 	
                 		<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="dislike" id="dislike" name="dislike"><img src="images/dislike.jpg" width="24" height="24" title="I Don't like it"></a>
                 		<div id="spn_cnt" class="hits"><?php echo $iframeVideoPostInfo['like']>$iframeVideoPostInfo['dislike']?$iframeVideoPostInfo['like']:$iframeVideoPostInfo['dislike'];?></div>	
             			<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like"><img src="images/like.jpg" title="I like it" width="24" height="24"></a>   
                  <?php } ?>
              </div>
                
                <div class="bot" >
                    <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                    <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
                </div>
                
              </div>
        </section>
        <section class="left_vid_desc" id="vid_desc"><?php echo $description;?></section>
        <!-- Login user to poat comment-->
		<div id="vid_comment_box">
        <?php include("loginUserCommentPost.php");?>
        </div>
        <section class="left_vid_descr">
          <article class="user_img">
          	<?php if($UsrImgInfo['profile_photo_name'] != ''){
                    echo '<img id="uimg" src="upload/profilePhotos/thumb/t_40/'.$UsrImgInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img id="uimg" src="upload/profilePhotos/thumb/t_40/no-image.jpg" alt="" height="40" width="40">';
                     }?>
         </article>
       	  <div>
       	  	<textarea id="txtComment" name="txtComment" class="desc" onKeyPress="checkSubmit(this,event,'<?php echo $member_id?>')" vid='<?php echo $LargeVideoId;?>'></textarea>
       	  </div>
       	  
        </section>
    </section>
   
    

