<?php
session_start();
include('../config/config1.php');
$member_ID = $_SESSION['login_user_id'];

$selectPwdQry = mysql_query("SELECT `password` FROM `alacut_member` WHERE  member_id = '".$_REQUEST['id']."' ");
		$selectPwdRes = mysql_fetch_assoc($selectPwdQry); 
		$currentPwdDB = $selectPwdRes['password'];

if($_POST['btnDeleteUser'] == 'DELETE')
{	
		mysql_query("UPDATE `alacut_member` SET `active` = '2',`deleted_by`='".$member_ID."' WHERE  member_id = '".$_REQUEST['id']."' "); 
		header("location: index.php");
}

if($_POST['btnUserType'] == 'Confirm')
{	
	
		mysql_query("UPDATE `alacut_member` SET `handle` = 'E' WHERE  member_id = '".$_REQUEST['id']."' "); 
		header("location: viewUserProfile.php?"."id=".$_REQUEST['id']."");

}

if($_POST['btnCreateUserInfo'] == 'Save Your Profile')  
{
	//Upload Photo
	$profilePhoto = ' ';
	if($_FILES['txtProfilePhoto']['name'] != '' && $_FILES['txtProfilePhoto']['size'] > 0)
	{
		$fileName = @md5($empCode).basename( $_FILES['txtProfilePhoto']['name']);
		$target_path = $_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'. $fileName;
		if ( move_uploaded_file($_FILES['txtProfilePhoto']['tmp_name'], $target_path))
		{
			$profilePhoto = " , `profile_photo_name` = '$fileName'";
		}
	}
	//Password Change
	if($_POST['newPwd1'] != '' && $_POST['newPwd2'] != ''){
		if($_POST['newPwd1'] == $_POST['newPwd2'])
		{	
			mysql_query("UPDATE `alacut_member` SET `password` = '".$_POST['newPwd1']."' WHERE  member_id = '".$_REQUEST['id']."' "); 
		}else 
			{
				echo "New Password doesn't match";
			}
	}
	//Update user detail	
	$updateUserInfoSql = "UPDATE `alacut_member` SET `full_name` = '".$_POST['txtName']."', `job` = '".$_POST['txtJob']."', `education` = '".$_POST['txtEdu'].                          "', `address` = '".$_POST['txtLoc']."', `relationship` = '".$_POST['ddMStatus']."', `married_to` = '".$_POST['txtMarried']."', `url`  						   						  = '".$_POST['txtUrl']."' $profilePhoto 
						  WHERE member_id = '".$_REQUEST['id']."' AND active = '1'";
 	//echo $updateUserInfoSql;exit();
	@mysql_query($updateUserInfoSql);
	
	header("location: viewUserProfile.php?"."id=".$_REQUEST['id']."");
	exit();
}

$selectUserInfoSql = "SELECT `member_id`,`full_name`,`job`,`education`,`address`,`relationship`,`married_to`,`url`,
`handle`,`profile_photo_name`,`profile_photo_name` FROM `alacut_member` WHERE member_id = '".$_REQUEST['id']."' 
AND active = '1'";	
$selectUserInfoRes = mysql_query($selectUserInfoSql);		
$selectUserInfo = mysql_fetch_array($selectUserInfoRes); 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alacut: User Info</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
$(document).ready(function () {
	  $(".change_password").hide();
	  $("#div_Change_Pwd").click(function () {
      $(".change_password").slideToggle("fast");
	  $(".delete_acc").hide();
	  $(".entity").hide();
	  $(".upload_img").hide();
            });
			
	  $(".delete_acc").hide();
	  $("#div_delete").click(function () {
      $(".delete_acc").slideToggle("fast");
	  $(".entity").hide();
	  $(".change_password").hide();
	  $(".upload_img").hide();
            });
		
	  $("#div_Photo").click(function () {
		$(".upload_img").slideToggle("fast");
		$(".delete_acc").hide();
	  	$(".entity").hide();
		$(".change_password").hide();
			});
	  
	  $(".div_Current_Pwd").hide();
	  $(".delYes").click(function () {
      $(".div_Current_Pwd").slideDown("fast");
            });
	  $(".delNo").click(function () {
      $(".div_Current_Pwd").slideUp("fast");
            });  
			
	  $(".entity").hide();
	  $("#div_Entity").click(function () {
		  
		  $(".entity").slideDown("fast");
		  $(".upload_img").hide();
		  $(".delete_acc").hide();
		  $(".change_password").hide();
				});
	  $("#div_Indivisual").click(function () {
      $(".entity").hide();
	  $(".upload_img").hide();
	  $(".delete_acc").hide();
	  $(".change_password").hide();
            });	
	  
	  $(".currentEntityPwd").hide();
	  $(".yes").click(function () {
      $(".currentEntityPwd").slideDown("fast");
            });
	  $(".no").click(function () {
      $(".currentEntityPwd").slideUp("fast");
            });
			
	$(".single").click(function () {
		$("#txtMarried").hide();
			});
	$(".engaged").click(function () {
		$("#txtMarried").hide();
			});
	$(".marriedTo").click(function () {
		$("#txtMarried").show();
			});
});

