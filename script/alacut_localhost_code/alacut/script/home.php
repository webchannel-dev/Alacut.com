<?php
session_start();
require_once("../lib/db.function.php");
include('../config/config1.php');

if($_SESSION['login_user_id']=="")
{
header("Location: index.php");
}

$member_id = $_SESSION['login_user_id'];
$LargeVideoId = 0;
$numberOfVideoQry = "SELECT u.video_id FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.video_upload_by = '$member_id'";
$numberOfVideoRes = mysql_query($numberOfVideoQry);
$numberOfVideoNum = mysql_num_rows($numberOfVideoRes);
	
	if(isset($_REQUEST['vid']) > 0){		
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,u.video_url,a.member_id ,a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='$member_id' AND u.status!='2'  AND u.video_id = ".$_REQUEST['vid']."  LIMIT 1";
	}
	else if($_REQUEST['videoObj'] !='')
	{
		 $iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,u.video_url,a.member_id, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='$member_id' AND u.status!='2'  AND u.video_object= '".$_REQUEST['videoObj']."'  LIMIT 1";
	}
	else{
		$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.like,u.dislike,u.video_url,a.member_id ,a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='$member_id' AND u.status!='2'  ORDER BY `like` DESC LIMIT 1";
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
		echo 'This is not a valid video url. Please, give a valid url...';
		} 
		else
		{
			if($iframeVideoPostInfo['video_type'] == 'youtube')
			{
				$videoInfo = parseVideoEntry($iframeVidObject);		
				$description = $videoInfo->description;
				$title = $videoInfo->title;
				$duration = $videoInfo->length;
				$image = "http://img.youtube.com/vi/".$iframeVidObject."/1.jpg";
			}else{
				$vimeoDetails = vimeoVideoDetails($iframeVidObject);
				$description = $vimeoDetails->description;
				$title = $vimeoDetails->title;
				$duration = $vimeoDetails->duration;
				$image = $vimeoDetails->thumbnail_medium;
			}
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
	
		$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
		FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
		WHERE member_id='$member_id' AND u.status!= '2'  AND u.video_id != ".$iframeVideoPostInfo['video_id']; 
		$videoPostRes = mysql_query($videoPostQry);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--<meta charset="utf-8" />-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<title>alacut: Home</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script>
var time = '<?php echo $duration;?>'; 
$(document).ready(function () {	

	$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val());
		
		});
	if(time < 240){
		if($("#div_youTube").attr("iframeVideoType") == "youtube")
		{
			$("#div_youTube").attr("src" ,"http://www.youtube.com/embed/"+$("#div_youTube").attr("object"));
		}
		else if($("#div_youTube").attr("iframeVideoType") == "vimeo")
		{	
			$("#div_youTube").attr("src","http://player.vimeo.com/video/"+$("#div_youTube").attr("object"));
		}
	}
	
	$("#shareImageURL").keypress(function(){
		var canvas = document.getElementById("imgBG");
		canvas.innerHTML=$("#shareImageURL").val();
	});
	
	MarkLikeDisLike();
		
	$(".vid_up").click(function(){
		$(".head_but_box_full").show();
		$(".head_but_box_img").hide();  
		$(".head_but_box").hide();  
		$("#heading").hide();
		});     
	$(".img_up").click(function(){
		$(".head_but_box_img").show();
		$(".head_but_box_full").hide();
		$(".head_but_box").hide();
		$("#heading").hide();
		});   
	$(".div").click(function(){
		$(".head_but_box_full").hide();
	});
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
	
function youtube_parser(url)
{
	var obj = new Object();
	
	if(url.indexOf("youtu.be")!=-1)
	{
   		url=url.substring(url.lastIndexOf("/")+1,url.length);
		$("#div_youTube").attr("src","http://www.youtube.com/embed/"+url);
		obj.name = "youtube";
		obj.objectVal = url;
	}
	else if(url.indexOf("www.youtube.com")!=-1)
	{
		url=url.split("v=")[1];
   		if(url.lastIndexOf("&")!=-1)
   		{
	   		url=url.split("&")[0];
	   	}
		$("#div_youTube").attr("src","http://www.youtube.com/embed/"+url);
		obj.name = "youtube";
		obj.objectVal = url;
	}
	else if(url.indexOf("vimeo.com")!=-1)
	{
		url=url.split("#")[0];
		if(url.lastIndexOf("/")!=-1)
			url=url.substring(url.lastIndexOf("/")+1,url.length);
		$("#div_youTube").attr("src","http://player.vimeo.com/video/"+url);
		obj.name = "vimeo";
		obj.objectVal = url;
	}
	else
	{
		obj=null;
	}
	return obj;	
}

