<?php
session_start();
	require '../config/config1.php';
    
    if(isset($_GET['email']) && isset($_GET['pwd']))
    {
	$userEmail = stripslashes($_GET['email']);
	$userPassword = stripslashes($_GET['pwd']);
	$userEmail = mysql_real_escape_string($userEmail);
	$userPassword = mysql_real_escape_string($userPassword);
	
	$sql = "SELECT member_id,email,isAdmin FROM alacut_member WHERE email='$userEmail' AND password='$userPassword' AND active = '1'";	
	
	$result = mysql_query($sql);	
	$row = mysql_fetch_array($result);	
	$count = mysql_num_rows($result);	
	
	if($count==1)
	{
		
		$memberID = $row['member_id'];
		if(isset($_SESSION['login_user_id']))
		{
			unset($_SESSION['login_user_id']);
		}
		$_SESSION['login_user_id'] = $memberID;
		if($row['isAdmin'] == '1')
		{
			echo ("http://www.alacut.com/admin/index.php");
			
		}else
		{
			if( $_REQUEST['videourl']  !='')
			{
				echo "http://www.alacut.com/getpinimagevideo.php?url=".$_REQUEST['videourl'];
			}
			else
			{
				echo("http://www.alacut.com/home.php");
			
			}
		}
	}
	else
	{
		 echo "false";
	}
}
?>