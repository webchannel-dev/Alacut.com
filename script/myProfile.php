<?php
session_start();
include('../config/config1.php');

//require_once("../lib/db.function.php");
if($_SESSION['login_user_id']=="" || $_SESSION['login_user_id']==0)
{
	header("Location:index.php");exit();
}
$member_id = $_SESSION['login_user_id'];
$LargeVideoId = 0;
$isYouTube = FALSE;

$numberOfVideoQry = "SELECT u.video_id FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.video_upload_by = '".$member_id."' AND u.status !='2' ";
$numberOfVideoRes = mysql_query($numberOfVideoQry);
$numberOfVideoNum = mysql_num_rows($numberOfVideoRes);

	$myProfileSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$member_id."' AND active = '1'";
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);

	if(isset($_REQUEST['vid']) > 0){		
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id, a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$member_id."' AND u.status!='2'  AND u.video_id = ".$_REQUEST['vid']."  LIMIT 1";
	}else{
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id, a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$member_id."' AND u.status!='2'  ORDER BY `visit` DESC LIMIT 1";
	}
	
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
	if($iframeVideoPostNUM > 0)
	{
		$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
		$LargeVideoId = $iframeVideoPostInfo['video_id'];
		$iframeVidObject = $iframeVideoPostInfo['video_object'];
		$update = "UPDATE `upload_video` SET visit = visit + 1 WHERE video_id = '".$LargeVideoId."'";
		mysql_query($update);
		if($iframeVidObject == '0' || $iframeVidObject == "")
		{
		echo 'This is not a valid youtube video url. Please, give a valid url...';
		} 
		else
		{
			if($iframeVideoPostInfo['video_type'] == 'youtube')
			{
				$isYouTube = TRUE;
				$image = "http://i1.ytimg.com/vi/".$iframeVidObject."/mqdefault.jpg";
			}else{
				$image = $iframeVideoPostInfo['video_image'];
			}
			$desc = $iframeVideoPostInfo['video_desc'];//$vimeoDetails->description;
			$description = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$desc);
			$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$iframeVideoPostInfo['video_name']);;//$vimeoDetails->title;
				
		}
		$showBar = FALSE;
	  	if($iframeVideoPostInfo['like'] != 0 OR $iframeVideoPostInfo['dislike'] !=0)
		{
			$up_value = $iframeVideoPostInfo['like'];
			$down_value = $iframeVideoPostInfo['dislike'];
			$total = $up_value + $down_value;
			$up_per = ($up_value*100)/$total; 
			$down_per = ($down_value*100)/$total;
			$showBar = TRUE;
		 }
		 
		$videoSrc = "";
		if($iframeVideoPostInfo['video_type'] == "youtube"){
				$videoSrc = "http://www.youtube.com/embed/" . $iframeVideoPostInfo['video_object'];
		 }else if($iframeVideoPostInfo['video_type'] == "vimeo"){
			 $videoSrc = "http://player.vimeo.com/video/" . $iframeVideoPostInfo['video_object'];
		 }
	}
	
	$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_id."' AND `status` != '2'";
	$totalPostsRes = mysql_query($totalPostsQry);
	$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<title>alacut: My Profile</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui-1.8.15.custom.css" />
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
$(document).ready(function () {
	$('#lnk_ff').click(function(){
		$('#dv_video').hide();
		$('.dv_frnd').show();
	});
	$('.cancel').click(function(){
		$('#dv_video').show();
		$('.dv_frnd').hide();
	});
	postedVideos(<?php echo $member_id;?>, <?php echo $LargeVideoId;?>);
	
});

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
function getPos(input)
{
	
        if (!input) return; // No (input) element found
        if (document.selection) {
            // IE
           input.focus();
        }
        return(('selectionStart' in input ? input.selectionStart:'' || Math.abs(document.selection.createRange().moveStart('character', -input.value.length))));
}

function checkSubmit(txt,e,uid)
{
   if (e && e.keyCode == 13 && e.shiftKey) {
   	var i=getPos(txt);
   	var v=$(txt).val();
   	if(i>0 && i<v.length)
   		$(txt).val(v.substring(0,i)+'\n'+v.substring(i,v.length));
	 	           return;
  }else if(e && e.keyCode == 13 )
   {
	   if($(txt).val()!="" && $('#div_youTube').attr("vidid") )
      		postComment(uid,$('#div_youTube').attr("vidid"));
		else
			alert("Please Enter Comment!!");
   }
   
}
function trimTitle(title)
{
	
	var maxlength = 28;
	var strlength = title.length;
	if (strlength > maxlength) {
	var s = title.substr(0,maxlength);
	var y = s.lastIndexOf(" ");
	s = s.substr(0, y);
	title = s + "...";
	}
	return title;
}
function trimDescription(descriptn)
{
	var maxlength = 300;
	var strlength = descriptn.length;
	if (strlength > maxlength) {
	var b = descriptn.substr(0,maxlength);
	var c = b.lastIndexOf(" ");
	b = b.substr(0, c);
	descriptn = b + "...";
	}
	return descriptn;
}

