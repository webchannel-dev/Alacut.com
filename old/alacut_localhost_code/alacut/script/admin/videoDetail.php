<?php
include('../../config/config1.php');
	
	if($_POST['btnSearch'] == 'search')
	{
		 if($_POST['vidName'] <> 'name') $cond=$videoDetailQry .= " AND video_name like '%".$_POST['vidName']."%'";
		 if($_POST['calender'] <> 'date') $cond=$videoDetailQry .= " AND DATE(uploaded_date)='".date("Y-m-d", strtotime($_POST['calender']))."'";
		 
	} 
	$videoDetailQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.visit,u.video_type,u.like,u.dislike,a.full_name,u.uploaded_date 
     FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.status !='2' $cond "; //echo $videoDetailQry;
	$videoDetailRes = mysql_query($videoDetailQry);
	$videoDetailNum = mysql_num_rows($videoDetailRes);
	
	if($_POST['btnDelete'] == 'delete')
	{
		$deleteDislikeVideo = "UPDATE `upload_video` SET `status`='2' WHERE `dislike`='".$_POST['vidDislike']."'";
		mysql_query($deleteDislikeVideo);
		header("location: videoDetail.php");
	}
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
    <form id="user" method="post" action="">
       <table>
        <tr>
            <td><input type="text" id="calender" name="calender" value="date" onfocus="if(value=='date'){value=''; }" onblur="if(value==''){value='date'; }" onclick="if(value=='date'){value='';}"/></td>
            <td><input type="text" id="vidName" name="vidName" value="name" onfocus="if(value=='date'){value=''; }" onblur="if(value==''){value='name'; }" onclick="if(value=='name'){value='';}"/></td>
            <td><input  name="btnSearch" type="submit" value="search"/></td>
            <td>
            <td><input type="text" id="vidDislike" name="vidDislike" value="Enter no. of dislike" onfocus="if(value=='Enter no. of dislike'){value=''; }" onblur="if(value==''){value='Enter no. of dislike'; }" onclick="if(value=='Enter no. of dislike'){value='';}"/></td>
            </td>
            <td><input  name="btnDelete" type="submit" value="delete"/></td>
        </tr>
       </table>
   </form>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="">Video name</th>
        <th width="">Video type</th>
        <th width="">Video uploaded by</th>
        <th width="">Video uploaded on</th>
        <th width="">Like</th>
        <th width="">Dislike</th>
        <th width="">Visit</th>
        <th width="" colspan="2">Action</th>
      </tr>
      <?php if($videoDetailNum > 0){
	   while($videoDetailInfo = mysql_fetch_array($videoDetailRes)) { ?>
          <tr>
            <td><?php echo $videoDetailInfo['video_name']?></td>
            <td><?php echo $videoDetailInfo['video_type']?></td>
            <td><?php echo $videoDetailInfo['full_name']?></td>
            <td><?php echo date("d/m/Y", strtotime($videoDetailInfo['uploaded_date']));?></td>
            <td><?php echo $videoDetailInfo['like']?></td>
            <td><?php echo $videoDetailInfo['dislike']?></td>
            <td><?php echo $videoDetailInfo['visit']?></td>
            <td><a href="video.php?object=<?php echo $videoDetailInfo['video_object']?>&Type=<?php echo $videoDetailInfo['video_type']?>" class="but1">View</a></td>
            <td><a href="deleteVideoByAdmin.php?id=<?php echo $videoDetailInfo['video_id']?>" class="but2">Delete</a></td>
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