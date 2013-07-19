<?php
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
		session_start();
		$memberID = $row['member_id'];
		$_SESSION['login_user_id'] = $memberID;
		if($row['isAdmin'] == '1')
		{
			echo ("http://localhost/alacut/script/admin/index.php");
			
		}else
		{
			if( $_REQUEST['videourl']  !='')
			{
				echo "http://localhost/alacut/script/getpinimagevideo.php?url=".$_REQUEST['videourl'];
			}
			else
			{
				echo("http://localhost/alacut/script/home.php");
			
			}
		}
	}
	else
	{
		 echo "false";
	}
}
?>