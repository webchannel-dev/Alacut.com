<?php
include('session_header.php');
include('config/config1.php');
$user_check = $_SESSION['login_user_id'];

$qry = "SELECT `login_user_name` FROM `alacut_member` WHERE member_id='$user_check' AND active = '1'";
$ses_sql = mysql_query($qry);
$row = mysql_fetch_array($ses_sql);

$login_session = $row['login_user_name'];

/*if(!isset($login_session))
{
header("Location: index.php");
}*/
?>