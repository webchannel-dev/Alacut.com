<?php
session_start();
include('../config/config1.php');
include('../lib/db.function.php');
include 'facebook/login-facebook.php';
//Twitter login
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: twitter/login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: facebook/login-facebook.php");
    }else if ($oauth_provider == 'linkedin') {
        header("Location: linkedin/linkedin-login.php");
    }
}

$title = 'alacut Login Page';	

//video
$LargeVideoId = 0;
if(isset($_REQUEST['vid']) > 0){
	$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_name,u.like,u.dislike,a.member_id,a.full_name
	FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id  
	WHERE u.status!='2' AND u.video_id = ".$_REQUEST['vid']."  LIMIT 1";
}else{
	$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_name,u.like,u.dislike,a.member_id,a.full_name
	FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id WHERE u.status!='2'  ORDER BY `like` DESC LIMIT 1";
}
$iframeVideoPostRes = mysql_query($iframeVideoPostQry); 
$iframeVideoPostNUM = mysql_num_rows($iframeVideoPostRes);
if($iframeVideoPostNUM > 0)
{
	$iframeVideoPostInfo = mysql_fetch_array($iframeVideoPostRes);
	$LargeVideoId = $iframeVideoPostInfo['video_id'];
	$update = "UPDATE `upload_video` SET visit = visit + 1 WHERE video_id = '".$LargeVideoId."'";
	mysql_query($update);
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
	 $videoSrc = "";
     
	 if($iframeVideoPostInfo['video_type'] == "youtube"){
			$videoSrc = "http://www.youtube.com/embed/" . $iframeVideoPostInfo['video_object'];
	 }else if($iframeVideoPostInfo['video_type'] == "vimeo"){
		 $videoSrc = "http://player.vimeo.com/video/" . $iframeVideoPostInfo['video_object'];
	 }

	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_type,u.like,u.dislike,a.full_name 
	FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
	WHERE u.status!= '2'  AND u.video_id != '".$iframeVideoPostInfo['video_id']."' ORDER BY `like` DESC LIMIT 6";
	$videoPostRes = mysql_query($videoPostQry);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>alacut: Welcome to alalcut</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<link type="text/css" rel="stylesheet" href="../css/colorbox.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui-1.8.15.custom.css" />
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
		$("#btnSearch").click(function(){
		$(".popup").colorbox({scrolling: false, overlayClose: false, escKey: false, opacity: 0.8});
		$("#btnSearch").attr("href","Search.php?search="+$("#txtFriendSearch").val());
		});
		
        $(".VisibleLogin").click(function () {
            $("#div_Name").hide();
            $("#btnLogin").show();
            $("#div_button").hide();
            $("#div_forgotPwd").hide();
            $(".login_sn").hide();
            $("#Log-In").show();
            return false;
        });
        $("#btnSignup").click(function () {
            $(".login_sn").show();
            $("#Log-In").hide();
            $('#errbox').hide();
            return false;
        });
        $("#btnForgot").click(function () {
            $("#div_forgotPwd").slideToggle("fast");
            return false;
        });

        $('#login-trigger').click(function () {
            $(this).next('#login-content').slideToggle();
            $(this).toggleClass('active');

            if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
        });

        GetLargeVideo();
    });

    function GetLargeVideo() {
        $(".smallVideo").each(function () {
            var svID = $(this).attr("svId");

            $(this).click(function () {
                //Show Loader
                $.ajax({
                    type: "POST",
                    url: 'ajax/indexLargeVideo.php',
                    data: 'svId=' + svID,
                    success: function (data) {
                        $("#LargeVideo").html(data);
                        //Hide Loader
                        GetBelowVideo(svID);
                    },
                    error: function (e) {
                        alert("There is somme error in the network. Please try later.");
                    }
                });
            });
        });
    }

    function GetBelowVideo(largeID) {
        $.ajax({
            type: "POST",
            url: 'ajax/indexSmallVideo.php',
            data: 'lvId=' + largeID,
            success: function (data) {
                $("#smVideo").html(data);
                GetLargeVideo();
            },
            error: function (e) {
                alert("There is somme error in the network. Please try later.");
            }
        });
    }
    function ShowSignup() {
        $("#login-content").show();
        $(".login_sn").show();
        $("#Log-In").hide();
    }
    function ValidateForm() {

        //validation for Email address
        var warning = '<div class="warning">Warning</div>';
        var msg = "";
        var email = $('#signEmail').val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        var pwd = $('#signPwd').val();
        var cpwd = $('#confirmPwd').val();
        var signupname = $('#signUname').val();
        
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
            msg = '<div class="wrong_pass">You have entered an invalid E-mail id !!</div>';
        }
        else if (pwd == "password" || cpwd == "password" || pwd == "" || cpwd == "") {
            msg = '<div class="wrong_pass">Please Enter Password!!</div>';
        }
        else if (pwd != cpwd) {
            msg = '<div class="wrong_pass">Password is not matching!!</div>';
        }
        else if (signupname == "" || signupname == "username") {
            msg = '<div class="wrong_pass">Please Enter UserName !!</div>';
        }
        else if (signupname != "username" && signupname.length <= 3) {
            msg = '<div class="wrong_pass">UserName Must Contain at least 4 Charcter !!</div>';
        }
			if (msg != "") {
				$('#errbox').html(warning + msg).show();
				return false;
			}else
				{
					CheckEmail(email);
				}
        return true;
    }
    function validatlogin() {
        var warning = '<div class="warning">Warning</div>';
        var msg = "";
        var email = $('#txtEmail').val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        var pwd = $('#txtPwd').val();

        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
            msg = '<div class="wrong_pass">You have entered an invalid E-mail id !!</div>';
        }
        else if (pwd == "password" || pwd == "") {
            msg = '<div class="wrong_pass">Please Enter Password!!</div>';
        }
			if (msg != "") {
				$('#errbox').html(warning + msg).show();
				return false;
			}else
				{
					CheckLogin(email,pwd);
				}
        return true;
    }
	
    function CheckEmail(email) {
        $.ajax({
            url: '../validate/CheckEmail.php',
            type: 'POST',
			data: 'email='+email,
            success: function (msg) {
				if(msg == "showError"){
					$('#errbox').html('<div class="warning">Warning</div>' + '<div class="wrong_pass">Email-id already exists!!</div>').show();
					return false;
				}else{
					$('#errbox').html('<div class="warning">Sucess</div>' + '<div class="req_pass">Verification mail has been send!!</div>').show();
					return false;
				}
            }
        });
		return false;
    }
	function CheckLogin(email,pwd) {
        $.ajax({
            url: '../validate/CheckLogin.php?email=' + email+'&pwd='+pwd,
            type: 'GET',
            success: function (data) {
				if(data == "false")
				{
					$('#errbox').html('<div class="warning">Warning</div>' + '<div class="wrong_pass">Invalid Login credential!!</div>').show();
					return false;
				}
				window.location.href=data;
            }
        });
		return false;
    }
