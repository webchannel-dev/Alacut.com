<?php 
include('../config/config1.php');
$a=mysql_query("DELETE FROM `post_comments` WHERE `post_comment_id` ORDER BY post_comment_id DESC LIMIT 1");

?>