<?php
session_start();
include('config/config1.php');
$member_id = $_SESSION['login_user_id'];
$per_page = 5; 
$search=$_REQUEST['search'];
//getting number of rows and calculating no of pages
$sql = "SELECT member_id,profile_photo_name,full_name FROM `alacut_member` WHERE `full_name` like '%".$search."%' AND isAdmin !='1'"; 
$rsd = mysql_query($sql); 
$count = mysql_num_rows($rsd);
$pages = ceil($count/$per_page); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Search</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<link href="css/form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	//Display Loading Image
	function Display_Load()
	{
	    $("#loading").fadeIn(900,0);
		$("#loading").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load()
	{
		$("#loading").fadeOut('slow');
	};
	

   //Default Starting Page Results
   
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	
	Display_Load();
	
	$("#content").load("Search_New.php?page=1", Hide_Load());



	//Pagination Click
	$("#pagination li").click(function(){
			
		Display_Load();
		
		//CSS Styles
		$("#pagination li")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum = this.id;
		alert(pageNum);
		
		$("#content").load("Search_New.php?page=" + pageNum, Hide_Load());
	});
});

function addFriend(frndFromID,frndToID)
{
	$.ajax({
		type: "POST",
		url: 'ajax/findFriendInAjax.php',
		data: 'fromId='+frndFromID+'&toId='+frndToID,
		success: function(data) {
			alert('Friend request has been sent');
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});			
}
</script>
<style>
#loading { 
width: 100%; 
position: absolute;
}

#pagination
{
text-align:center;
margin-left:120px;

}
li{	
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px; 
border:solid 1px #dddddd;
color:#0063DC; 
}
li:hover
{ 
color:#FF0084; 
cursor: pointer; 
}
</style>
</head>
<body>
<div id="lightbox_form" style="width: 900px;">
<form id="search" name="search" method="POST" action="home.php">
    <div class="form_pad">
    <div id="loading" ></div>
	<div id="content" class="search" ></div>
	<table width="800px">
	<tr><Td>
			<ul id="pagination">
				<?php
				//Show page links
				for($i=1; $i<=$pages; $i++)
				{
					echo '<li id="'.$i.'">'.$i.'</li>';
				}
				?>
			</ul>	
	</Td></tr></table>
  </div>
 </form>
</div>
</body>
</html>