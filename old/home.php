<?php
session_start();

include('config/config1.php');

if($_SESSION['login_user_id']=="")
{
header("Location: ".SITE_URL);exit();
}
$isYouTube = FALSE;
$member_id = $_SESSION['login_user_id'];
$LargeVideoId = isset($_REQUEST['vid'])?$_REQUEST['vid']:0;
$shareVideo = 0;
$numberOfVideoQry = "SELECT COUNT(u.video_id) AS totalvideo FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.status !='2' ";
$numberOfVideoRes = mysql_query($numberOfVideoQry);
$numberOfVideoNum = mysql_fetch_array($numberOfVideoRes);
$numberOfVideoNum = $numberOfVideoNum['totalvideo'];
	if(isset($_REQUEST['vid']) > 0){		
		$iframeVideoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id ,a.full_name, u.visit
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		WHERE u.status!='2'  AND u.video_id = ".$_REQUEST['vid'];
	
	}
	else{
		$iframeVideoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_type,u.video_image,u.video_desc,u.video_name,u.like,u.dislike,u.video_url,a.member_id, a.full_name, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = u.video_upload_by  
		WHERE a.member_id='".$member_id."' AND u.status!='2'  ORDER BY u.`uploaded_date` DESC LIMIT 1";
	}
	
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
	if($iframeVideoPostNUM > 0)
	{
		$UsrImgInfoQry = "SELECT a.profile_photo_name FROM `alacut_member` a WHERE a.member_id='$member_id'";
		$UsrImgInfoRes = mysql_query($UsrImgInfoQry);
		$UsrImgInfo = mysql_fetch_array($UsrImgInfoRes);
		$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
		$LargeVideoId=$iframeVideoPostInfo['video_id'];
		$getStatus=mysql_query("SELECT status FROM video_like WHERE videoID='".$iframeVideoPostInfo['video_id']."' AND memberID='".$member_id."'");
		$likestatus=mysql_fetch_array($getStatus);
		$iframeVidObject = $iframeVideoPostInfo['video_object'];
		if($LargeVideoId!=0)
		{
		$update = "UPDATE `upload_video` SET visit = visit + 1 WHERE video_id = '".$LargeVideoId."'";
		mysql_query($update);
		}
		if($iframeVidObject == '0' || $iframeVidObject == "")
		{
			echo 'This is not a valid video url. Please, give a valid url...';
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
			$desc = $iframeVideoPostInfo['video_desc'];
			 $description = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$desc);
			 $title = $iframeVideoPostInfo['video_name'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" >

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
<script type="text/javascript" src="js/jquery.min.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" charset="UTF-8"></script>

<style>
#draggable { max-width: 600px; max-height: 300px;float:left;display:none;padding:5px;position: absolute;font-size:30px;left:70px;top:60px;border:1px solid #FFF;  }
</style>
<script>
$(document).ready(function() {
$( "#draggable" ).draggable({grid: [ 50, 20 ],opacity: 0.35,containment: "parent",stop:function(event,ui){
	var lft=$(this).offset().left;
		var tp=$(this).offset().top;
	//alert('width:'+$(this).width()+'height:'+$(this).height()+'top:'+tp+",left:"+lft);	
}
});
$('#draggable').resizable();

$('#shareImageURL').keyup(function(){
	var txt=$(this);
	if($('#hdnimg') && $('#hdnimg').val() && $('#hdnimg').val()!='' )
	{
		
		var lft=$('#divMain').offset().left;
		var tp=$('#divMain').offset().top;
		//alert('top:'+tp+",left:"+lft);
		if($(txt).val()!="")
			$('#draggable').text($(txt).val()).show();
		else
			$('#draggable').text($(txt).val("")).hide().css({"left":'70px',"top":'60px'});
	}else 
	{
		$(txt).val("");
		alert('Please Uplaod an Image!!');
	}
});
$('.font_type').click(function(){
	var ftyp=$(this).children().text();
	$('#draggable').css({'font-family':ftyp});
});
$('#Map > area').click(function(){
	
	$('#draggable').css({'color':$(this).attr('data-color')});
});
});
</script>
<script> 
var v=null,upload=null;
function CreateFbShareUrl(t,s,u,i)
{
	
	return "http://www.facebook.com/sharer.php?s=100&p[title]="+t+"&p[summary]="+s+"&p[url]="+u+"&&p[images][0]="+i;
}

function CreateLiShareUrl(ur,t,s)
{
	return "http://www.linkedin.com/shareArticle?mini=true&url="+ur+"&title="+t+"&summary"+s;
	
}

function CreateTwShareUrl(ul,t,s)
{
	return "https://twitter.com/intent/tweet?source=webclient&text="+t+"&url="+ul;
	
}
$(document).ready(function () {
	
	postedVideos(<?php echo $member_id;?>, <?php echo $LargeVideoId;?>);

	$("#shareImageURL").keypress(function(){
		var canvas = document.getElementById("imgBG");
		canvas.innerHTML=$("#shareImageURL").val();
	});
	$(".vid_up").click(function(){
		showVideoContainer();
		});     
	$(".img_up").click(function(){
		$('#imgfile').click();
		//showImageContainer();
		});   
});
function ReadImage(input)
{
	file = input.files[0];
    // Only process image files. 
    var imageType = /image.*/;

    if (!file.type.match(imageType)) {
    	alert("Inavalid Image File!!");
        return;
    }else if(file.size>1048576 )
    {
    	alert("File is Too Large !!\nFile Size Must Be Less Than 1MB");
    	return;
    }else if(file.size<102400)
    {
    	alert("File is Too Small !!\nFile Size Must Be More Than 100Kb and Less Than 1MB");
    	return;
    }
    else
    {

    var reader = new FileReader();

    reader.onerror = function (e) {
        alert('Error code: ' + e.target.error);
    };

    // Create a closure to capture the file information. 
    reader.onload = (function (aFile) {
        return function (evt) {
		$('#imgBG').attr('src',evt.target.result);
		$('#hdnimg').val(evt.target.result);
            
            showImageContainer();
        }
    })(file);

    // Read in the image file as a data url. 
    reader.readAsDataURL(file);
    }
}
function showImageContainer()
{
		$(".head_but_box_img").show();
		$(".head_but_box_full").hide();
		$(".head_but_box").hide();
		$("#heading").hide();
		$("#homeFrame").hide();
}
function showVideoContainer()
{
	$(".head_but_box_full").show();
		$(".head_but_box_img").hide();  
		$(".head_but_box").hide();  
		$("#heading").hide();
		$("#no_video").hide();
		$("#homeFrame").show();
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
function youtube_parser(url)
{
	var obj = new Object();
	
	if(url.indexOf("youtu.be")!=-1)
	{	
   		url=url.substring(url.lastIndexOf("/")+1,url.length);
		//$("#div_youTube").attr("src","http://www.youtube.com/embed/"+url);
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
		//$("#div_youTube").attr("src","http://www.youtube.com/embed/"+url);
		obj.name = "youtube";
		obj.objectVal = url;
	}
	else if(url.indexOf("vimeo.com")!=-1)
	{
		url=url.split("#")[0];
		if(url.lastIndexOf("/")!=-1)
			url=url.substring(url.lastIndexOf("/")+1,url.length);
		//$("#div_youTube").attr("src","http://player.vimeo.com/video/"+url);
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
	
		if(shareValObject != null)
		{
			
			shareValObject.url=shareValUrl;
			if(shareValObject.name == "youtube")
			{
				upload="upload";
				getYouTubeDetails(shareValObject);
			}
			else
			{
				UploadVideoToDb(shareValObject,'','');
			}
			$("#shareVideoURL").val('Insert a link in here: (remember your video should be shorter than 4 minutes)');
			hideShareBar();
		}
		else
		{
			alert("Please Enter A url!!");
			//hideShareBar();
		}
}
function hideShareBar()
{
	$(".head_but_box_full").hide();
	$(".head_but_box_img").hide();  
	$(".head_but_box").show();  
	$("#heading").show();
}
function UploadVideoToDb(shareValObject,desc,tit)
{
	$.ajax({
			type: "POST",
			dataType: 'json',
			url: 'ajax/videoUploadInAjax.php',
			data: 'url='+shareValObject.url+'&type='+shareValObject.name+'&object='+shareValObject.objectVal+'&desc='+desc+'&title='+tit,
			success: function(data) {
				
				if(data != "ERROR")
				{
					var vArray = '';
					var vtype = data[0]['type'];
					var obj = data[0]['obj'];
					var id = data[0]['vid'];
					
					var share = '<?php echo $shareVideo = 1;?>';
					$('#vid_comment_box').html('');
					$('#txtComment').attr("vid",id);
					$('#spn_cnt').text("").siblings("a").removeAttr("clickable");
					$('.bot').show().children().attr("style","width:0%;");
					if(share == 1){
						$("#no_video").hide();
					}
					$("#homeFrame").show();
					if(vtype == 'y')
					{
						$("#div_youTube").attr("src" ,"http://www.youtube.com/embed/"+obj);
						$("#div_youTube").attr({"object":obj,"vidid":id});
						
						$('#vidTitle').attr('title',tit).html(trimTitle(tit));
						x=refineString(encodeURI(tit));
						d=refineString(encodeURI(desc));
						
						var onclkval=CreateFbShareUrl(x,d,'http://www.alacut.com?vid='+id,'http://i1.ytimg.com/vi/'+shareValObject.objectVal+'/mqdefault.jpg');
						
						$('#fb').attr('uri',shareValObject.url);
						$('#fb').attr('pic','http://img.youtube.com/vi/'+shareValObject.objectVal+'/1.jpg');
						$('#fb').removeAttr('onclick').click(function(){window.open(onclkval,'facebook','toolbar=0,status=0,width=600,height=400');});
						$('#vid_desc').html(trimDescription(desc));
						
					}
					else
					{
						$("#div_youTube").attr("src","http://player.vimeo.com/video/"+obj);
						$("#div_youTube").attr({"object":obj,"vidid":id});
						$("#vid_desc").html(trimDescription(data[0]['desc']));
						$("#vidTitle").attr('title',data[0]['title']).html(trimTitle(data[0]['title']));
						var dsc = refineString(data[0]['desc']);
						var ti=refineString(data[0]['title']);
						var im=data[0]['img'];
						var onclkval=CreateFbShareUrl(ti,dsc,'http://www.alacut.com?vid='+id,im);
						$('#fb').attr('uri',shareValObject.url);
						$('#fb').attr('pic',im);
						$('#fb').removeAttr('onclick').click(function(){window.open(onclkval,'facebook','toolbar=0,status=0,width=600,height=400');});	
					}
					callscroller();
					//Sharing video to li - start	
						var dsc = refineString(data[0]['desc']);
						var ti=refineString(data[0]['title']);									
						var onclkvalLi=CreateLiShareUrl('http://www.alacut.com?vid='+id,ti,dsc);
						
						$('#li').removeAttr('onclick').click(function(){window.open(onclkvalLi,'linkedin','toolbar=0,status=0,width=600,height=400');});					
					//Sharing video to tw - start										
						var onclkvalTw=CreateTwShareUrl('http://www.alacut.com?vid='+id,ti,dsc);
						$('#tw').removeAttr('onclick').click(function(){window.open(onclkvalTw,'twitter','toolbar=0,status=0,width=600,height=400');});
						
					
				}else{
					alert('Video length is more than 4 minute!! or There is some url issue');
				}
			},
			error: function(e) {
				alert("Video length is more than 4 minute!! or There is some url issue");
			}
		});
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
	   if($(txt).val()!="" && $('#div_youTube').attr("vidid")  )
	   {
	   		if($(txt).val().length<=140)
      			postComment(uid,$('#div_youTube').attr("vidid"));
  			else
  				alert("Please Enter 140 Chracter Only!!");
      	}
		else 
			alert("Please Enter Comment!!");
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
			$("#vid_comment_box").append(data);	
			$("#txtComment").val("");
			callscroller();
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

function postedVideos(userID, iFrameID)
{
	
	if(iFrameID>=0){
		
		$("#topPostedByUser").html("<div style='padding: 20px 100px;'><img src='bigLoader.gif' alt='Loading...' /></div>");
		$.ajax({
			type: "POST",
			url: 'ajax/PostedVideoInAjax.php',
			data: 'iFrameID='+iFrameID+'&p=h',
			success: function(data) {
				$("#topPostedByUser").html(data);
			}
		});
	}else{
		
		$("#topPostedByUser").html("<div class='no_post'>&nbsp;</div>");	
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
        <section class="head_but_box"">
          <nav class="img_up"><a href="javascript:void(0);">An image update</a></nav>
          <nav class="vid_up"><a href="javascript:void(0);">A video link</a></nav>
        </section>
        <section class="head_but_box_full" style="display: none;">
       	<div class="vid_input">
       		<input type="text" name="shareVideoURL" id="shareVideoURL" value="Insert a link in here: (remember your video should be shorter than 4 minutes)" onfocus="if(value=='Insert a link in here: (remember your video should be shorter than 4 minutes)'){value=''; }" onblur="if(value==''){value='Insert a link in here: (remember your video should be shorter than 4 minutes)'; }" onclick="if(value=='Insert a link in here: (remember your video should be shorter than 4 minutes)'){value='';}" shareVideoURL/></div>
        <div class="div" onclick="videoShare();">share</div>
        </section>
        
        <section class="head_but_box_img" style="display: none;">
          <div class="img_input"><input name="shareImageURL" id="shareImageURL" type="text" value="Write something about your image: (Maximum 140 Characters)" onfocus="if(value=='Write something about your image: (Maximum 140 Characters)'){value=''; }" onblur="if(value==''){value='Write something about your image: (Maximum 140 Characters)'; }" onclick="if(value=='Write something about your image: (Maximum 140 Characters))'){value='';}" /></div>
          <nav class="share"><a href="javascript:void(0);">share</a></nav>
          <div class="color_font">
          	
          	<div class="color_palate"><img src="images/colors.jpg" width="345" height="20" border="0" usemap="#Map" />
            <map name="Map" id="Map">
	        <area shape="rect" coords="0,0,17,20" data-color="#FFFFFD" href="javascript:void(0);"/> 
	        <area shape="rect" coords="64,0,80,20" data-color="#FFFF01" href="javascript:void(0);"/> 
	        <area shape="rect" coords="282,-7,297,20" data-color="#FF00AA" href="javascript:void(0);"/> 
	        <area shape="rect" coords="296,-2,307,24" data-color="#FF0054" href="javascript:void(0);"/> 
	        <area shape="rect" coords="306,-1,314,22" data-color="#FE0000" href="javascript:void(0);"/> 
	        <area shape="rect" coords="314,-1,326,23" data-color="#AA0001" href="javascript:void(0);"/> 
	        <area shape="rect" coords="324,-1,336,23" data-color="#540000" href="javascript:void(0);"/> 
	        <area shape="rect" coords="334,-1,346,24" data-color="#000000" href="javascript:void(0);"/> 
			<area shape="rect" coords="128,-1,146,20" data-color="#00FF55" href="javascript:void(0);"/> 
	        <area shape="rect" coords="145,-2,165,26" data-color="#00FFAB" href="javascript:void(0);"/> 
	        <area shape="rect" coords="164,-2,185,26" data-color="#01FFFF" href="javascript:void(0);"/> 
	        <area shape="rect" coords="184,-2,200,20" data-color="#00AAFF" href="javascript:void(0);"/> 
	        <area shape="rect" coords="199,-4,217,26" data-color="#0055FE" href="javascript:void(0);"/> 
	        <area shape="rect" coords="216,-3,233,25" data-color="#0100FE" href="javascript:void(0);"/> 
	        <area shape="rect" coords="232,-2,249,23" data-color="#5600FF" href="javascript:void(0);"/> 
	        <area shape="rect" coords="248,-1,266,30" data-color="#AA00FF" href="javascript:void(0);"/> 
	        <area shape="rect" coords="265,-2,283,25" data-color="#FF00FE" href="javascript:void(0);"/> 
			<area shape="rect" coords="16,0,32,20" data-color="#FFA9AA" href="javascript:void(0);"/> 
	        <area shape="rect" coords="31,0,49,20" data-color="#FF5500" href="javascript:void(0);"/> 
	        <area shape="rect" coords="48,0,65,21" data-color="#FFAA01" href="javascript:void(0);"/> 
	        <area shape="rect" coords="79,-6,97,23" data-color="#AAFF01" href="javascript:void(0);"/> 
	        <area shape="rect" coords="96,-1,113,26" data-color="#55FF00" href="javascript:void(0);"/> 
	        <area shape="rect" coords="112,-5,129,21" data-color="#00FF01" href="javascript:void(0);"/> 
      	</map>  
            
          </div>
          <nav class="font_type"><a href="javascript:void(0);">Tahoma</a></nav>
            <nav class="font_type"><a href="javascript:void(0);">Arial</a></nav>
            <nav class="font_type"><a href="javascript:void(0);">Times</a></nav>
            <nav class="font_type"><a href="javascript:void(0);">Verdana</a></nav>
            <nav class="font_type" style="margin: 0;"><a href="javascript:void(0);">Gotham</a></nav>
          <section class="img_canvas">
          <div style="width: 640px; height: 360px; position: absolute; z-index: 50;" id="divMain">
			<img id="imgBG" src="images/canvas.jpg" style="width: 640px; height: 360px" /> 
            <div id="draggable" ></div>
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

                function stopDefault(e) {
                    e.stopPropagation();
                    e.preventDefault();
                }

                function onDrop(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    
                    var files = e.dataTransfer.files;

                    file = files[0];
                    
                    
                    // Only process image files. 
                    var imageType = /image.*/;

                    if (!file.type.match(imageType)) {
                    	alert("Inavalid Image File!!");
                        return;
                    }else if(file.size>1048576 )
                    {
                    	alert("File is Too Large !!\nFile Size Must Be Less Than 1MB");
                    	return;
                    }else if(file.size<102400)
                    {
                    	alert("File is Too Small !!\nFile Size Must Be More Than 100Kb and Less Than 1MB");
                    	return;
                    }
                    else
                    {

                    var reader = new FileReader();

                    reader.onerror = function (e) {
                        alert('Error code: ' + e.target.error);
                    };

                    // Create a closure to capture the file information. 
                    reader.onload = (function (aFile) {
                        return function (evt) {
						$('#imgBG').attr('src',evt.target.result);
						$('#hdnimg').val(evt.target.result);
                            //saveimage(evt.target.result);
                        }
                    })(file);

                    // Read in the image file as a data url. 
                    reader.readAsDataURL(file);
                    }
                }  
				</script> 
				<input type="hidden" name="hdnimg" id="hdnimg"/>
          </section>
        </section>
      </header>
    
    <?php include ("myVideo.php");?>
    <?php if($numberOfVideoNum == 0){?>
    <div class="left_body_box" id="no_video">
	<img src="images/no-video.jpg" width="640" height="360" />
    </div>
    <?php } ?>
</section>
<aside class="inner_right">
    <header class="head">
      <h1>Top Posts By Friends</h1>
   </header>
   <section id="topPostedByUser"></section>
</aside>
    </section><?php include("footer.php");?>
  </div>
</form>
<input type="file" style="display: none;" id="imgfile" onchange="ReadImage(this);"/> 
<!--</body>-->
</html>           