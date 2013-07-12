<?php
session_start();
include('../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

	$messageDisplayQry = "SELECT * FROM (SELECT m.message_id,m.reply_id,m.message_content,m.message_from_id,m.message_to_id,a.profile_photo_name,a.full_name FROM `message` m INNER JOIN `alacut_member` a ON m.message_from_id=a.member_id
 WHERE m.message_to_id='".$member_ID."' AND m.status ='0' ORDER BY m.message_id DESC) AS v_Message GROUP BY v_Message.message_from_id,v_Message.message_to_id LIMIT 10";
	$messageDisplayRes = mysql_query($messageDisplayQry);
	$messageDisplayNum = mysql_num_rows($messageDisplayRes);
?>
<h1>New Emails</h1>
<div id="_boxscroll" style="overflow: auto; overflow-x: hidden; height: 170px; display:none2"> 
       <?php if($messageDisplayNum > 0) {
          while($messageDisplayInfo = mysql_fetch_array($messageDisplayRes)) 
		 {	?>
           <a href="mailingDetail.php?id=<?php echo $messageDisplayInfo['message_from_id'];?>">
           <div class="msg_box" >
            <div class="user_img">
            	<?php if($messageDisplayInfo['profile_photo_name'] != ''){
                echo '<img src="upload/profilePhotos/'.$messageDisplayInfo['profile_photo_name'].'" alt="" width="40" height="40"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="40" height="40"/>';
            }?>
            </div>
            <div class="msg_box_name"><?php echo $messageDisplayInfo['full_name'];?></div>
            <div class="msg_box_msg"><?php echo $messageDisplayInfo['message_content'];?></div>
          </div></a>
          <?php
		} }else{?>  
        	<div class="msg_box" style="text-align:center">
            	<strong>No message</strong>
            </div>
        <?php } ?>
        </div>