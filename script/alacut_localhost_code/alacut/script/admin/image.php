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
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
<header class="top_bar">
    <div class="logo"><a href="#"><img src="../../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <!-- nav start -->
    	<?php include('topBar.php');?>
    <div class="logout"><a href="../logout.php">Logout</a></div>
    <!-- nav close -->
</header>
	<div class="home">
    </div>
    <div>
    	<img src="<?php echo $_REQUEST['url'] ?>" alt="" height="600 px" width="970 px"/>
     </div>
</div>
</body>
</html>