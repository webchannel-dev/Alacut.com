<?php 
session_start();

include('config/config1.php');
if($_SESSION['login_user_id']=="")
{
header("Location: ".SITE_URL);exit();
}
$_SESSION['page']=0;

$member_id = $_SESSION['login_user_id'];

$myProfileSql = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,
	`profile_photo_name` FROM `alacut_member` WHERE  member_id = '".$member_id."' AND active = '1' ";
	$myProfileRes = mysql_query($myProfileSql);
	$myProfileInfo = mysql_fetch_array($myProfileRes);
	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_image,u.visit,u.video_type,u.like,u.dislike,a.full_name,u.uploaded_date, 
     u.video_name,u.video_desc,u.video_url FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
     WHERE u.video_upload_by ='".$member_id."' AND u.status != '2' ORDER BY u.uploaded_date DESC LIMIT 0,20";
	$videoPostRes = mysql_query($videoPostQry);
	
	$videoPostNum = mysql_num_rows($videoPostRes);
	
	$imagePostQry = "SELECT i.image_id,i.img_upload_by,i.image_url,i.image_desc,a.full_name FROM `upload_image` i INNER JOIN `alacut_member` a ON a.member_id = i.img_upload_by WHERE i.img_upload_by = '".$member_id."' AND i.status != '2' ORDER BY i.uploaded_date DESC";
	$imagePostRes = mysql_query($imagePostQry);
	$imagePostNum = mysql_num_rows($imagePostRes);
		
	$totalPostsQry = "SELECT COUNT(`video_id`) AS count FROM `upload_video` WHERE `video_upload_by`='".$member_id."' AND `status` != '2'";
	$totalPostsRes = mysql_query($totalPostsQry);
	$totalPostsInfo = mysql_fetch_array($totalPostsRes);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link type="text/css" rel="stylesheet" href="css/colorbox.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui-1.8.15.custom.css" /> 
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />

   
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script src="js/jquery-ui-1.8.14.custom.min.js"></script>

<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
 
<script type="text/javascript">
	$=jQuery.noConflict();
</script>
<script>
  $(function() {
    $("#calender").datepicker();
  });
</script>
<script> 
var user_id = '<?php echo $member_id?>';