</script>
</head>
<body>
<div class="wrapper">
	<header class="top_bar">
	<div class="logo"><a href="index.php"><img src="../images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="home.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search">
  <a name="btnSearch" id="btnSearch" class="button popup" ><input type="submit" name="btnFriendSearch" id="btnFriendSearch" value="1" style="visibility:hidden"/></a>
   <input type="text" id="txtFriendSearch" name="txtFriendSearch"  class="input" />
    </div>
	<nav id="login" class="login"><a href="#" class="VisibleLogin" id="login-trigger">Login</a>
	<div id="login-content">
        <form id="signup_form" action="index.php" method="POST">	
    	<div class="login_sn">
            <div class="user_img"><img src='../upload/profilePhotos/<?php if($_SESSION['shwsgnup'] == 1){echo $_SESSION['usernamePhoto'];} else{ echo "no-image.jpg";}?>' width="150" height="150" alt=''/></div>
              <div class="input_box">
                <input class="input2" id="signEmail" name="signEmail" type="text" value="email address" onfocus="if(value=='email address'){value=''; }" onblur="if(value==''){value='email address'; }" onclick="if(value=='email address'){value='';}" />
                <input class="input2" id="signPwd" name="signPwd" type="password" value="password" onfocus="if(value=='password'){value=''; }" onblur="if(value==''){value='password'; }" onclick="if(value=='password'){value='';}" />
                <input class="input2" id="confirmPwd" name="confirmPwd" type="password" value="password" onfocus="if(value=='password'){value=''; }" onblur="if(value==''){value='password'; }" onclick="if(value=='password'){value='';}" />
                <input class="input2" id="signUname" name="signUname" type="text" value="username" onfocus="if(value=='username'){value=''; }" onblur="if(value==''){value='username'; }" onclick="if(value=='username'){value='';}" />
          </div>
              <div class="button_box"><input class="button2" name="signUp" type="button" value="Sign Up" onClick="return ValidateForm();"/></div>
        </div>
        </form>   
		<div class="login" id="Log-In" name="Log-In" >
            <div class="sn_but"><a href="?login&oauth_provider=twitter"><img src="../images/twitter.gif" width="150" height="22" alt="twitter" /></a></div>
            <div class="sn_but"><a href="<?php echo $loginUrl; ?>"><img src="../images/facebook.gif" width="150" height="22" alt="facebook" /></a></div>
            <div class="sn_but">
                <a href="?login&oauth_provider=linkedin">
                    <input type="image" src="../images/in.gif" width="150" height="22" />
                </a>
            </div>
            <form  name="Login" method="post" action="" >        
            <div class="input_box" id="div_Email">
            <input class="input" name="txtEmail" id="txtEmail" type="text" value="email address" onFocus="if(value=='email address'){value=''; }"  onBlur="if(value==''){value='email address'; }" onClick="if(value=='email address'){value='';}" />
            
            <input class="button" type="button" name="btnLogin" id="btnLogin" value="Login" onClick="return validatlogin();"/></div>
            
        	<div class="input_box" id="div_Pwd">
                <input class="input" name="txtPwd" id="txtPwd" type="password" value="password" onFocus="if(value=='password'){value=''; }" 
                onblur="if(value==''){value='password'; }" onClick="if(value=='password'){value='';}" />
                <input class="button" name="btnSignup"  id="btnSignup" value="SignUp" />
                <!--<div class="button_box" id="div_button"><input name="sign" id="sign" type="submit" value="Sign Up" /></div>-->
            </div>
            </form>         
        	<div class="input_box2"><button type="button" id="btnForgot" name="btnForgot">Forgot Your Password</button></div>
            <!--<div class="input_box" id="div_forgotPwd"><input class="input" name="pwdRecEmail" id="pwdRecEmail" type="text" value="email address" onFocus="if(value=='email address'){value=''; }" onBlur="if(value==''){value='email address'; }" onClick="if(value=='email address'){value='';}" /> 
            <input name="ForgotPasswordForm" id="ForgotPasswordForm" class="button" type="submit" value="Submit"/></div>-->
            <div id="div_forgotPwd"><?php include('forgotPassword.php');?></div>
  	  </div>
        	<div id="errbox"></div>
	</nav>
