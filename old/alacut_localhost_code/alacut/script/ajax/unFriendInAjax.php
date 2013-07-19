<?php
include('../../config/config1.php');

/*$unFriendQry = "UPDATE `friend` SET `status` = 'U' WHERE frnd_req_from_id = '".$_POST['unFrndFromID']."' AND frnd_req_to_id = '".$_POST['unFrndToID']."'";*/
$unFriendQry = "UPDATE `friend` SET `status` = 'U' WHERE frnd_req_from_id = '".$_POST['unFrndFromID']."' AND frnd_req_to_id = '".$_POST['unFrndToID']."'";
mysql_query($unFriendQry);
?>