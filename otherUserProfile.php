<?php
session_start();
include('config/config1.php');

if($_SESSION['login_user_id']=="")
{
	header("Location: ".SITE_URL);exit();
}
if($_REQUEST['id']==$_SESSION['login_user_id'])
{
	header("Location: myProfile.php");exit();
}
$_SESSION['page']=0;
$member_id = $_SESSION['login_user_id'];
$LargeVideoId = 0;	
$isYouTube = FALSE;

$numberOfVideoQry = "SELECT u.video_id FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.video_upload_by = '".$_REQUEST['id']."' AND u.status !='2' ORDER BY u.uploaded_date DESC LIMIT 0,4 ";
$numberOfVideoRes = mysql_query($numberOfVideoQry);
$numberOfVideoNum = mysql_num_rows($numberOfVideoRes);

	$myProfileSql = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,
	`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."'"; 
	$myProfileRes = mysql_query($myProfileSql); 
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	
	$selectStatusQry = "SELECT `friend_id`,`status`,`frnd_req_from_id`,`frnd_req_to_id` FROM `friend` WHERE ((`frnd_req_from_id`='".$_REQUEST['id']."' AND `frnd_req_to_id`='".$member_id."') OR (`frnd_req_from_id`='".$member_id."' AND `frnd_req_to_id`='".$_REQUEST['id']."')) AND `status`!='U'";
	$selectStatusRes = mysql_query($selectStatusQry); 
	$selectStatusInfo = mysql_fetch_array($selectStatusRes);  

	if($_POST['btnSend'] == 'Send')
	{
		$content = str_replace(array("'")," ",$_POST['txtContent']);
		$insertMsgQry = "INSERT INTO `message`(`message_from_id`,`message_to_id`,`message_content`) VALUES('".$member_id."','".$_REQUEST['id']."','$content')"; 
	mysql_query($insertMsgQry);
	}
	if(isset($_REQUEST['vid']) > 0){		
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id ,a.full_name, u.visit
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		WHERE a.member_id='".$_REQUEST['id']."' AND u.status!='2'  AND u.video_id = ".$_REQUEST['vid'];
	
	}
	else{
		 $iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id ,a.full_name, u.visit
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		WHERE a.member_id='".$_REQUEST['id']."' AND u.status!='2' ORDER BY u.`visit` DESC,u.`like` DESC  LIMIT 1";
	}
	
	
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
	if($iframeVideoPostNUM > 0)
	{
		$UsrImgInfoQry = "SELECT a.profile_photo_name FROM `alacut_member` a WHERE a.member_id='$member_id'";
		$UsrImgInfoRes = mysql_query($UsrImgInfoQry);
		$UsrImgInfo = mysql_fetch_array($UsrImgInfoRes);
		$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
		$getStatus=mysql_query("SELECT status FROM video_like WHERE videoID='".$iframeVideoPostInfo['video_id']."' AND memberID='".$member_id."'");
		$likestatus=mysql_fetch_array($getStatus);
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
			if($iframeVideoPostInfo['video_imag'] == 'youtube')
			{
				$isYouTube = TRUE;
				
			}
				
			$description = $description = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$iframeVideoPostInfo['video_desc']);
			$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n"),array("\'", "", "", "", "", ""),$iframeVideoPostInfo['video_name']);
			$image = $iframeVideoPostInfo['video_image'];
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
	
$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$_REQUEST['id']."' AND `status` != '2'";
$totalPostsRes = mysql_query($totalPostsQry);
$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/colorbox.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/colorbox.js"></script>
<script type="text/javascript">
var userId = '<?php echo $_REQUEST['id']?>';
var iFrameID=<?php echo $LargeVideoId;?>;
$(document).ready(function () {
	
	postedVideos(<?php echo $_REQUEST['id'];?>, <?php echo $LargeVideoId;?>);
		
	$(".openColorBox").click(function(){
		$('.inner_left').html($('#dv_msg').html());
	});
	$(window).scroll(function(){
		if ($(window).scrollTop() == $(document).height() - $(window).height()){
			LoadVideo();
		}
	});
});
function LoadVideo()
{
	
	var page=Number($('#hdn_pg').val());
	var tot=Number($('#hdn_tvd').val());
	var uid=Number($('#hdn_uid').val());
	
	if(page*4<tot && $('#topPostedByUser > div.load').length==0)
	{
		$('#topPostedByUser').append("<div class='load' style='padding-left: 50px;'><img src='ajax-loader.gif' alt='Loading...' /></div>");
	$.ajax({
			type: "POST",
			url: 'ajax/myVideo.php',
			async: "false",
			data: 'where=profile&iFrameID='+iFrameID+'&p='+page+'&s=4&u='+uid,
			success: function(data) {
				if(data!="0")
				{
					$("#topPostedByUser").append(data);
					$('#hdn_pg').val(page+1);
				}
				$('.load').remove();
			}
		});
	}
}
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
function unFriend(fromID,toID,src)
{
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			$(src).parent().html('<a href="javascript:void(0);" style="margin: 0;" onclick="addFriend('+fromID+','+toID+',this)" ,rtype="n">'+data+'</a>');
			$(src).remove();
			
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}

function addFriend(fromID,toID,src)
{
	
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			alert('Added as friend');
			$(src).parent().html('<a href="javascript:void(0);" style="margin: 0;" onclick="unFriend('+fromID+','+toID+',this)" ,rtype="u">'+data+'</a>');
			$(src).remove();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});
	}			
}
function otherFriend(otherFrndId)
{	
	$.ajax({
		type: "POST",
		url: 'ajax/otherProfileFriendsInAjax.php',
		data: 'FriendID='+otherFrndId,
		success: function(data) {
			$(".inner_left").html(data);
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
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
			callscroller();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}
function postedVideos(userID, iFrameVideoID)
{
	if(iFrameVideoID !=''){
		$("#topPostedByUser").html("<div style='padding: 20px 100px;'><img src='bigLoader.gif' alt='Loading...' /></div>");
		$.ajax({
			type: "POST",
			url: 'ajax/oherProfileVideoInAjax.php',
			data: 'loginID='+userID+'&iFrameID='+iFrameVideoID,
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
	else if(i==0)
		$(txt).val('\n'+v);
	else if(i==v.length)
		$(txt).val(v+'\n');
   	           return;
  }else if(e && e.keyCode == 13 ){
	   if($(txtComment).val()!="" && $('#div_youTube').attr("vidid") )
      		postComment(uid,$('#div_youTube').attr("vidid"));
		else
			alert("Please Enter Comment!!");
   }
   
}
</script>
</head>
<body>
<form name="findFriends" method="post" action="">
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
    <!--<section class="left_body_box" <?php if($numberOfVideoNum == 0){ echo "style='display:none;'"; }?>>
    	<iframe id="div_youTube" width="640" height="360" src="<?php echo $videoSrc;?>" object="<?php echo $iframeVideoPostInfo['video_object']?>" iframeVideoType = "<?php echo $iframeVideoPostInfo['video_type'] ?>" vidID = "<?php echo $iframeVideoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <section class="left_vid_cont">
          <div class="vid_name" id="vidTitle" title="<?php echo $title;?>"><?php if (strlen($title) >= 30) {echo $title= substr($title, 0, 27) . '...';}else{echo $title;}?>&nbsp;</div>
          <a href='otherUserProfile.php?id=<?php echo $_REQUEST['id']; ?>'><div class="user_name"><?php echo $iframeVideoPostInfo['full_name']?></div></a>
          <div class="sn_img">
          	<a id="li" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id'];?>&title=<?php echo $title;?>&summary=<?php echo $description;?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0);">
          <img src="images/in.jpg" width="30" height="30" alt="in" />
          </a>
          <a id='fb' href="javascript: void(0);" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $description;?>&amp;p[url]=<?php echo 'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id']; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" uri='<?php echo $iframeVideoPostInfo['video_url']; ?>' pic='<?php echo $image;?>'>
          <img src="images/fb.jpg" width="30" height="30" />
          </a>
		  <a id="tw" onclick="window.open('https://twitter.com/intent/tweet?source=webclient&text=<?php echo $title;?>&url=<?php echo 'http://www.alacut.com?vid='.$iframeVideoPostInfo['video_id'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0);"><img src="images/twt.jpg" width="30" height="30" /></a>
          <a href="javascript: void(0);"><img src="images/alacut.jpg" width="30" height="30" /></a>
			</div>
          <div class="choice">
                <div class="top">	
                <?php if($likestatus['status'] == 'like' ){ 
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" ><img src="images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>';
					echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['like'].'</div>';
					echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" clickable="false"><img src="images/like.jpg" title="I like it" width="24" height="24"></a>'
				?>		 
                  
                <?php } 
					else if($likestatus['status'] == 'dislike'){
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="dislike" name="dislike" clickable="false"><img src="images/dislike.jpg" title="I Don\'t like it" width="24" height="24"></a>'; 
						echo '<div id="spn_cnt" class="hits">'.$iframeVideoPostInfo['dislike'].'</div>';
						echo '<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like" ><img src="images/like.jpg" title="I like it" width="24" height="24"></a>'
					?>
                  		
                 <?php } else{?>
                 	<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="dislike" id="dislike" name="dislike"><img src="images/dislike.jpg" width="24" height="24" title="I Don't like it"></a>
                 		<div id="spn_cnt" class="hits"><?php echo $iframeVideoPostInfo['like']>$iframeVideoPostInfo['dislike']?$iframeVideoPostInfo['like']:$iframeVideoPostInfo['dislike'];?></div>	
             			<a href="javascript:void(0);" onclick="MarkLikeDisLike(this);" class="like" id="like" name="like"><img src="images/like.jpg" title="I like it" width="24" height="24"></a>
                            
                            
                 <?php } ?>
              </div>
                <div class="bot">
                    <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                    <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
                </div>
               
              </div>
        </section>
        <div class="left_vid_desc" id="vid_desc"><?php echo $description;?></div>
        <div id="vid_comment_box">
        <?php /*include("loginUserCommentPost.php");*/?>
        </div>
        <section class="left_vid_desc">
          <article class="user_img"><?php if($UsrImgInfo['profile_photo_name'] != ''){
                    echo '<img src="upload/profilePhotos/'.$UsrImgInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="images/no-image.jpg" alt="" height="40" width="40">';
                     }?></article>
       	  <div ><textarea id="txtComment" name="txtComment" class="desc" onKeyPress="checkSubmit(this,event,'<?php echo $member_id?>')" vid='<?php echo $LargeVideoId;?>'></textarea>
       	  </div>
        </section>
    </section>-->
    <?php include 'myVideo.php';?>
    <?php if($numberOfVideoNum == 0){?>
    <div class="left_body_box" id="no_video">
	<img src="images/no-video.jpg" width="640" height="360" />
    </div>
    <?php } ?>
    
</section>
<aside class="inner_right">
    <section class="user_img">
      <section class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </section>
      <section class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </section>
    </section>
    <section class="user_btn">
    <nav class="button" id="msg"><a class='openColorBox'  href='javascript:void(0);'>Message</a></nav>
    <nav class="button" onclick="otherFriend('<?php echo $_REQUEST['id'];?>')"><a herf="javascript:void(0);">Friends</a></nav>
    <nav class="button"><a href="otherUserPosts.php?id=<?php echo $_REQUEST['id'];?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></nav>
    <?php if($selectStatusInfo['status'] == 'C') {?>
    <nav class="button" ><a class="button" href="javascript:void(0);" style="margin: 0;" onclick="unFriend('<?php echo $selectStatusInfo['frnd_req_from_id'];?>','<?php echo $selectStatusInfo['frnd_req_to_id'];?>',this)" rtype='u'>unfriend</a>
    <?php }else if($selectStatusInfo['status'] == 'P' && $selectStatusInfo['frnd_req_from_id']==$member_id){?>
    	<nav class="button" ><a class="button" href="javascript:void(0);" style="margin: 0;" onclick="unFriend('<?php echo $selectStatusInfo['frnd_req_from_id'];?>','<?php echo $selectStatusInfo['frnd_req_to_id'];?>',this)" rtype='c'>cancel request</a>
    <?php }else if($selectStatusInfo['status'] == 'P' && $selectStatusInfo['frnd_req_to_id']==$member_id){?>
    	<nav class="button" ><a class="button" href="javascript:void(0);" style="margin: 0;" onclick="addFriend('<?php echo $selectStatusInfo['frnd_req_from_id'];?>','<?php echo $selectStatusInfo['frnd_req_to_id'];?>',this)" rtype='a'>accept</a>
    <?php } else {?>
    <nav class="button" ><a href="javascript:void(0);" onclick="addFriend('<?php echo $member_id;?>','<?php echo $_REQUEST['id'];?>',this)" rtype='n' style="margin: 0;">add as friend</a></nav>
    <?php }?>                                           
    </nav>
  </section>  
  
  
<section id="topPostedByUser"></section>
</aside>
<div id="dv_msg" style="display:none;">
	<div id="lightbox_form" >
    <div class="form_bg">
    	<div class="padT">
        	<div class="form_header">Message</div>
        </div>
        <div class="form_pad">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Message content</strong>: </td>
                <td>
                	<textarea id="txtContent" name="txtContent" style="height:100px; width:340px;"></textarea>
                </td>
                <td class="status">&nbsp;</td>
              </tr>
            </table>
            <div class="form_sbmt"><input type="button" id="btnSend" value="Send" /></div>
			<div class="clear"></div>
        </div>
        
    </div>
    <div class="clear"></div>
</div>	
</div>
</section><?php include("footer.php");?>
<input type="hidden" value="<?php echo $totalPostsInfo['count']?>" id="hdn_tvd"/>
  <input type="hidden" value="1" id="hdn_pg"/>
  <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" id="hdn_uid"/>
</div>
</form>
</body>
</html>