function videoShare()
{
	var shareValUrl=$("#shareVideoURL").val(); 
	shareValObject=youtube_parser(shareValUrl);
	
	if(time < 240)
	{
	shareValObject=youtube_parser(shareValUrl);
		if(shareValObject != null)
		{
			$.ajax({
				type: "POST",
				url: 'ajax/videoUploadInAjax.php',
				data: 'url='+shareValUrl+'&type='+shareValObject.name+'&object='+shareValObject.objectVal+'&timePeriod='+time,
				success: function(data) {
					alert('Video is uploaded successfully');
				},
				error: function(e) {
					alert("There is somme error in the network. Please try later.");
				}
			});	
		}
		else
		{
			alert("Please Enter A url!!!!");
		}
	}else{
		alert('Not');
		} 
}

/*function videoLength(obj)
{
	$videoInfo = parseVideoEntry(obj);	
	$duration = $videoInfo->length;
}*/

function youTubeDesc()
{
	var shareValUrl1=$("#shareVideoURL").val(); //alert(shareValUrl);
	shareValObject1=youtube_parser(shareValUrl1); 
	var videoID = $(".video").attr("VidID");
	if(shareValObject1 != null)
	{
		$.ajax({
			type: "POST",
			url: 'ajax/youTubeDescInAjax.php',
			data: 'type='+shareValObject1.name+'&object='+shareValObject1.objectVal,
			success: function(data) {
				$(".left_vid_desc").text(data);
			},
			error: function(e) {
				alert("Error");
			}
		});	
	}
}

function youTubeTitle()
{
	var shareValUrl2=$("#shareVideoURL").val(); //alert(shareValUrl);
	shareValObject2=youtube_parser(shareValUrl2);	
	
	if(shareValObject2 != null)
	{
		$.ajax({
			type: "POST",
			url: 'ajax/youTubeTitleInAjax.php',
			data: 'type='+shareValObject1.name+'&object='+shareValObject1.objectVal,
			success: function(data) {
				$("#vidTitle").text(data);
			},
			error: function(e) {
				alert("Error");
			}
		});	
	}
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
			$("#vid_comment_box").html(data);	
			$("#txtComment").val("");
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}else{
	}
}
</script>
</head>
<!--<body>-->
<form name="home" method="post" action="" enctype="multipart/form-data">
<div class="wrapper">
  <?php include("header.php");?>
