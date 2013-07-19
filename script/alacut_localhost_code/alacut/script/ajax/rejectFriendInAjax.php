<?php
include('../../config/config1.php');
session_start();

$updateFriendStatusQry = "UPDATE `friend` SET `status` = 'R' WHERE friend_id = '".$_POST['FromID']."'";
mysql_query($updateFriendStatusQry);
?>