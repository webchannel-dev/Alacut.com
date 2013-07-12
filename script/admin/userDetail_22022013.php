<?php 
include('../../config/config1.php');

	if($_POST['btnSearch'] == 'search')
	{
		 if($_POST['txtUsername'] <> '') $cond=$userDetailQry .= " AND full_name like '%".$_POST['txtUsername']."%'";
	}
	
	$userDetailQry = "SELECT `member_id`,`full_name`,`email`,`active`,`create_date` FROM `alacut_member` WHERE `isAdmin` !='1' AND `active` !='2' $cond";
	$userDetailRes = mysql_query($userDetailQry);
	$userDetailNum = mysql_num_rows($userDetailRes);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>User Details</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#calender" ).datepicker();
  });
</script>
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
    <div class="logo"><a href="#"><img src="../../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <!-- nav start -->
    	<?php include('topBar.php');?>
    <div class="logout"><a href="../logout.php">Logout</a></div>
    <!-- nav close -->
  </header>
  <!-- header close -->
  <!-- section start -->
  <section class="admin_panel">
    <!--<h1>Heading</h1>-->
   <form id="user" method="post" action="userDetail.php">
   <table>
   	<tr>
    	<td><input type="text" id="txtUsername" name="txtUsername" value="name" onfocus="if(value=='date'){value=''; }" onblur="if(value==''){value='name'; }" onclick="if(value=='name'){value='';}"/></td>
        <td><input  name="btnSearch" type="submit" value="search"/></td>
    </tr>
   </table>
   
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="">User full name</th>
        <th width="">User e-mail id</th>
        <th width="">Active/inactive Date</th>
        <th width="" colspan="4">action</th>
      </tr>
     <?php if($userDetailNum > 0){
	   while($userDetailInfo = mysql_fetch_array($userDetailRes)) { ?>
      <tr>
        <td><?php echo $userDetailInfo['full_name']?></td>
        <td><?php echo $userDetailInfo['email'];?></td>
        <td><?php echo date("d/m/Y", strtotime($userDetailInfo['create_date']));?></td>
        <?php if($userDetailInfo['active'] == '1'){?> 
        <td><a href="deActiveByAdmin.php?id=<?php echo $userDetailInfo['member_id']?>" id="button3" name="button3" class="but1">Deactivate</a></td>
        <?php }else{?>
        <td><a href="activeByAdmin.php?id=<?php echo $userDetailInfo['member_id']?>" id="button4" name="button4" class="but1">Active</a></td>
        <?php }?>
        <td><a href="userProfileViewByAdmin.php?id=<?php echo $userDetailInfo['member_id']?>" class="but2">View</a></td>
        <td><a href="editUserProfile.php?id=<?php echo $userDetailInfo['member_id']?>" class="but1">Edit</a></td>
        <td><a href="deleteByAdmin.php?id=<?php echo $userDetailInfo['member_id']?>" class="but2">Delete</a></td>
      </tr>
      <?php } 
	  }?>
    </table>  
     </form>
	</section>
    <!-- section close -->
  <footer class="footer"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></footer>
</div>
</body>
</html>