<?php
include('../../config/config1.php');

    $cond=$videoDetailQry .= " AND video_name like '%".$_POST['searchName']."%'";
     
	$videoDetailQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.visit,u.video_type,u.like,u.dislike,a.full_name,u.uploaded_date 
     FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by WHERE u.status !='2' AND a.member_id='24' $cond ORDER BY u.uploaded_date DESC";
	$videoDetailRes = mysql_query($videoDetailQry);
	$videoDetailNum = mysql_num_rows($videoDetailRes);
?>

<?php while($videoDetailInfo = mysql_fetch_array($videoDetailRes)) {?>
        <div class="left_thumb">
          <div class="posts"><a href="#"><img class="video" src="<?php echo $videoDetailInfo['video_type']=="youtube"?"http://img.youtube.com/vi/".$videoDetailInfo['video_object']."/1.jpg":"../images/no-image.jpg"?>" alt="" width="140" height="74" data="<?php echo $videoDetailInfo['video_object']?>" videoType = "<?php echo $videoDetailInfo['video_type'] ?>"/></a>
    <div class="home_des_thumb">
      <div class="post_title"><?php echo $videoDetailInfo['video_name']?></div>
      <div class="name"><?php echo $videoDetailInfo['full_name']?></div>
    </div>
    <?php
    if($videoDetailInfo['like'] != 0 OR $videoDetailInfo['dislike'] !=0)
    {
        $up_value = $videoDetailInfo['like'];
        $down_value = $videoDetailInfo['dislike'];
        $total = $up_value + $down_value;
        $up_per = ($up_value*100)/$total; 
        $down_per = ($down_value*100)/$total;?> 
        <div class="like_bar2">
          <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
          <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
        </div>
    <?php }?>
  </div>
</div><?php } ?>