<?php
session_start();
include('../config/config1.php');

$member_id = $_SESSION['login_user_id'];
//$search=$_REQUEST['search'];

$q = strtolower($_POST["keyword"]);


?>
<link href="../css/form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
var q='<?php echo $q;?>';
$(document).ready(function(){
	searchComment();
	searchVideo();
	searchFriends();
});
function searchComment()
{
	$.ajax({
		type: "POST",
		url: 'ajax/searchComments.php',
		data: 'keyword='+q,
		success: function(data) {
			$('#dv_cmnt').html(data);
		},
		error: function(e) {
			$('#dv_cmnt').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
function searchVideo()
{
	$.ajax({
		type: "POST",
		url: 'ajax/searchVideo.php',
		data: 'keyword='+q,
		success: function(data) {
			$('#dv_video').html(data);
		},
		error: function(e) {
			$('#dv_video').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
function searchFriends()
{
	$.ajax({
		type: "POST",
		url: 'ajax/searchFriends.php',
		data: 'keyword='+q,
		success: function(data) {
			$('#dv_user').html(data);
		},
		error: function(e) {
			$('#dv_user').html("<strong style='color:red;'>There is somme error in the network. Please try later.</strong>");
		}
	});
}
/*function addFriend(frndFromID,frndToID,src)
{
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: 'fromID='+frndFromID+'&toID='+frndToID+'&rtype=n',
		success: function(data) {
			$(src).parent().html("<strong >Friend Request Sent</strong>");
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});			
}*/
</script>
<div id="lightbox_form" style="width: 873px;">
<form id="search" name="search" method="POST" action="home.php">
    <div class="form_pad" >  
    <div class="search1">
    
	<div style="width: 220px; float: left; padding: 10px;" id="dv_user" >
      <h1>Friends</h1>
      <div style='padding: 5px ;'><img src='ajax-loader.gif' alt='Loading...' /></div>
     </div>
     
    <div style="width: 300px; float: left; padding: 10px; " id="dv_video">
    <h1>Videos</h1>
      <div style='padding: 5px ;'><img src='ajax-loader.gif' alt='Loading...' /></div>
	</div>
    <div style="width: 280px; float: left; padding: 10px;" id="dv_cmnt">
    <h1>Comments</h1>
    <div style='padding: 5px ;'><img src='ajax-loader.gif' alt='Loading...' /></div> 
	</div>
</div>
  </div>
 </form>
</div>