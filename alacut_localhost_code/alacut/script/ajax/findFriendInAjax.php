<?php
include('../../config/config1.php');
session_start();

$insertFriendReqQry = "INSERT INTO `friend`(`frnd_req_from_id`,`frnd_req_to_id`) VALUES ('".$_POST['fromId']."','".$_POST['toId']."')";
mysql_query($insertFriendReqQry);
?>	

	
                        
                        										
                        