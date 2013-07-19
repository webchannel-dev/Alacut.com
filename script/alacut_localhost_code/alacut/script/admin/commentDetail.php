<?php
include('../../config/config1.php');
	$commentDeleteQry = "SELECT c.post_comment_id,c.videoID,v.video_name,c.comment, m.full_name, v.video_object, c.date_time, c.active 
							FROM `post_comments` AS c 
							INNER JOIN `alacut_member` AS m ON m.member_id = c.memberID 
							INNER JOIN `upload_video` AS v ON v.video_id = c.videoID WHERE c.status !='2'";
	$commentDeleteRes = mysql_query($commentDeleteQry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Comment Details</title>
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
        <th width="">Comment Post</th>
        <th width="">Video Name</th>
        <th width="">Commented by</th>
        <th width="">Commented date</th>
        <th width="" colspan="2">Action</th>
      </tr>
	  <?php while($commentDeleteInfo = mysql_fetch_array($commentDeleteRes)) { ?>
      <tr>
        <td><?php echo $commentDeleteInfo['comment']?></td>
        <td><?php echo $commentDeleteInfo['video_name']?></td>
        <td><?php echo $commentDeleteInfo['full_name']?></td>
        <td><?php echo date("d/m/Y", strtotime($commentDeleteInfo['date_time']));?></td>
		<?php if($commentDeleteInfo['active'] == '1'){?> 
            <td><a href="commentDisApproval.php?id=<?php echo $commentDeleteInfo['post_comment_id']?>" class="but2">Dis-approve</a></td>
        <?php }else{?>
            <td><a href="commentApproval.php?id=<?php echo $commentDeleteInfo['post_comment_id']?>" class="but2">Approve</a></td>
        <?php }?>
        <td><a href="commentDelete.php?id=<?php echo $commentDeleteInfo['post_comment_id']?>" class="but2">Delete</a></td>
      </tr>
      <?php } ?>
    </table>   
	</section>
    <!-- section close -->
  <footer class="footer"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></footer>
</div>
</body>
</html>