function postComment(userID,vID)
{
	var textAreaComment = $("#txtComment").val();
	if(textAreaComment != ""){
	
	$.ajax({
		type: "POST",
		url: 'ajax/commentPostInAjax.php',
		data: 'loginID='+userID+'&comment='+textAreaComment+'&videoId='+vID,
		success: function(data) {
			$("#vid_comment_box").append(data);	
			$("#txtComment").val("");
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}

function getYouTubeDetails(videoid){     
	v=videoid;
	$.getScript('http://gdata.youtube.com/feeds/api/videos/' + encodeURIComponent(videoid.objectVal) + '?v=2&alt=json-in-script&callback=youtubeDataCallback');
}
function refineString(value)
{
	var delim="\\'";
	return value.replace(/\'/g,delim).replace(/&/g,'');
}
function youtubeDataCallback(data) 
{
	var odesc = data.entry.media$group.media$description.$t.replace(/\n/g, '<br/>');
	var otit = data.entry.title.$t;
	var sec = data.entry.media$group.yt$duration.seconds;
	desc=refineString(odesc);
	tit=refineString(otit);
	
	if(sec>240)
	{
		alert("Video length is more than 4 minute");
	}
	else
	{
		if(upload!=null)
		{
			UploadVideoToDb(v,desc,tit);
		}
		else
		{
			
			x=encodeURI(tit);
			d=odesc.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,' ');
			var u=$('#fb').attr('uri');
			var i=$('#fb').attr('pic');

			var fbLink = CreateFbShareUrl(x,d,u,i);			
			$('#fb').click(function(){
				window.open(fbLink, 'facebook', 'toolbar=0,status=0,width=600,height=400');
			});
			
			$('#vidTitle').html(trimTitle(otit));
			$('#vid_desc').html(trimDescription(odesc));
		}		
	}
}

function postedVideos(userID, iFrameVideoID)
{
	if(iFrameVideoID !=''){
		$("#topPostedByUser").html("<div style='padding: 20px 100px;'><img src='bigLoader.gif' alt='Loading...' /></div>");
		$.ajax({
			type: "POST",
			url: 'ajax/PostedVideoInAjax.php',
			data: 'iFrameID='+iFrameVideoID+'&p=p',
			success: function(data) {
				$("#topPostedByUser").html(data);
			},
			error: function(e) {
				alert("There is somme error in the network. Please try later.");
			}
		});
	}else{
		$("#topPostedByUser").html("<div class='no_post'>&nbsp;</div>");	
	}
}
</script>
</head>

<body>
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
	<div class="dv_frnd" style="display:none;">
		<header class="head">
        <h1>Find your friends on alacut!</h1>
        
      </header>
      <section class="left_body_box">
      <section class="serch_friend">
      	<nav class="button"><a href="javascript:void(0);" class="cancel">Cancel</a></nav>
      <article class="sfriend_box">
        <div class="sfriend_menu"><a href="gmail_invite/"><img src="../images/hotmail.jpg" width="150" height="40"></a></div>
        <div class="sfriend_menu_unsel"><img src="../images/gmail.jpg" width="87" height="40"></div>  
        <div class="sfriend_menu_unsel"><img src="../images/yahoomail.jpg" width="150" height="40"></div>
        <div class="sfriend_menu_unsel"><img src="../images/facebook.jpg" width="150" height="40"></div>
      </article>
        <article class="sfriend">
        	<h1>Check your Hotmail Address Book</h1>
             <article>&nbsp;</article>
             <article>&nbsp;</article>
        </article>
      </section>
  </section>

	</div>
<div id="dv_video">
    <section class="left_body_box" <?php if($numberOfVideoNum == 0){ echo "style='display:none;'"; }?>>
    	<iframe id="div_youTube" width="640" height="360" src="<?php echo $videoSrc;?>" object="<?php echo $iframeVideoPostInfo['video_object']?>" iframeVideoType = "<?php echo $iframeVideoPostInfo['video_type'] ?>" vidID = "<?php echo $iframeVideoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <section class="left_vid_cont">
          <div class="vid_name" id="vidTitle" title="<?php echo $title;?>"><?php if (strlen($title) >= 30) {echo $title= substr($title, 0, 27) . '...';}else{echo $title;}?></div>
          <div class="user_name"><?php echo $iframeVideoPostInfo['full_name']?></div>
          <div class="sn_img">
          	<a id="li" onclick="window.open('http://www.linkedin.com/shareArticle?mini=false&url=<?php echo $iframeVideoPostInfo['video_url'];?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0);">
          <img src="../images/in.jpg" width="30" height="30" alt="in" />
          </a>
          <a id='fb' href="javascript: void(0);" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $description;?>&amp;p[url]=<?php echo 'http://www.alacut.com'; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" uri='<?php echo $iframeVideoPostInfo['video_url']; ?>' pic='<?php echo $image;?>'>
          <img src="../images/fb.jpg" width="30" height="30" />
          </a>
		  <a id="tw" onclick="window.open('http://twitter.com/home?status= video url shred -  <?php echo $iframeVideoPostInfo['video_url'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0);"><img src="../images/twt.jpg" width="30" height="30" /></a>
          <a href="javascript: void(0);"><img src="../images/alacut.jpg" width="30" height="30" /></a>
			</div>
          <div class="choice">
                <div class="top">	
                <?php if($iframeVideoPostInfo['ldStatus'] == 'like' ){ 
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" ><img src="../images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>';
					echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['like'].'</div>';
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" clickable="false"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>'
				?>		 
                  
                <?php } 
					else if($iframeVideoPostInfo['ldStatus'] == 'dislike'){
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" clickable="false"><img src="../images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>'; 
						echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['dislike'].'</div>';
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" ><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>'
					?>
                  		
                 <?php } else{?>
                 	<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="dislike" id="dislike" name="dislike"><img src="../images/dislike.jpg" width="24" height="24" title="I Don't like it"></a>
                 	<div id="spn_cnt" class="hits"><?php echo $iframeVideoPostInfo['like']>$iframeVideoPostInfo['dislike']?$iframeVideoPostInfo['like']:$iframeVideoPostInfo['dislike'];?></div>	
                 	<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like"><img src="../images/like.jpg" title="I like it" width="24" height="24"></a>		
                 <?php } ?>
              </div>
                
                <div class="bot" style="display:<?php if($showBar) echo'block;'; else echo 'none;';?>">
                    <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                    <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
                </div>
                
              </div>
        </section>
        <section class="left_vid_desc" id="vid_desc"><?php echo $description;?></section>
        <div id="vid_comment_box">
        <?php include("loginUserCommentPost.php");?>
        </div>
        <section class="left_vid_desc">
          <article class="user_img"><?php if($myProfileInfo['profile_photo_name'] != ''){
                    echo '<img src="../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
                     }?></article>
       	  <div ><textarea id="txtComment" name="txtComment" class="desc" onKeyPress="checkSubmit(this,event,'<?php echo $member_id?>')" vid='<?php echo $LargeVideoId;?>'></textarea>
       	  </div>
       	  
        </section>
    </section>
    <?php if($numberOfVideoNum == 0){?>
    <div class="left_body_box" id="no_video">
	<img src="../images/no-video.jpg" width="640" height="360" />
    </div>
    <?php } ?>
    </div>
</section>
<aside class="inner_right">
   <section class="user_img">
      <section class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </section>
      <section class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="../images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </section>
    </section>
    <section class="user_btn">
    <nav class="button"><a href="javascript:void(0);" id="lnk_ff">Find&nbsp;Friends</a></nav>
    <nav class="button"><a href="myFriends.php">Friends</a></nav>
    <nav class="button"><a href="allPosts.php"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></nav>
    <nav class="button"><a href="editUserInfo.php" style="margin: 0;">Edit&nbsp;Info</a></nav>
  </section>

<!--<section class="right_thumb">
  <?php while($videoPostInfo = mysql_fetch_array($videoPostRes)){
 	$thumbImgPath = '';
		if($videoPostInfo['video_type']=="youtube"){
			$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
		}else{
			$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
			$thumbImgPath = $vimeoInfo->thumbnail_medium;
		}
 ?>     
        <article class="thumb"><a href="myProfile.php?vid=<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
      <div class="home_des_thumb"> 
        <div class="title"><?php if(strlen($videoPostInfo['video_name']) > 24) {echo $title= substr($videoPostInfo['video_name'], 0, 21) . '...';}else{echo $videoPostInfo['video_name'];}?></div>  
        <div class="username"><?php echo $videoPostInfo['full_name']?></div>
      </div>
      <?php
	  	if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
		{
			$up_value = $videoPostInfo['like'];
			$down_value = $videoPostInfo['dislike'];
			$total = $up_value + $down_value;
			$up_per = ($up_value*100)/$total; 
			$down_per = ($down_value*100)/$total;?> 
            <div class="like_bar2">
              <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
              <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
            </div>
		<?php }?>
    </article>   
    <?php } ?>
</section>-->
<section id="topPostedByUser"></section>
</aside>
</section><?php include("footer.php");?>
</div>

</body>
</html>

            