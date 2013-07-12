<?php
session_start();
include('config/config1.php');
//print_r($_SESSION);
$member_id = $_SESSION['login_user_id'];
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: twitter/login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    }else if ($oauth_provider == 'linkedin') {
        header("Location: linkedin/linkedin-login.php");
    }
}

//video
$LargeVideoId = 0;
if(isset($_REQUEST['vid']) > 0){
	$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_name,u.like,u.dislike,a.member_id,a.full_name,u.video_desc,u.video_image
	FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id  
	WHERE u.status!='2' AND u.video_id = ".$_REQUEST['vid'];
}else{
	$iframeVideoPostQry = "SELECT u.video_id,u.video_object,u.video_type,u.video_name,u.like,u.dislike,a.member_id,a.full_name,u.video_desc,u.video_image
	FROM `upload_video` u INNER JOIN `alacut_member` a ON u.video_upload_by = a.member_id WHERE u.status!='2'  ORDER BY u.`visit` DESC,u.`like` DESC LIMIT 1";
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
     $desc = $iframeVideoPostInfo['video_desc'];//$vimeoDetails->description;
	$description = str_replace(array("'", "<br/>","<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "","", "", "", "", "",""),$desc);
	$title = str_replace(array("'", "<br/>","<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "","", "", "", "", "",""),$iframeVideoPostInfo['video_name']);;//$vimeoDetails->title;
	 if($iframeVideoPostInfo['video_type'] == "youtube"){
			$videoSrc = "http://www.youtube.com/embed/" . $iframeVideoPostInfo['video_object'];
	 }else if($iframeVideoPostInfo['video_type'] == "vimeo"){
		 $videoSrc = "http://player.vimeo.com/video/" . $iframeVideoPostInfo['video_object'];
	 }

	$videoPostQry = "SELECT u.video_id,u.video_upload_by,u.video_object,u.video_name,u.video_image,u.video_type,u.like,u.dislike,a.full_name 
	FROM `upload_video` u INNER JOIN `alacut_member` a ON a.member_id = u.video_upload_by 
	WHERE u.status!= '2'  AND u.video_id != '".$iframeVideoPostInfo['video_id']."' ORDER BY u.`visit` DESC,u.`like` DESC LIMIT 6";
	$videoPostRes = mysql_query($videoPostQry);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>alacut</title>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="http://universal-ie6-css.googlecode.com/files/ie6.1.1.css" media="screen, projection">
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<?php if(!$member_id){?>
	<link rel="shortcut icon" href="images/favicon.ico">
	<?php } ?>
<link type="text/css" rel="stylesheet" href="css/colorbox.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui-1.8.15.custom.css" />
<!--<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<!-- Twitter Facebook Share-->
<meta name="description" content="<?php echo $description;?>"/>
<link rel="canonical" href="http://www.alacut.com" />
<link rel="image_src" href="<?php echo $iframeVideoPostInfo['video_image']; ?>" / >
<meta property="og:image" content="<?php echo $iframeVideoPostInfo['video_image']; ?>" />
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@alacut_"/>
<meta name="twitter:creator" content="@alacut_"/>
<meta name='twitter:image' content='<?php echo $iframeVideoPostInfo['video_image']; ?>'/>
<meta name="twitter:description" content="<?php echo $description;?>"/>
<meta name="twitter:title" content="<?php echo $title;?>"/>
<meta name="twitter:url" content="http://www.alacut.com"/>

<!--End-->
<script type="text/javascript">
    $(document).ready(function () {
		$('#search').hide();
		
        $(".VisibleLogin").click(function () {
            $("#div_Name").hide();
            $("#btnLogin").show();
            $("#div_button").hide();
            $("#div_forgotPwd").hide();
            $(".login_sn").hide();
            $("#Log-In").show();
            $('#errbox').hide();
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
            $('#errbox').hide();
            return false;
        });

        $('#login-trigger').click(function () {
            $(this).next('#login-content').slideToggle();
            $(this).toggleClass('active');

            if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
        });
		$("#txtPwd").keypress(function(e) { // start enter click
         if (e.which === 13) {
             $("#btnLogin").click();
         }
     });
     $("#txtEmail").keypress(function(e) { // start enter click
         if (e.which === 13) {
             $("#btnLogin").click();
         }
     });
        GetLargeVideo();
    });

    function GetLargeVideo() {
        $(".smallVideo").each(function () {
            var svID = $(this).attr("svId");

            $(this).click(function () {
                $('#LargeVideo').html("<div style='padding-left:300px;padding-top:280px;'><img src='ajax-loader.gif' alt='Loading...' width='300' /></div>");
				//$("#load").show();
                $.ajax({
                    type: "POST",
                    url: 'ajax/indexLargeVideo.php',
                    data: 'svId=' + svID,
                    success: function (data) {
                        $("#LargeVideo").html(data);
                        //$("#load").hide();
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
		$('#smVideo').html("<div style='padding-left:350px;padding-top:10px;'><img src='ajax-loader.gif' alt='Loading...' /></div>");
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
        var signupname = $('#signUname').val();
        
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
            msg = '<div class="wrong_pass">You have entered an invalid E-mail id !!</div>';
        }
        else if (pwd == "password" || pwd == "") {
            msg = '<div class="wrong_pass">Please Enter Password!!</div>';
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
					CheckEmail(email,pwd,signupname);
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
	
    function CheckEmail(email,pwd,signupname) {
        $.ajax({
            url: 'validate/CheckEmail.php',
            type: 'POST',
			data: 'email='+email+'&pwd='+pwd+'&signupname='+signupname,
            success: function (msg) {
				if(msg == "0"){
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
            url: 'validate/CheckLogin.php?email='+ email+'&pwd='+pwd,
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
    <?php if(isset($member_id) && $member_id!=0 && !empty($member_id)){?>
	function repetedSearch(e)
	{
		var keyword=$("#txtFriendSearch").val();
		if(keyword.trim() != '' && e.keyCode != 27)
		{
		//$("#loading").show();
		$('#search').html("<div style='padding: 20px 100px;'><img src='ajax-loader.gif' alt='Loading...' /></div>");
			$.ajax({
				type: "POST",
				url: 'Search.php',
				data: 'keyword='+keyword,
				success: function(data) {
					//$("#loading").hide();
					$('#search').show();
					$('#search').html(data);
				},
				error: function(e) {
					alert("Error");
				}
			});	
		}
	else
		{
			$('#search').html('');
			$('#search').hide();
		}
	}
	<?php } ?>
</script>
</head>
<body>
	
<div class="wrapper">
	<header class="top_bar">
     <?php if(!$member_id)  {?>
    <!--<img src="ajax-loader.gif" id="loading" style="position:absolute; display: none"/>-->
  	<div class="logo"><a href="./"><img src="images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <!--<div class="home"><a href="home.php">Home</a></div>-->
    <div style="width: 220px; height: 36px;"></div>
    <div class="search" id="loading">
  <a name="btnSearch" id="btnSearch" class="button popup" ><input type="submit" name="btnFriendSearch" id="btnFriendSearch" value="1" style="visibility:hidden"/></a>
   <input type="text" id="txtFriendSearch" <?php if(isset($member_id) && $member_id!=0 && !empty($member_id)) echo 'onkeyup="repetedSearch(event);"';?> name="txtFriendSearch"  class="input" />
    </div>
    <div id="search" style="margin-left: 50px; position: absolute; top: 45px; z-index: 9999999999; border: 1px solid #333; background: #666;display:none;">
	</div>
    <?php } ?>
	<!--<div class="logo"><a href="index.php"><img src="images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="home.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search">
  <a name="btnSearch" id="btnSearch" class="button popup" ><input type="submit" name="btnFriendSearch" id="btnFriendSearch" value="1" style="visibility:hidden"/></a>
   <input type="text" id="txtFriendSearch" name="txtFriendSearch"  class="input" />
    </div>--> 
    <?php if(!$member_id)  {?>
	<nav id="login" class="login"><a href="javascript:void(0);" class="VisibleLogin" id="login-trigger">Login</a>
	<div id="login-content">
        <form id="signup_form" action="index.php" method="POST">	
    	<div class="login_sn">
            <div class="user_img"><img src='upload/profilePhotos/<?php if($_SESSION['shwsgnup'] == 1 && isset($_SESSION['usernamePhoto'])){echo $_SESSION['usernamePhoto'];} else{ echo "no-image.jpg";}?>' width="150" height="150" alt=''/></div>
              <div class="input_box">
                <input class="input2" id="signEmail" name="signEmail" type="text" value='<?php if($_SESSION['shwsgnup'] == 1 && isset($_SESSION['email'])){echo $_SESSION['email'];} else{ echo "email address";} ?>' onfocus="if(value=='email address'){value=''; }" onblur="if(value==''){value='email address'; }" onclick="if(value=='email address'){value='';}" />
                <input class="input2" id="signPwd" name="signPwd" type="password" value="password" onfocus="if(value=='password'){value=''; }" onblur="if(value==''){value='password'; }" onclick="if(value=='password'){value='';}" />
                <input class="input2" id="signUname" name="signUname" type="text" value="username" onfocus="if(value=='username'){value=''; }" onblur="if(value==''){value='username'; }" onclick="if(value=='username'){value='';}" />
          </div>
              <div class="button_box"><input class="button2" name="signUp" type="button" value="Sign Up" onClick="return ValidateForm();"/></div>
        </div>
        </form>   
		<div class="login" id="Log-In" name="Log-In" >
            <div class="sn_but"><a href="?login&oauth_provider=twitter"><img src="images/twitter.gif" width="150" height="22" alt="twitter" /></a></div>
            <div class="sn_but"><a href="?login&oauth_provider=facebook"><img src="images/facebook.gif" width="150" height="22" alt="facebook" /></a></div>
            <div class="sn_but"><a href="?login&oauth_provider=linkedin"><img src="images/in.gif" width="150" height="22" /></a></div>
            <form  name="Login" method="post" action="" >        
            <div class="input_box" id="div_Email">
            <input class="input" name="txtEmail" id="txtEmail" type="text" tabindex="1" value="email address" onFocus="if(value=='email address'){value=''; }"  onBlur="if(value==''){value='email address'; }" onClick="if(value=='email address'){value='';}" />
            
            <input class="button" type="button" name="btnLogin" id="btnLogin" value="Login" tabindex="3" onClick="return validatlogin();"/></div>
            
        	<div class="input_box" id="div_Pwd">
                <input class="input" name="txtPwd" id="txtPwd" type="password" tabindex="2" value="password" onFocus="if(value=='password'){value=''; }" 
                onblur="if(value==''){value='password'; }" onClick="if(value=='password'){value='';}" />
                <input class="button" name="btnSignup"  id="btnSignup" value="Sign Up" style="width: 50px;"/>
            </div>
            </form>         
        	<div class="input_box2"><button type="button" id="btnForgot" name="btnForgot">Forgot Your Password</button></div>
            <div id="div_forgotPwd"><?php include('forgotPassword.php');?></div>
  	  </div>
        	<div id="errbox"></div>
    	</div>
	</nav>  
    <?php } else {
		include("header.php");
	} ?>
</header>

<section id="LargeVideo" class="home_video_box">
        <div class="home_video" id="div_video">
        <!--<img src="bigLoader.gif" id="load" style="position:absolute; display: none"/>-->
        <iframe id="div_youTube" width="960" height="540" src="<?php echo $videoSrc;?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="home_des">
          <div class="title"><?php if (strlen($iframeVideoPostInfo['video_name']) > 24) {echo $iframeVideoPostInfo['video_name']= substr($iframeVideoPostInfo['video_name'], 0, 21) . '...';}else{echo $iframeVideoPostInfo['video_name'];}?></div>
          <div class="username">Posted by : <?php echo $iframeVideoPostInfo['full_name']?></div>
        </div>
       <div class="like_bar">
            <div class="dislike" style="width:<?php echo $down_per; ?>%;"></div>
            <div class="like" style="width:<?php echo $up_per; ?>%;"></div>
        </div>
         
	</section>
<div class="bot_bar" id="smVideo">
    <?php 
		$req=1;
		while($videoPostInfo = mysql_fetch_array($videoPostRes)){
		$thumbImgPath = $videoPostInfo['video_image'];
			$title = str_replace(array("'", "<br/>", "<br />", "\r", "\r\n", "\n","\""),array("\'", "", "", "", "", "",""),$videoPostInfo['video_name']);
	?>     
        <article class="thumb smallVideo" svId="<?php echo $videoPostInfo['video_id']?>" <?php if($req%6==0) echo('style="margin:0;"');$req++;?>><img  class="video" src="<?php echo $thumbImgPath;?>" width="140" height="74" data="<?php echo $mostLikeVideoInfo['video_object']?>" videoType = "<?php echo $videoPostInfo['video_type'] ?>" vidid = "<?php echo $videoPostInfo['video_id']?>"/>
      <div class="home_des_thumb">
        <div class="title" title="<?php echo $title;?>"><?php if (strlen($title) > 24) {echo substr($title, 0, 21) . '...';}else{echo $title;}?></div>
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
		<?php } else {?>
			<div class="like_bar2"></div>
			<?php } ?>
    </article>   
    <?php } ?>
    <?php
    
if ($_SESSION['shwsgnup'] == 1) {
	
?>
<script type="text/javascript">
    $("#login-content").show();
        $(".login_sn").show();
        $("#Log-In").hide();
</script>
<?php
}
?>


</div>
	<div class="footer">
		<a href="about.php">alacut</a> | 
		<a href="termsofuse.php">Terms of Use</a> | 
		<a href="policy.php">Privacy Policty</a> | 
		<a href="advertise.php">advertising</a> 
	</div> 
</div>
</body>
</html>