$(document).ready(function () {
	
	$('#imagePost a').lightBox();
		
	$(".left_body_box").hide();
	$(".left_vid_cont").hide();
	
	$(".video").click(function(){
		$(".left_body_box").show();
		$(".left_vid_cont").show();
		
	});
	
	$("#ddlTypePost").change(function()
	{
		var postType = $(this).val();
		if(postType == "V")
		{	
			$("#videoPost").show();
			$("#imagePost").hide();
			$(".left_body_box").hide();
			$(".left_vid_cont").hide();
		}else if(postType == "I"){
			$("#imagePost").show();
			$("#videoPost").hide();
			$(".left_body_box").hide();
			$(".left_vid_cont").hide();
		}
	});
	
	$("#Search").click(function()
	{
		var name = $("#SearchBox").val();
		var date = $("#calender").val();
		if(date == "date"){
			date = "";
		}
		if(name == "name"){
			name = "";
		}
		if(name != "" || date != "")
		{
			
			$('.left_body').html("<div style='padding'><img src='ajax-loader.gif' alt='Loading...' /></div>");
			$.ajax({
			type: "POST",
			url: 'ajax/searchVideoInAjax.php',
			data: 'searchName='+name+'&date='+date+'&uId='+user_id,
			success: function(data) {
				$(".left_body").html(data);
			},
			error: function(e) {
				alert("There is somme error in the network. Please try later.");
			}
			});
		}
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
	if(page*20<tot && $('#videoPost > div.load').length==0)
	{
		$('#videoPost').append("<div class='load' style='padding-left: 210px;'><img src='ajax-loader.gif' alt='Loading...' /></div>");
	$.ajax({
			type: "POST",
			url: 'ajax/myVideo.php',
			data: 'where=post&p='+page+'&s=20&u='+uid,
			success: function(data) {
				if(data!="0")
				{
					$("#videoPost").append(data);
					$('#hdn_pg').val(page+1);
				}
				$('.load').remove();
			}
		});
	}
}
function lageVideoId(video_id,user_id)
{  
	$('#largeVideo').show().html("<div style='padding-left: 210px;'><img src='ajax-loader.gif' alt='Loading...' /></div>");
	$.ajax({
			type: "POST",
			url: 'ajax/postLargeVideoInAjax.php',
			data: 'lvId=' + video_id+'&userId='+user_id,
			success: function (data) {
				$("#largeVideo").html(data);
			},
			error: function (e) {
				alert("There is somme error in the network. Please try later.");
				$('#largeVideo').hide();
			}
		});
		//window.location.href="myProfile.php?vid="+video_id;
}
function changeLeftpanel(flag)
{
	if(flag==1){
		
		$('#dv_video').hide();
		$('#sr_frnd').show();
		
	}
	else if(flag==0){
		$('#dv_video').show();
		$('#sr_frnd').hide();
		
	}
}
</script>
</head>
<body>
	
<div class="wrapper">
  <?php include("header.php");?>
<div class="inner">
<div class="inner_left">
	<div id="sr_frnd" style="display:none;">
		<header class="head">
        <h1>Find your friends on alacut!</h1>
        
      </header>
      <section class="left_body_box">
      <section class="serch_friend">
      	<nav class="button"><a href="javascript:void(0);" onclick="changeLeftpanel(0)" class="cancel">Cancel</a></nav>
      <article class="sfriend_box">
        <div class="sfriend_menu"><img src="images/hotmail.jpg" width="150" height="40"></div>
        <div class="sfriend_menu_unsel"><img src="images/gmail.jpg" width="87" height="40"></div>  
        <div class="sfriend_menu_unsel"><img src="images/yahoomail.jpg" width="150" height="40"></div>
        <div class="sfriend_menu_unsel"><img src="images/facebook.jpg" width="150" height="40"></div>
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
	<div class="left_head1">
        <div class="head">
          <h1>All Posts</h1>
        </div>
      </div> 
     <div class="left_body_box" id="largeVideo" style="display:none;box-shadow: 0 0 1px #333; "></div>
    <div class="left_body" id="videoPost">
    <?php if($videoPostNum > 0){
    	$req=1;
	 while($videoPostInfo = mysql_fetch_array($videoPostRes)) {
		 $thumbImgPath = $videoPostInfo['video_image'];
		$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	 ?>
        <div class="left_thumb">
          <div class="posts" <?php if($req%4==0) echo 'style="margin:0;"'; $req++;?> onclick="lageVideoId('<?php echo $videoPostInfo['video_id'];?>','<?php echo $member_id;?>')"><a href="javascript:void(0);"><img class="video" src="<?php echo $thumbImgPath;?>" alt="" width="140" height="74" data="<?php echo $videoPostInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>"/></a>
            <div class="home_des_thumb">
              <div class="post_title" title='<?php echo $title;?>'><?php if(strlen($title) > 24) {echo substr($title, 0, 21) . '...';}else{echo $title;}?></div>
              <div class="name"><?php echo $videoPostInfo['full_name']?></div>
            </div>
            <?php
			if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
			{
				$up_value = $videoPostInfo['like'];
				$down_value = $videoPostInfo['dislike'];
				$total = $up_value + $down_value;
				$up_per = ($up_value*100)/$total; 
				$down_per = ($down_value*100)/$total;?> 
				<div class="like_bar3">
				  <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
				  <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
				</div>
			<?php } else {?>
				<div class="like_bar3"></div>
				<?php } ?>
          </div>
        </div><?php } }?> 
      </div>
      <div id="imagePost" style="display: none;">
      <?php if($imagePostNum > 0){
		  while($imagePostInfo = mysql_fetch_array($imagePostRes)){ ?>
      	 	<div class="vid_thumb">
              <div class="posts"><a href="upload/imagePost/<?php echo $imagePostInfo['image_url']?>" width="72" height="72"><img src="upload/imagePost/<?php echo $imagePostInfo['image_url']?>" alt="" width="140" height="110"  class="showImage" data="<?php echo $imagePostInfo['image_url']?>"/></a>
              
              <div class="showImage12">
              
              <img id="sds" class="showImage1" />
              
              </div>
                <div class="vid_des_thumb">
                  <div class="name"><?php echo $imagePostInfo['full_name']?></div>
                </div>
              </div>
            </div>
	  <?php } } ?>
      </div>
    </div>  
  </div>
  <div class="inner_right">
    <div class="user_img">
      <div class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </div>
      <div class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </div>
    </div>
    <div class="user_btn">
    <div class="button"><a id="lnk_ff" onclick='changeLeftpanel(1)' href="javascript:void(0);">Find&nbsp;Friends</a></div>
    <div class="button"><a href="myFriends.php">Friends</a></div>
    <div class="button"><a href="allPosts.php"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
    <div class="button"><a href="editUserInfo.php" style="margin: 0;">Edit&nbsp;Info</a></div>
  </div>
  </div>
  
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
  </div>
  <input type="hidden" value="<?php echo $totalPostsInfo['count']?>" id="hdn_tvd"/>
  <input type="hidden" value="1" id="hdn_pg"/>
  <input type="hidden" value="<?php echo $member_id; ?>" id="hdn_uid"/>
</div>

</body>
</html>

            