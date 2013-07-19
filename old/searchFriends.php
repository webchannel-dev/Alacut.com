<?php
include('config/config1.php');
include('lock.php');
session_start();

$searchQry = "SELECT `full_name` FROM `alacut_member` WHERE `first_name` LIKE '%".$_POST['txtSearch']."%'";
echo $searchQry;//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
	<div class="search"> <img src="images/search_button.jpg" alt="search_button" width="36" height="36" border="0" usemap="#Map" />
      <map name="Map" id="Map">
        <area shape="rect" coords="16,4,37,28" href="#" />
      </map>
      <input type="text" name="txtSearch" id="txtSearch" />
    </div>
</body>
</html>