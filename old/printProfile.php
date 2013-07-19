<?php
?>
<div class="inner_right">
    <div class="user_img">
      <div class="pic">
        <?php if($myProfileInfo['profile_photo_name'] != ''){
                echo '<img src="upload/profilePhotos/'.$myProfileInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
      </div>
      <div class="detail_box">
        <h1><?php echo $myProfileInfo['full_name']?></h1>
        <div class="detail"><strong><img src="images/work.jpg" alt="" width="15" height="11" />Works at:</strong><?php echo "   "; echo $myProfileInfo['job']?></div>
        <div class="detail"><strong><img src="images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $myProfileInfo['education']?></div>
        <div class="detail"><strong><img src="images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $myProfileInfo['address']?></div>
        <div class="detail"><strong><img src="images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $myProfileInfo['married_to']?></div>
      </div>
    </div>
    <div class="user_btn">
    <div class="button"><a href="#">Find&nbsp;Friends</a></div>
    <div class="button"><a href="myFriends.php">Friends</a></div>
    <div class="button"><a href="allPosts.php?id=<?php echo $member_id;?>"><?php echo $totalPostsInfo['count']?>&nbsp;&nbsp;Posts</a></div>
    <div class="button"><a href="editUserInfo.php" style="margin: 0;">Edit&nbsp;Info</a></div>
  </div>
  </div>
  