<?php
include('../config/config1.php');
session_start();
if($_SESSION["login_user_id"]!="" && $_SESSION["login_user_id"]!=0)
{
	
	$chk="SELECT COUNT(video_id) AS total FROM upload_video WHERE video_id=".$_POST['videoId']." AND video_upload_by=".$_SESSION["login_user_id"]; 
	$chq=mysql_query($chk);
	$chq=mysql_fetch_array($chq);
	if($chq['total']==0){
		$insertCommentQry = "INSERT INTO `post_comments`(`videoID`,`memberID`,`comment`) VALUES('".$_POST['videoId']."','".$_SESSION["login_user_id"]."','".$_POST['comment']."')"; 
	}else {
		$insertCommentQry = "INSERT INTO `post_comments`(`videoID`,`memberID`,`comment`,`status`) VALUES('".$_POST['videoId']."','".$_SESSION["login_user_id"]."','".$_POST['comment']."','1')"; 
	}
	mysql_query($insertCommentQry);
	$postCommentQry = "SELECT a.full_name,a.profile_photo_name,p.videoID,p.date_time,p.comment,p.post_type FROM `alacut_member` a INNER JOIN `post_comments` p ON p.memberID=a.member_id WHERE p.videoID='".$_POST['videoId']."' AND p.memberID='".$_SESSION["login_user_id"]."' ORDER BY p.date_time DESC LIMIT 1";
	$postCommentRes = mysql_query($postCommentQry);
	$postCommentInfo = mysql_fetch_array($postCommentRes);
	?> 
<section class="left_vid_comment_box">
  <div class="user_img">
  	<?php if($postCommentInfo['profile_photo_name'] != ''){
		echo '<img src="upload/profilePhotos/'.$postCommentInfo['profile_photo_name'].'" alt="" width="40" height="40">';
}else{
		echo '<img src="images/no-image.jpg" alt="" height="40" width="40">';
	 }}?>
  </div>
  <div class="user_name">
  <?php echo $postCommentInfo['full_name']?>
  </div>
  <div class="desc">
  <?php echo convertToLink($postCommentInfo['comment']);?></div>
  </div>
  </section>
<?php
/**
 * Process a string: replace special chars with HTML valid equivalents, remove backslashes and insert HTML line breaks before all newlines.
 * @param $str Input string
 * @return string Processed string
 */
function display_output($str)
{
    return stripslashes(nl2br($str));//convertToHTMLChars($str)
}

/**
 * Truncate and process a string, replace special chars, remove backslashes, insert HTML line breaks before all newlines and truncate to particular length.
 * @param $str Input string
 * @param $numOfChars number of chars we need to truncate to
 * @return string Processed string
 */
function display_output_trucate($str,$numOfChars)
{
    if(strlen($str) > ($numOfChars-3))
        $str = substr($str,0,((int)$numOfChars-3)) . "...";
    return display_output($str);
}

/**
 * Process string and link all email id and websites
 * @param $str Input text
 * @return string Processed string
 */
function convertToLink($str)
{
    $html = "";
 $reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
 $str=str_replace("\n","<br>",$str);
 
 $hold = explode('<br>',$str);
   $cnt = count($hold);
   for($i=0;$i<$cnt;$i++){
   	if(!empty($hold[$i]))
	{
   	$spacer=explode(' ', $hold[$i]);
	$scnt=count($spacer);
	for($j=0;$j<$scnt;$j++)
	{
		
	    if(filter_var($spacer[$j], FILTER_VALIDATE_EMAIL)){
	      $html.= '&nbsp;<a href="mailto:'.$spacer[$j].'"/>'.$spacer[$j].'</a>&nbsp;';
	     }else if(preg_match($reg_exp, $spacer[$j]) == TRUE){
		      if(strpos("http", $spacer[$j]) === false){
		       $html.= '&nbsp;<a href="http://'.$hold[$i].'" target="_blank" />'.$spacer[$j].'</a>&nbsp;';
		      }else{
		       $html.= '&nbsp;<a href="'.$spacer[$j].'" target="_blank" />'.$spacer[$j].'</a>&nbsp;';
		   }
	     }else{
	      $html.= $spacer[$j].'&nbsp;';
	  }
   }
	$html.='<br>';
   }
   }
   return ($html);
 
}
?>
