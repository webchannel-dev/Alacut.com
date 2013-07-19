<?php
session_start();
include('../../config/config1.php');
$member_id = $_SESSION['login_user_id'];

if($_POST['id'])
{
	$id=mysql_escape_String($_POST['id']);  //echo $id;
	$name=mysql_escape_String($_POST['name']); //echo $name;
	
	$Qry = "SELECT `like_id` FROM `video_like` WHERE memberID = '".$member_id."' AND videoID = '".$id."' ";
	$QryRes = mysql_query($Qry);
	$QryNum = mysql_num_rows($QryRes);
		
		if($QryNum > 0)
		{
			mysql_query("UPDATE `video_like` SET `status`='".$name."' WHERE videoID='".$id."' AND memberID = '".$member_id."'");
			if($name == 'like')
			{
				$updateLikeQry = "UPDATE `upload_video` SET `like` = `like` + 1,`dislike` = `dislike` - 1   WHERE video_id = '$id'";
				mysql_query($updateLikeQry);
			}
		else
			{
				$updateDisLikeQry = "UPDATE `upload_video` SET `like` = `like` - 1,`dislike` = `dislike` + 1   WHERE video_id = '$id'";
				mysql_query($updateDisLikeQry);
			}
		}
		else{
			$insertQry = "INSERT INTO `video_like`(`videoID`,`memberID`,`status`) VALUES('$id','$member_id','$name')";
	mysql_query($insertQry);
	if($name == 'like')
		{
			$updateLikeQry = "UPDATE `upload_video` SET `like` = `like` + 1 WHERE video_id = '$id'";
			mysql_query($updateLikeQry);
		}
	else
		{
			$updateDisLikeQry = "UPDATE `upload_video` SET `dislike` = `dislike` + 1 WHERE video_id = '$id'";
			mysql_query($updateDisLikeQry);
		}
	}
		/*$hits=mysql_query("SELECT `like`+`dislike` AS totalhits FROM `upload_video` WHERE `video_id`='".$id."'");
		$hits=mysql_fetch_array($hits);
		echo $hits['totalhits'];*/
		
		$iframeVideoPostQry = "SELECT u.video_id,u.like,u.dislike,a.member_id, u.visit, l.status AS ldStatus
		FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id
		LEFT JOIN `video_like` AS l ON l.videoID = u.video_id AND l.memberID = '$member_id'
		WHERE u.status!='2' AND u.video_id = '".$id."' ORDER BY `like` DESC LIMIT 1";  //$_POST['uid']
	$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
	$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
	if($iframeVideoPostNUM > 0)
	{
		$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
		$showBar = FALSE;
	  	if($iframeVideoPostInfo['like'] != 0 OR $iframeVideoPostInfo['dislike'] !=0)
		{
			$up_value = $iframeVideoPostInfo['like'];
			$down_value = $iframeVideoPostInfo['dislike'];
			$total = $up_value + $down_value;
			$up_per = ($up_value*100)/$total; 
			$down_per = ($down_value*100)/$total;
			$showBar = TRUE;
		 }
	}
}
?>
    <div class="top">	
    <?php if($iframeVideoPostInfo['ldStatus'] == 'like' ){ ?>		 
      <a href="#" class="like" id="dislike" name="dislike"><img src="../../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
    <?php } 
        elseif($iframeVideoPostInfo['ldStatus'] == 'dislike'){ ?>
            <a href="#" class="like" id="like" name="like"><img src="../../images/like.jpg" title="I like it" width="24" height="24"></a>
     <?php } else{?>
                <a href="#" class="like" id="dislike" name="dislike"><img src="../../images/dislike.jpg" title="I Don't like it" width="24" height="24"></a>
                <a href="#" class="like" id="like" name="like"><img src="../../images/like.jpg" title="I like it" width="24" height="24"></a>
     <?php } ?>
    </div>
    <?php if($showBar){?>
    <div class="bot">
        <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
        <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
    </div>
    <?php }?>

