<?php 
session_start();
include('config/config1.php');
$member_ID = $_SESSION['login_user_id'];
if(isset($member_ID) && $member_ID!="0" && !empty($member_ID))
{
	$postCommentQry = "SELECT a.full_name,a.profile_photo_name,p.videoID,p.date_time,p.comment,p.post_type FROM `alacut_member` a INNER JOIN `post_comments` p ON p.memberID=a.member_id WHERE p.videoID='".$LargeVideoId."' ORDER BY post_comment_id";
	$postCommentRes = mysql_query($postCommentQry);

 while($postCommentInfo = mysql_fetch_array($postCommentRes)) { ?>
    <section class="left_vid_comment_box">
      <div class="user_img">
        <?php if($postCommentInfo['profile_photo_name'] != ''){
            echo '<img src="upload/profilePhotos/thumb/t_40/'.$postCommentInfo['profile_photo_name'].'" alt="" width="40" height="40">';
    }else{
            echo '<img src="upload/profilePhotos/thumb/t_90/no-image.jpg" alt="" height="40" width="40">';
         }?>
      </div>
      <div class="user_name">
	  	<?php echo $postCommentInfo['full_name']?>
        </div>
      <div class="desc" ><?php echo convertToLink($postCommentInfo['comment']);?></div>
    </section>
<?php }} 
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


