<?php
session_start();
$member_ID = $_SESSION['login_user_id'];
	/*$messageDisplayRes = mysql_query($messageDisplayQry);
	$messageDisplayNum = mysql_num_rows($messageDisplayRes);*/
	
	$qry = "SELECT `login_user_name` FROM `alacut_member` WHERE member_id='$member_ID' AND active = '1'";
	$ses_sql = mysql_query($qry);
	$row = mysql_fetch_array($ses_sql);
	$login_session = $row['login_user_name'];
?>

<script>
$(document).ready(function () {
	 $(".slide1").click(function () {
      $("#div_slide_content1").slideToggle("fast");
      $("#div_slide_content2").hide();
      $("#div_slide_content3").hide();
	  $("#div_slide_content4").hide();
            });
   $(".slide2").click(function () {
      $("#div_slide_content2").slideToggle("fast");
      $("#div_slide_content1").hide();
      $("#div_slide_content3").hide();
	  $("#div_slide_content4").hide();
            });
   $(".slide3").click(function () {
       $("#div_slide_content3").slideToggle("fast");
       $("#div_slide_content1").hide();
       $("#div_slide_content2").hide();
	   $("#div_slide_content4").hide();
            });
	$(".slide4").click(function () {
       $("#div_slide_content4").slideToggle("fast");
       $("#div_slide_content1").hide();
       $("#div_slide_content2").hide();
	   $("#div_slide_content3").hide();
            });	
    getNotification();
			

});
function getNotification()
{
	getFriendRequests();
	getMessages();
	getPosts();
}
function getFriendRequests()
{
	$.ajax({
		type: "POST",
		url: 'ajax/getFriendRequests.php',
		success: function(data) {
			$('#dv_frnd').html(data);
		},
		error: function(e) {
			$('#dv_frnd').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
function getMessages()
{
	$.ajax({
		type: "POST",
		url: 'ajax/getMessages.php',
		success: function(data) {
			$('#dv_emails').html(data);
		},
		error: function(e) {
			$('#dv_emails').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
function getPosts()
{
	$.ajax({
		type: "POST",
		url: 'ajax/getPosts.php',
		success: function(data) {
			$('#dv_posts').html(data);
		},
		error: function(e) {
			$('#dv_posts').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
function confirmFriend(fromID,toID,src)
{
	
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			$(src).parent().parent().html('<strong>Accpeted</strong>');
			$(src).parent().siblings().remove();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});
	}			
}


function ignoreFriend(fromID,toID,src)
{
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			$(src).parent().parent().html('<strong>Rejected</strong>');
			$(src).parent().siblings().remove();
			
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}

</script>

<div class="notification">
  <div class="slide3" ><a href="javascript:void(0);"><img src="../images/note_1.jpg" alt="" width="30" height="30" /></a></div>
      <div id="div_slide_content3">
        <div class="arrow">&nbsp;</div>
        
        
        <div class="note" id="dv_posts"> 
    	<h1>Posts</h1>
        <div style="margin-top: 80px;"><img src='ajax-loader.gif' alt='Loading...' style="width:200px;"/></div>
        </div>
        
        <div class="note" id="dv_frnd">
        <h1>New Friends</h1>
        <div style="margin-top: 80px;"><img src='ajax-loader.gif' alt='Loading...' style="width:200px;"/></div>
        </div>
        
        <div class="note_last" id="dv_emails">
        <h1>New Emails</h1>
        <div style="margin-top: 80px;"><img src='ajax-loader.gif' alt='Loading...' style="width:200px;"/></div>
        </div>
      </div>
      <div class="user slide4"><a href="javascript:void(0);"><?php echo $login_session;?></a></div>
      <div id="div_slide_content4">
        <div class="user_option"><a href="myProfile.php">My Profile</a></div>
        <div class="user_option"><a href="logout.php">Logout</a></div>
        <div class="user_option"><a id="grabButton" title="Grab It" href="javascript:void((function(){var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://localhost/alacut/js/alacutpinscript.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" onclick="alert('Drag me to the bookarks bar'); return false;">GRAB IT</a></div>
      </div>
    </div>