<section class="inner">
<section class="inner_left">
      <header class="head">
        <h1 id= "heading" style="display: one;">What would you like to share?</h1>
        <section class="head_but_box" style="display: one;">
          <nav class="img_up"><a href="#">An image update</a></nav>
          <nav class="vid_up"><a href="#">A video link</a></nav>
        </section>
        <section class="head_but_box_full" style="display: none;">
       	<div class="vid_input"><input type="text" name="shareVideoURL" id="shareVideoURL" value="Insert a link in here: (remember your video should be shorter than 4 minutes)" onfocus="if(value=='Insert a link in here: (remember your video should be shorter than 4 minutes)'){value=''; }" onblur="if(value==''){value='Insert a link in here: (remember your video should be shorter than 4 minutes)'; }" onclick="if(value=='Insert a link in here: (remember your video should be shorter than 4 minutes)'){value='';}" shareVideoURL/></div>
        <div class="div" onclick="videoShare(); youTubeDesc(); youTubeTitle();">share</div>
        </section>
        
        <section class="head_but_box_img" style="display: none;">
          <div class="img_input"><input name="shareImageURL" id="shareImageURL" type="text" value="Write something about your image: (Maximum 140 Characters)" onfocus="if(value=='Write something about your image: (Maximum 140 Characters)'){value=''; }" onblur="if(value==''){value='Write something about your image: (Maximum 140 Characters)'; }" onclick="if(value=='Write something about your image: (Maximum 140 Characters))'){value='';}" /></div>
          <nav class="share"><a href="#">share</a></nav>
          <div class="color_font">
          	<div class="color_palate"><img src="../images/colors.jpg" width="345" height="20" /></div>
            <nav class="font_type"><a href="#">Tahoma</a></nav>
            <nav class="font_type"><a href="#">Arial</a></nav>
            <nav class="font_type"><a href="#">Times</a></nav>
            <nav class="font_type"><a href="#">Verdana</a></nav>
            <nav class="font_type" style="margin: 0;"><a href="#">Gotham</a></nav>
          </div>
          <section class="img_canvas">
          <div style="width: 640px; height: 360px; position: absolute; z-index: 50;" id="divMain">
			<img id="imgBG" src="../images/canvas.jpg" style="width: 640px; height: 360px" /> 
            <!--<div id="myCanvas" style="background:url(../images/canvas.jpg); width: 640px; height: 360px;" ></div>-->
		 </div>
            <script type="text/javascript"> 
				
				function saveimage(imgdata) {
                    
                    $.post("LoadImage.php",
                      {
                          imgdata: imgdata
                      },
                      function (data, status) {
                          document.getElementById('imgBG').src = data;
                      });

                }
				var dropbox = document.getElementById('imgBG'); 
				
				// Setup drag and drop handlers. 
				dropbox.addEventListener('dragenter', stopDefault, false); 
				dropbox.addEventListener('dragover', stopDefault, false); 
				dropbox.addEventListener('dragleave', stopDefault, false); 
				dropbox.addEventListener('drop', onDrop, false); 
				
				function stopDefault(e)  
				{ 
				  e.stopPropagation(); 
				  e.preventDefault(); 
				} 
				
				function onDrop(e)  
				{ 
				e.stopPropagation(); 
				e.preventDefault(); 
				
				var readFileSize = 0; 
				var files = e.dataTransfer.files; 
				
				file = files[0]; 
				readFileSize += file.fileSize; 
				
				// Only process image files. 
				var imageType = /image.*/; 
				
				if (!file.type.match(imageType))  
				{ 
				return; 
				} 
				
				var reader = new FileReader(); 
				
				reader.onerror = function(e)  
				{ 
				alert('Error code: ' + e.target.error); 
				}; 
				
				// Create a closure to capture the file information. 
				reader.onload = (function(aFile)  
				{ 
				return function(evt)  
				{ 
				dropbox.src = evt.target.result; 
				} 
				})(file); 
				
				// Read in the image file as a data url. 
				reader.readAsDataURL(file); 
				} 
				</script> 
          </section>
        </section>
      </header>
      <?php if($numberOfVideoNum > 0){ ?>
    <section class="left_body_box">
    	<iframe id="div_youTube" width="640" height="360" src="" object="<?php echo $iframeVideoPostInfo['video_object']?>" iframeVideoType = "<?php echo $iframeVideoPostInfo['video_type'] ?>" vidID = "<?php echo $iframeVideoPostInfo['video_id']?>" frameborder="0" allowfullscreen></iframe>
        <section class="left_vid_cont">
          <div class="vid_name" id="vidTitle" style="overflow:hidden;" maxlength="10"><?php echo $title;?></div>
          <div class="user_name"><?php echo $iframeVideoPostInfo['full_name']?></div>
          <div class="sn_img"><a onclick="window.open('http://www.linkedin.com/shareArticle?mini=false&url=<?php echo $iframeVideoPostInfo['video_url'];?>','linkedin','toolbar=0,status=0,width=600,height=400')" href="javascript: void(0)"><img src="../images/in.jpg" width="30" height="30" alt="in" /></a><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $iframeVideoPostInfo['video_url']; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','facebook','toolbar=0,status=0,width=600,height=400');" target="_parent" href="javascript: void(0)"><img src="../images/fb.jpg" width="30" height="30" /></a><a onclick="window.open('http://twitter.com/home?status= video url shred -  <?php echo $iframeVideoPostInfo['video_url'];?>','twitter','toolbar=0,status=0,width=600,height=400')" target="_parent" href="javascript: void(0)"><img src="../images/twt.jpg" width="30" height="30" /></a><a href="javascript: void(0)"><img src="../images/alacut.jpg" width="30" height="30" /></a></div>							<!--<?php if($showBar){ echo "<div class='hits' id='hits'>".$total."</div>";}?>-->
			
              <div class="choice">
                <div class="top">	
                <?php if($iframeVideoPostInfo['ldStatus'] == 'like' ){ ?>		 
                  <a href="#" class="like" id="dislike" name="dislike"><img src="../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
                <?php } 
					elseif($iframeVideoPostInfo['ldStatus'] == 'dislike'){ ?>
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
        </section>
        <section class="left_vid_desc"><?php echo $description?></section>
        <!-- Login user to poat comment-->
		<div id="vid_comment_box">
        <?php include("loginUserCommentPost.php");?>
        </div>
        <section class="left_vid_desc">
          <article class="user_img"><?php if($userImageInfo['profile_photo_name'] != ''){
                    echo '<img src="../upload/profilePhotos/'.$userImageInfo['profile_photo_name'].'" alt="" width="40" height="40">';
                }else{
                        echo '<img src="../images/no-image.jpg" alt="" height="40" width="40">';
                     }?></article>
       	  <div class="textbox"><textarea id="txtComment" name="txtComment" class="desc"></textarea>
       	  </div>
       	  <div class="button"><button name="btnPost" id="btnPost" type="button" onClick="postComment('<?php echo $member_id?>','<?php echo $LargeVideoId;?>')">Post</button></div>
        </section>
        

    </section>
    <?php } ?>
  <?php if($numberOfVideoNum > 0){ ?>
  
	<?php } ?>

</section>
<aside class="inner_right">
    <header class="head">
      <h1>Top Post by friends</h1>
   </header>
  <?php while($videoPostInfo = mysql_fetch_array($videoPostRes)) { 
  	$thumbImgPath = '';
		if($videoPostInfo['video_type']=="youtube"){
			$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
		}else{
			$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
			$thumbImgPath = $vimeoInfo->thumbnail_medium;
		}
  ?> 
      <div class="right_thumb">
      <article class="thumb"><a href="home.php?vid=<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $videoPostInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/></a>
      <div class="home_des_thumb">
        <div class="title"><?php echo $videoPostInfo['video_name']?></div>
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
   </div><?php } ?>
    </aside>
    </section><?php include("footer.php");?>
  </div>

</form>
<!--</body>-->
</html>

            