<?php
include('../../config/config1.php');

echo $updateFriendStatusQry = "UPDATE `friend` SET `status` = 'C' WHERE friend_id = '".$_POST['frndFromID']."'";
mysql_query($updateFriendStatusQry);
?>