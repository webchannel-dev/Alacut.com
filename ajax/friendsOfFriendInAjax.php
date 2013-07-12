<?php
session_start();
include('../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

	$selectUserInfoQry = "SELECT `full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,`handle`,`profile_photo_name`  						                          FROM `alacut_member` WHERE member_id = '".$_POST['ID']."' AND active = '1'"; 
	$selectUserInfoRes = mysql_query($selectUserInfoQry);
	$selectUserInfo = mysql_fetch_array($selectUserInfoRes);
	
	$searchFriendName = $_REQUEST['name'];
	
	$searchFriendQry = "SELECT a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id
						FROM `alacut_member` a INNER JOIN `friend` f ON f.frnd_req_from_id = a.member_id 
						WHERE f.frnd_req_to_id='".$_POST['ID']."' AND f.status='C' AND a.member_id !='".$member_ID."'";			
	$searchFriendRes = mysql_query($searchFriendQry);
	
	/*if($_POST['btnSearch'] == '2')
	{ 	
		header("location:findFriends.php?name=".$_POST['txtSearch']."");
	}*/
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>

function addFriend(frndFromID,frndToID,src)
{
	$.ajax({
		type: "POST",
		url: 'ajax/findFriendInAjax.php',
		data: 'fromId='+frndFromID+'&toId='+frndToID,
		success: function(data) {
			$(src).parent().html("<strong style='color:red;'>Added</strong>");
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});			
}
</script>
      <div class="left_head1">
        <div class="head">
          <h1>Friend-list of Friend</h1>
        </div>
      </div>
      <div class="left_body">
        <div class="group">	
        <?php
        while($searchFriendInfo = mysql_fetch_array($searchFriendRes)){
		?>
          <div class="thumb">
            <div class="title"><?php echo $searchFriendInfo['full_name'];?></div>
            <div class="img"><?php if($searchFriendInfo['profile_photo_name'] != ''){
					echo '<img src="upload/profilePhotos/'.$searchFriendInfo['profile_photo_name'].'" alt="" width="90" height="90">';
				}else{
						echo '<img src="images/no-image.jpg" alt="" height="90" width="90">';
					 }?>
            </div>
            <div>
            <button name="btnAddFriend" id="btnAddFriend" type="button" onclick="addFriend('<?php echo $member_ID;?>','<?php echo $searchFriendInfo['member_id'];?>',this)">add as friend</button>
            </div>
          </div>
          <?php
          }
		  ?>
        </div>
      </div>
    