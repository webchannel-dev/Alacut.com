<?php
include('../../config/config1.php');

	$imgageDetailQry = "SELECT i.image_id,a.full_name,i.image_desc,i.uploaded_date,i.image_url
     FROM `upload_image` i INNER JOIN `alacut_member` a ON a.member_id = i.img_upload_by WHERE i.status !='2' "; //echo $videoDetailQry;
	$imageDetailRes = mysql_query($imgageDetailQry);
	$imageDetailNum = mysql_num_rows($imageDetailRes);

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
<script type="text/javascript" src="../../js/jquery.min.js"></script>
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
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="">Image Description</th>
        <th width="">Image uploaded by</th>
        <th width="">Image uploaded on</th>
        <th width="" colspan="2">Action</th>
      </tr>
      <?php if($imageDetailNum > 0){
	   while($imageDetailInfo = mysql_fetch_array($imageDetailRes)) { ?>
          <tr>
            <td><?php echo $imageDetailInfo['image_desc']?></td>
            <td><?php echo $imageDetailInfo['full_name']?></td>
            <td><?php echo date("d/m/Y", strtotime($imageDetailInfo['uploaded_date']));?></td>
            <td><a href="image.php?url=<?php echo $imageDetailInfo['image_url']?>" class="but1">View</a></td>
            <td><a href="deleteImageByAdmin.php?id=<?php echo $imageDetailInfo['image_id']?>" class="but2">Delete</a></td>
          </tr>
      <?php } 
	  }?>
    </table>   
	</section>
    <!-- section close -->
  <footer class="footer"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></footer>
</div>
</body>
</html>