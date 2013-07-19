<?php
include('../../config/config1.php');
session_start();
if($_SESSION['login_user_id']!="" || $_SESSION['login_user_id']!=0)
{
$updateFriendStatusQry = "UPDATE `friend` SET `status` = 'R' WHERE friend_id = '".$_POST['FromID']."'";
mysql_query($updateFriendStatusQry);
}
?>