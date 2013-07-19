<?php
include('../config/config1.php');
session_start();
$memberID = $_SESSION['login_user_id'];
if($memberID!=0 || $memberID!="")
{
	
  $otherFriendQry ="SELECT f.friend_id,a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id,f.status
 FROM `friend` f INNER JOIN `alacut_member` a ON f.frnd_req_from_id = a.member_id 
 WHERE a.member_id!='$memberID' AND f.frnd_req_to_id=".$_POST['FriendID']." AND a.active = '1' AND f.status='C' 
 UNION ALL 
 SELECT  f.friend_id,a.member_id,a.full_name,a.profile_photo_name,f.frnd_req_from_id,f.frnd_req_to_id,f.status
  FROM `friend` f INNER JOIN `alacut_member` a ON f.frnd_req_to_id = a.member_id 
  WHERE a.member_id!='$memberID' AND f.frnd_req_from_id=".$_POST['FriendID']." AND a.active = '1' AND f.status='C'"; 
$otherFriendRes = mysql_query($otherFriendQry);

$mutualquery="SELECT f.frnd_req_from_id,f.frnd_req_to_id,f.status
			FROM `friend` f
			WHERE (f.frnd_req_to_id='$memberID' OR f.frnd_req_from_id='$memberID') AND f.status IN ('P','C')";
$frndofuser=mysql_query($mutualquery);
$frnds=array();
while($frndofuserInfo=mysql_fetch_array($frndofuser))
{
	if($frndofuserInfo["frnd_req_from_id"]!=$memberID)
		$frnds[]=$frndofuserInfo["frnd_req_from_id"].':'.$frndofuserInfo["status"].'T';//F-Request made to me
	else if($frndofuserInfo["frnd_req_to_id"]!=$memberID)
		$frnds[]=$frndofuserInfo["frnd_req_to_id"].':'.$frndofuserInfo["status"].'F';//T-Request made from me 
}
//print_r($frnds);exit();
function checkMutual($chkid)
{
	global 	$frnds;
	
	foreach($frnds as $value)
	{
		$kv=explode(":",$value);
		if($chkid==$kv[0])
		{
			//echo $chkid.'-'.$kv[1];
			return $kv[1];
		}
	}
	return "";
}
?>
<script type="text/javascript">
function unFriend(fromID,toID,src)
{
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			if(toID==uid)
				$(src).parent().html('<button type="button"  onclick="addFriend('+toID+','+fromID+',this)" rtype="n">'+data+'</button>');
			else
				$(src).parent().html('<button type="button"  onclick="addFriend('+fromID+','+toID+',this)" rtype="n">'+data+'</button>');
			$(src).remove();
			
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});	
	}
}

function addFriend(fromID,toID,src)
{
	
	if($(src).attr("rtype"))
	{
		var ur='fromID='+fromID+'&toID='+toID+'&rtype='+$(src).attr("rtype");
	$.ajax({
		type: "POST",
		url: 'ajax/confirmfriendInAjax.php',
		data: ur,
		success: function(data) {
			alert('Added as friend');
			$(src).parent().html('<button  type="button" onclick="unFriend('+fromID+','+toID+',this)" rtype="u">'+data+'</button>');
			$(src).remove();
		},
		error: function(e) {
			alert("There is somme error in the network. Please try later.");
		}
	});
	}			
}
</script>
<header class="head">
  <h1>List of Friends</h1>
</header>

<section class="left_body">
<section class="group">	
<?php
$req=1;
while($otherFriendInfo = mysql_fetch_array($otherFriendRes)){
?>
  <article class="thumb" <?php if($req%6==0)echo "style=margin:0;";$req++;?>>
    <div class="title"><?php echo $otherFriendInfo['full_name'];?></div>
    <div class="img"><a href='otherUserProfile.php?id=<?php echo $otherFriendInfo['member_id'];?>'><?php if($otherFriendInfo['profile_photo_name'] != ''){
            echo '<img src="upload/profilePhotos/thumb/t_90/'.$otherFriendInfo['profile_photo_name'].'" alt="" width="90" height="90">';
        }else{
                echo '<img src="upload/profilePhotos/thumb/t_90/no-image.jpg" alt="" height="90" width="90">';
         }?></a>
    </div>
    <div>
    	
	<?php
	$fid=$otherFriendInfo['frnd_req_from_id']==$_POST['FriendID']?$otherFriendInfo['frnd_req_to_id']:$otherFriendInfo['frnd_req_from_id'];
	 $chk=checkMutual($fid);
	  
	if($chk=="PT"){?>
	<button name="" type="button" onclick="addFriend(<?php echo $fid;?>,<?php echo $memberID;?>,this)" rtype="a">accept</button>
	<?php }else if($chk=="PF" ){?>
	<button name="" type="button" onclick="unFriend(<?php echo $memberID;?>,<?php echo $fid;?>,this)" rtype="c">cancel request</button>
	<?php } else if($chk=="CT" ){?>
		<button name="" type="button" onclick="unFriend(<?php echo $fid;?>,<?php echo  $memberID;?>,this)" rtype="u">unfriend</button>
	<?php } else if($chk=="CF" ){?>
		<button name="" type="button" onclick="unFriend(<?php echo $memberID;?>,<?php echo  $fid;?>,this)" rtype="u">unfriend</button>
	<?php } else{?>
		
	<button name="" type="button" onclick="addFriend('<?php echo $memberID;?>','<?php echo $fid;?>',this)" rtype="n">add as friend</button>
	<?php }?>
    	
    </div>
  </article>
  <?php
  }
  
  ?>
</section>
</section>
<?php } ?>