</header>

<section id="LargeVideo" class="home_video_box">
        <div class="home_video" id="div_video">
        <iframe id="div_youTube" width="960" height="540" src="<?php echo $videoSrc;?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="home_des">
          <div class="title"><?php echo $iframeVideoPostInfo['video_name']?></div>
          <div class="username">Posted by : <?php echo $iframeVideoPostInfo['full_name']?></div>
        </div>
        <?php if($showBar){?>
            <div class="like_bar">
                <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
                <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
            </div>
         <?php }?>
	</section>
<div class="bot_bar" id="smVideo">
    <?php while($videoPostInfo = mysql_fetch_array($videoPostRes)){
		$thumbImgPath = '';
		if($videoPostInfo['video_type']=="youtube"){
			$thumbImgPath = "http://img.youtube.com/vi/".$videoPostInfo['video_object']."/1.jpg";
		}else{
			$vimeoInfo = vimeoVideoDetails($videoPostInfo['video_object']);
			$thumbImgPath = $vimeoInfo->thumbnail_medium;
		}	
	?>     
        <article class="thumb smallVideo" svId="<?php echo $videoPostInfo['video_id']?>"><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/>
      <div class="home_des_thumb">
        <div class="title"><?php echo $videoPostInfo['video_name']?></div>
        <div class="username"><?php echo $videoPostInfo['full_name']?></div>
      </div>
      <?php
	  	if($videoPostInfo['like'] != 0 OR $videoPostInfo['dislike'] !=0)
		{
			$up_value = $videoPostInfo['like'];
			$down_value = $videoPostInfo['dislike'];
			$total = $up_value + $down_value;
			$up_per = ($up_value*100)/$total; 
			$down_per = ($down_value*100)/$total;?> 
            <div class="like_bar2">
              <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
              <div class="like" style="width: <?php echo $up_per; ?>%;"></div>
            </div>
		<?php }?>
    </article>   
    <?php } ?>
    <?php
if ($_SESSION['shwsgnup'] == 1) {
?>
<script type="text/javascript">
    $(document).ready(

      function () {
          ShowSignup();
      }
    );
</script>
<?php
}
?>
</div>
<div class="footer">alacut | Terms of Use | Privacy Policty | advertising | 2012 Alacut</div>
</body>
</html>
