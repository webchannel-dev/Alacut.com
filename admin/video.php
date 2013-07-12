<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>alacut: Welcome to alalcut</title>
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
var type = '<?php echo $_REQUEST['Type']?>';
var obj = '<?php echo $_REQUEST['object']?>';
$(document).ready(function () {
	if(type == "youtube")
	{	
		$("#div_youTube").attr("src" ,"http://www.youtube.com/embed/"+obj);
	}
	else if(type == "vimeo")
	{	
		$("#div_youTube").attr("src","http://player.vimeo.com/video/"+obj);
	}
});
</script>
</head>
<body>
<div class="wrapper">
<header class="top_bar">
    <div class="logo"><a href="#"><img src="../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <!-- nav start -->
    	<?php include('topBar.php');?>
    <div class="logout"><a href="../logout.php">Logout</a></div>
    <!-- nav close -->
  </header>
	<div class="home">
    </div>
    <div class="left_body_box">
    	<iframe id="div_youTube" width="640" height="360" src="" frameborder="0" allowfullscreen></iframe>
     </div>
</div>
</body>
</html>