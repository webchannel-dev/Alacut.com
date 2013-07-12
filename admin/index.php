<?php
session_start();
include('../config/config1.php');	
$user_check = $_SESSION['login_user_id'];

if($_SESSION['login_user_id']=="")
{
header("Location: ../index.php");
}	

	$totoalUserQry = "SELECT COUNT(`member_id`) AS total FROM `alacut_member`";
	$totoalUserRes = mysql_query($totoalUserQry);
	$totoalUserInfo = mysql_fetch_array($totoalUserRes);
	
	$activeUserQry = "SELECT COUNT(`member_id`) AS active FROM `alacut_member` WHERE `active`='1'";
	$activeUserRes = mysql_query($activeUserQry);
	$activeUserInfo = mysql_fetch_array($activeUserRes);
	
	$inActiveUserQry = "SELECT COUNT(`member_id`) AS inactive FROM `alacut_member` WHERE `active`='0'";
	$inActiveUserRes = mysql_query($inActiveUserQry);
	$inActiveUserInfo = mysql_fetch_array($inActiveUserRes);
	
	$deleteUserQry = "SELECT COUNT(`member_id`) AS deleted FROM `alacut_member` WHERE active='2'"; 
	$deleteUserRes = mysql_query($deleteUserQry);
	$deleteUserInfo = mysql_fetch_array($deleteUserRes);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin Panel</title>
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
<script>
$(document).ready(function(){
	$('#login-trigger').click(function(){
		$(this).next('#login-content').slideToggle();
		$(this).toggleClass('active');					
		
		if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
			else $(this).find('span').html('&#x25BC;')
		})
});
var $=jQuery.noConflict();
$(document).ready(function()
{
	$(".VisibleLogin").click(function()
	{  
		$("#txtUName").hide();
		$("#btnLogin").show();
		$("#div_button").hide();
		$("#btnSignup").show();
		$("#div_forgotPwd").hide();
	});
	$("#btnSignup").click(function(){
		$("#txtUName").show();
		$("#btnLogin").hide();
		$("#div_button").show();
		$("#btnSignup").hide();
		return false;
		});
	$("#btnForgot").click(function(){
		$("#div_forgotPwd").show();
		return false;
		});
	$(".video").click(function(){
		$("#div_youTube").attr("src",$(this).attr("data"));
		});
});
</script>
<script type="text/javascript">
   function GoTo()
   {
	   location.href = "home.html";
   }
</script>
<script type="text/javascript">
function showpopup(viewtab){
	
	if(viewtab=='login'){
	$('#tab_signup').hide();
	$('#tab_login').toggle();
	$('#logbtn').addClass("active");
	}
	else{
	$('[id^="tab_"]').hide();
	$('#tab_'+viewtab).show();
	$('#logbtn').addClass("active");
	}
	
}

function showerror(){
	$('#registererror').show();	
}
function showforgot(){
	$('#showforgot').show();	
}

</script>
</head>
<body>
<div class="wrapper">
  <!-- header start -->
  <header class="top_bar">
    <div class="logo"><a href="#"><img src="../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <!-- nav start -->
    	<?php include('topBar.php');?>
    <div class="logout"><a href="../logout.php">Logout</a></div>
    <!-- nav close -->
  </header>
  <!-- header close -->
  <!-- section start -->
  <section class="admin_panel">
    <!--<h1>Heading</h1>-->
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <th width="14%">Type of User</th>
    <th width="14%">Number of User</th>
  </tr>
  <tr>
    <td>Total user :</td>
    <td><?php echo $totoalUserInfo['total']; ?></td>
  </tr>
  <tr>
    <td>Active user :</td>
    <td><?php echo $activeUserInfo['active']?></td>
  </tr>
  <tr>
    <td>Inactive user :</td>
    <td><?php echo $inActiveUserInfo['inactive']?></td>
  </tr>
  <tr>
    <td>Deleted user :</td>
    <td><?php echo $deleteUserInfo['deleted']?></td>
  </tr>
    </table>   
	</section>
    <!-- section close -->
  <footer class="footer"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></footer>
</div>
</body>
</html>