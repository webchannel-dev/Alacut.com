<?php
include('../session_header.php');
include('../../config/config1.php');


	$userInfoSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
	`handle`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."' AND active = '1'";
	$userInfoRes = mysql_query($userInfoSql); 
	$userInfo = mysql_fetch_array($userInfoRes);	

$maritalStatus = 'Single';
if($userInfo['relationship'] == 'E'){
	$maritalStatus = 'Engaged';
}
if($userInfo['relationship'] == 'M'){
	$maritalStatus = 'Married to';
}
$handleStatus = 'Individial';
if($userInfo['handle'] == 'E'){
	$handleStatus = 'Entity';
}
header("location: userDetail.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alacut: User Info</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script>
$(document).ready(function () {
	
	$(".single").click(function () {
		$("#txtMarried").hide();
			});
	$(".engaged").click(function () {
		$("#txtMarried").hide();
			});
	$(".marriedTo").click(function () {
		$("#txtMarried").show();
			});
});
</script>
</head>

<body>
<form name="readProfile" method="post" action="">
<div class="wrapper">
  <div class="top_bar"> 
  	<div class="logo"><a href="../index.php"><img src="../../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="index.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search">
      <input type="submit" name="btnSearch" id="btnSearch" value="2" class="button" />
      <input type="text" name="txtSearch" id="txtSearch" class="input" />
    </div>
  </div>
  <div class="inner">
<div class="inner_left">
  	<div class="left_head1"></div>												
    <div class="left_body">
    <form id="frmUserInfo" name="frmUserInfo" method="POST" action="<?php echo $PHP_SELF;?>" enctype="multipart/form-data">
      <div class="user_info">
        <div class="mid">
          <div class="img">
          	<?php if($userInfo['profile_photo_name'] != ''){
                echo '<img src="../../upload/profilePhotos/'.$userInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
          </div>
         
          <div class="cont">
            <div class="head">Name</div>
            <div class="field">
              <label for="textfield"></label>
              <?php echo $userInfo['full_name']?>
            </div>
            <div class="head">Job</div>
            <div class="field">
              <label for="textfield6"></label>
              <?php echo $userInfo['job']?>
            </div>
            <div class="head">Education</div>
            <div class="field">
              <label for="textfield7"></label>
              <?php echo $userInfo['education']?>
            </div>
            <div class="head">Location</div>
            <div class="field">
              <label for="textfield8"></label>
              <?php echo $userInfo['address']?>
            </div>
            <div class="head">Marital</div>
            <div class="field">
              <?php echo $maritalStatus?>
              <?php echo $userInfo['married_to']?>
            </div>
            <div class="head">URL</div>
            <div class="field">
            	<div style="width: 50px; line-height: 15px;"></div>
            	<label for="textfield10"></label>
              <?php echo "alacut.com/";echo $userInfo['url']?>
            </div>
            <div class="head">Handle</div>
            <div class="field">
              	<?php echo $handleStatus?>
            </div>
          </div>
          <!--<div class="notice">Individuals with morethan 150 connections <br />
            can become entities.</div>-->
        </div>
        
      </div>
     </form>
    </div>
  </div>
  <div class="inner_right">
    
      <div class="user_img">
        <div class="pic">
        	<?php if($userInfo['profile_photo_name'] != ''){
                echo '<img src="../../upload/profilePhotos/'.$userInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
        </div>
        <div class="detail_box">
          <h1><?php echo $userInfo['full_name']?></h1>
          <div class="detail"><strong><img src="../../images/work.jpg" width="15" height="11" />Works at:</strong><?php echo "   "; echo $userInfo['job']?></div>
          <div class="detail"><strong><img src="../../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $userInfo['education']?></div>
          <div class="detail"><strong><img src="../../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $userInfo['address']?></div>
          <div class="detail"><strong><img src="../../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $userInfo['married_to']?></div>
        </div>
      </div>
  </div>
  
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
  </div>
</div>
</form>
</body>
</html>