function validateSubmit()
{
	var name = document.forms["editProfile"]["txtName"].value;
	var namelen = name.length;
	if (name == null || name == ""){
		alert("Please enter Full Name");
		return false;
	}else if(/^[a-zA-Z ]*$/.test(name)== false)
	{  
		alert('Full Name:Please enter alphabets only ');
		return false;
	}else if (namelen > 16){
		alert("Full Name :Please enter 16 characters only");
		return false;
	}
}
</script>
</head>
<body>
<form name="editProfile" method="post" action="" enctype="multipart/form-data">
<div class="wrapper">
  <div class="top_bar"> 
        <div class="logo"><a href="../index.php"><img src="../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
        <div class="home"><a href="index.php" width="111" height="36" alt="alacut">Home</a></div>
        <div style="width: 220px; height: 36px;"></div>
        <div class="logout"><a href="../logout.php">Logout</a></div>
    </div>
  <div class="inner">
<div class="inner_left">
  	<div class="left_head1"></div>												
    <div class="left_body">
    <form id="frmUserInfo" name="frmUserInfo" method="POST" action="<?php echo $PHP_SELF;?>" enctype="multipart/form-data">
      <div class="user_info">
        <div class="mid">
          <div class="img">
          	<?php if($selectUserInfo['profile_photo_name'] != ''){
                	echo '<img src="../upload/profilePhotos/'.$selectUserInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>'; 
            }?>
          </div>
         
          <div class="cont">
            <div class="head">Name</div>
            <div class="field">
              <label for="textfield"></label>
              <input type="text" name="txtName" id="txtName" value="<?php echo $selectUserInfo['full_name']?>"/>
            </div>
            <div class="head">Job</div>
            <div class="field">
              <label for="textfield6"></label>
              <input type="text" name="txtJob" id="txtJob" value="<?php echo $selectUserInfo['job']?>"/>
            </div>
            <div class="head">Education</div>
            <div class="field">
              <label for="textfield7"></label>
              <input type="text" name="txtEdu" id="txtEdu" value="<?php echo $selectUserInfo['education']?>"/>
            </div>
            <div class="head">Location</div>
            <div class="field">
              <label for="textfield8"></label>
              <input type="text" name="txtLoc" id="txtLoc" value="<?php echo $selectUserInfo['address']?>"/>
            </div>
            <div class="head">Marital</div>
            <div class="field">
              <select name="ddMStatus" id="ddMStatus" style="width: 84px; height: 18px;">
                <option class="single" value="S" selected="selected">Single</option>
                <option class="engaged" value="E" <?php if($selectUserInfo['relationship'] == 'E') echo 'selected="selected"';?>>Engaged</option>
                <option class="marriedTo" value="M" <?php if($selectUserInfo['relationship'] == 'M') echo 'selected="selected"';?>>Married to</option>
              </select>
              <input type="text" name="txtMarried" id="txtMarried" value="<?php echo $selectUserInfo['married_to']?>" style="width: 150px;display:none; margin-left: 10px" />
            </div>
            <div class="head">URL</div>
            <div class="field">
            	<div style="width: 50px; line-height: 15px;">alacut.com/</div>
            	<label for="textfield10"></label>
              <input type="text" name="txtUrl" id="txtUrl" value="<?php echo $selectUserInfo['url']?>" style="width: 184px; margin-left: 10px"/>
            </div>
            <div class="head">Handle</div>
            <div class="field">
              <select name="userType" id="userType" style="width: 84px; height: 18px;">
              	<option value="I" id="div_Indivisual" selected="selected">Individial</option>
                <option value="E" id="div_Entity" <?php if($selectUserInfo['handle'] == 'E') echo 'selected="selected"';?>>Entity</option>
              </select>
            </div>
          </div>
          <!--<div class="notice">Individuals with morethan 150 connections <br />
            can become entities.</div>-->
        </div>
        <div class="bot">
          <div class="one">
            <button name="" id="div_Photo" type="button">New&nbsp;Profile&nbsp;Picture</button>
          </div>
          <div class="two" id="div_delete">
            <button type="button">Delete&nbsp;Account</button>
          </div>
          <div class="three" id="div_Change_Pwd">
            <button name="" type="button">Change&nbsp;Password</button>
        </div>
          <div class="four">
            <input class="button" type="submit" id="btnCreateUserInfo" name="btnCreateUserInfo" value="Save Your Profile" onclick="return validateSubmit();"/>
      </div>
        </div>
        <div class="upload_img" style="display: none;"><input type="file" id="txtProfilePhoto" name="txtProfilePhoto" style="width:300px;" /></div>
        <div class="change_password">
          <div class="head"></div>
          <div class="cont"><span class="field">
            <!--<input type="password" name="currentPwd" id="currentPwd" />-->
          </span></div>
          <div class="head">New Password</div>
          <div class="cont"><span class="field">
            <input type="password" name="newPwd1" id="newPwd1" />
          </span></div>
          <div class="head">Re-enter New Password</div>
          <div class="cont"><span class="field">
            <input type="password" name="newPwd2" id="newPwd2" />
          </span></div>
        </div>
        <div class="delete_acc">
          <div class="warning">Are you sure want to delete your account? You can not undo this.</div>
          <div class="cont">
            <div class="yes delYes" id="yes"><a href="#">Yes</a></div>
            <div class="no delNo" id="no"><a href="#">No</a></div>
          </div>
          <div class="div_Current_Pwd">
            <div class="head"></div>
            <div class="cont"><span class="field">
              <!--<input type="password" name="currentPwdToDel" id="currentPwdToDel" />-->
            </span></div>
            <div class="head"></div>
            <div class="cont"><span class="field">
              <div class="del">
                <input type="submit" id="btnDeleteUser" name="btnDeleteUser" value="DELETE"/>
              </div>
            </span></div>
          </div>
      </div>
        <div class="entity">
          <div class="head">
            <div class="warning">Are you sure want to change your handle to entity?</div>
          </div>
          <div class="cont">
            <div class="yes"><a href="#">Yes</a></div>
            <div class="no"><a href="#">No</a></div>
          </div>
          <div class="currentEntityPwd">
            <div class="head"></div>
            <div class="cont"><span class="field">
              <!--<input type="password" name="currentPwdUserType" id="currentPwdUserType" />-->
            </span></div>
            <div class="head"></div>
            <div class="cont"><span class="field">
              <div class="del">
                <input type="submit" id="btnUserType" name="btnUserType" value="Confirm"/>
              </div>
            </span></div>
          </div>
        </div>
      </div>
     </form>
    </div>
  </div>
  <div class="inner_right">
      <div class="user_img">
        <div class="pic">
			<?php if($selectUserInfo['profile_photo_name'] != ''){
                echo '<img src="../upload/profilePhotos/'.$selectUserInfo['profile_photo_name'].'" alt="" width="300" height="300"/>';
                }else{
                    echo '<img src="../images/no-image.jpg" alt="" width="300" height="300"/>';
            }?>
        </div>
        <div class="detail_box">
          <h1><?php echo $selectUserInfo['full_name']?></h1>
          <div class="detail"><strong><img src="../images/work.jpg" width="15" height="11" />Works at:</strong><?php echo "   "; echo $selectUserInfo['job']?></div>
          <div class="detail"><strong><img src="../images/sudies.jpg" alt="" width="15" height="11" />Studied:</strong><?php echo "   "; echo $selectUserInfo['education']?></div>
          <div class="detail"><strong><img src="../images/livesin.jpg" alt="" width="15" height="11" />Lives in:</strong><?php echo "   "; echo $selectUserInfo['address']?></div>
          <div class="detail"><strong><img src="../images/married.jpg" alt="" width="15" height="11" />Married to:</strong><?php echo "   "; echo $selectUserInfo['married_to']?></div>
        </div>
      </div>
  </div>
  
<div class="footer_inner"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a> | <a href="#">2012 Alacut</a></div>
  </div>
</div>
</form>
</body>
</html>

            