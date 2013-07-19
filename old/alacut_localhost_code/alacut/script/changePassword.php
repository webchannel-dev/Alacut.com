<?php
	include('../config/config1.php');
    session_start()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alacut: User Info</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
$(document).ready(function () {
	  $(".change_password").hide();
      $(".three").click(function () {
      $(".change_password").slideToggle("fast");
            });
	/*$(".change_password").hide();
	$(".div_Password").click(function () {
		$(".change_password").show();
			});*/
});
</script>
</head>
<body>
	<div class="three">
      <button name="" type="button">Change&nbsp;Password</button>
    </div>
    <div class="change_password">
        <div class="head">Current Password</div>
        <div class="cont"><span class="field">
          <input type="password" name="currentPwd1" id="currentPwd1" />
        </span></div>
        <div class="head">New Password</div>
        <div class="cont"><span class="field">
          <input type="password" name="currentPwd2" id="currentPwd2" />
        </span></div>
        <div class="head">Re-enter New Password</div>
        <div class="cont"><span class="field">
          <input type="password" name="currentPwd3" id="currentPwd3" />
        </span></div>
  </div>
</body>
</html>