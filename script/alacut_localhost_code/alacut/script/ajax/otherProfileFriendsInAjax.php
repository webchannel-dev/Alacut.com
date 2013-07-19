<?php
include('../../config/config1.php');
include('../session_header.php');
$memberID = $_SESSION['login_user_id'];

//echo $_POST['FriendID'];
$otherFriendQry = "SELECT a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id
					FROM `alacut_member` a INNER JOIN `friend` f ON f.frnd_req_from_id = a.member_id 
					WHERE f.frnd_req_to_id='".$_POST['FriendID']."' AND f.status='C' AND member_id != '".$_POST['FriendID']."' AND active = '1'";
$otherFriendRes = mysql_query($otherFriendQry);
?>
<script type="text/javascript">
	function addFriend(frndFromID,frndToID)
	{	
		$.ajax({
			type: "POST",
			url: 'ajax/findFriendInAjax.php',
			data: 'fromId='+frndFromID+'&toId='+frndToID,
			success: function(data) {
				alert('Friend request has been sent');
			},
			error: function(e) {
				alert("There is somme error in the network. Please try later.");
			}
		});			
	}
</script>
<header class="head">
  <h1>List of Friends</h1>
</header>

<section class="left_body">
<section class="group">	
<?php
while($otherFriendInfo = mysql_fetch_array($otherFriendRes)){
?>
  <article class="thumb">
    <div class="title"><?php echo $otherFriendInfo['full_name'];?></div>
    <div class="img"><?php if($otherFriendInfo['profile_photo_name'] != ''){
            echo '<img src="../upload/profilePhotos/'.$otherFriendInfo['profile_photo_name'].'" alt="" width="90" height="90">';
        }else{
                echo '<img src="../images/no-image.jpg" alt="" height="90" width="90">';
             }?>
    </div>
    <button name="" type="button" onclick="addFriend('<?php echo $memberID;?>','<?php echo $otherFriendInfo['member_id'];?>')">add as friend</button>
  </article>
  <?php
  }
  ?>
</section>
</section>
