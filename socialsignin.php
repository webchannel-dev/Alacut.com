<?php
if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'facebook') {
        header("Location: script/socialsignin/facebook/login-facebook.php");
		exit();
    }
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

<link type="text/css" rel="stylesheet" href="css/colorbox.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui-1.8.15.custom.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<!-- Twitter Facebook Share-->
<meta name="description" content="Epic Trailer 2013 Movie - Official 2012 trailer in HD - Animated Adventure-Comedy starring Colin Farrell, Amanda Seyfried, Josh Hutcherson, and Beyonce Knowles - directed by Chris Wedge - a 3D CG movie that reveals a hidden world unlike any otherEpic movie hits theaters on May 17, 2013.EPIC tells the story of an ongoing battle deep in the forest between the forces of good and the forces of evil.  When a teen age girl finds herself magically transported into this secret universe, she must band together with a rag-tag team of fun and whimsical characters in order to save their world...and ours. Epic movie trailer 2013 is presented in full HD 1080p high resolution. EPIC 2013 MovieDirector: Chris WedgeWriters: Tom J. Astle, Matt EmberStars: Colin Farrell, Amanda Seyfried, Josh Hutcherson and Beyonce Knowles.Epic official movie trailer courtesy 20th Century Fox.Cieon Movies is your daily dose of everything movies, a mainstream channel with wider coverage from G-rated to R-rated movies and includes both theatrical and DVD releases, with an extended selection of officially licensed movie trailers and movie clips.Tags: epic trailer epic 2013 epic trailer 2013 official hd movie 2012 epic trailer 2013 epic trailer 2012 epic movie epic movie trailer epic 2013 movie epic 2013 trailer colin farrell amanda seyfried josh hutcherson beyonce knowles chris wedge colin farrell amanda seyfried hutcherson beyonce knowles chris wedge movies trailers film films today this week month year new official trailer movie trailer film trailer trailer 2013 trailer 2012"/>
<link rel="canonical" href="http://www.alacut.com/script/index.php" />

<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@alacut_"/>
<meta name="twitter:creator" content="@alacut_"/>
<meta name='twitter:image' content='http://i1.ytimg.com/vi/j6Nwdpa5PcU/mqdefault.jpg'/>
<meta name="twitter:description" content="Epic Trailer 2013 Movie - Official 2012 trailer in HD - Animated Adventure-Comedy starring Colin Farrell, Amanda Seyfried, Josh Hutcherson, and Beyonce Knowles - directed by Chris Wedge - a 3D CG movie that reveals a hidden world unlike any otherEpic movie hits theaters on May 17, 2013.EPIC tells the story of an ongoing battle deep in the forest between the forces of good and the forces of evil.  When a teen age girl finds herself magically transported into this secret universe, she must band together with a rag-tag team of fun and whimsical characters in order to save their world...and ours. Epic movie trailer 2013 is presented in full HD 1080p high resolution. EPIC 2013 MovieDirector: Chris WedgeWriters: Tom J. Astle, Matt EmberStars: Colin Farrell, Amanda Seyfried, Josh Hutcherson and Beyonce Knowles.Epic official movie trailer courtesy 20th Century Fox.Cieon Movies is your daily dose of everything movies, a mainstream channel with wider coverage from G-rated to R-rated movies and includes both theatrical and DVD releases, with an extended selection of officially licensed movie trailers and movie clips.Tags: epic trailer epic 2013 epic trailer 2013 official hd movie 2012 epic trailer 2013 epic trailer 2012 epic movie epic movie trailer epic 2013 movie epic 2013 trailer colin farrell amanda seyfried josh hutcherson beyonce knowles chris wedge colin farrell amanda seyfried hutcherson beyonce knowles chris wedge movies trailers film films today this week month year new official trailer movie trailer film trailer trailer 2013 trailer 2012"/>
<meta name="twitter:title" content="EPIC Trailer 2013"/>
<meta name="twitter:url" content="http://www.alacut.com/script/index.php"/>

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
        
        $("#txtPwd").keypress(function(e) { // start enter click
	        if (e.which === 13) {
	            $("#btnLogin").click();
	        }
	    });
    });

    function GetLargeVideo() {
        $(".smallVideo").each(function () {
            var svID = $(this).attr("svId");

            $(this).click(function () {
                $('#LargeVideo').html("<div style='padding-left:300px;padding-top:280px;'><img src='ajax-loader.gif' alt='Loading...' width='300' /></div>");
				$.ajax({
                    type: "POST",
                    url: 'script/ajax/indexLargeVideo.php',
                    data: 'svId=' + svID,
                    success: function (data) {
                        $("#LargeVideo").html(data);
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
            url: 'script/ajax/indexSmallVideo.php',
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
    </script>
</head>
<body>
	
<div class="wrapper">
	<header class="top_bar">
  	<div class="logo"><a href="index.php"><img src="images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search" id="loading">
  <a name="btnSearch" id="btnSearch" class="button popup" ><input type="submit" name="btnFriendSearch" id="btnFriendSearch" value="1" style="visibility:hidden"/></a>
   <input type="text" id="txtFriendSearch"  name="txtFriendSearch"  class="input" />
    </div>
    <div id="search" style="margin-left: 50px; position: absolute; top: 45px; z-index: 9999999999; border: 1px solid #333; background: #666;display:none;">
	</div>
    	<nav id="login" class="login"><a href="javascript:void(0);" class="VisibleLogin" id="login-trigger">Login</a>
	<div id="login-content">
        <form id="signup_form" action="index.php" method="POST">	
    	<div class="login_sn">
            <div class="user_img"><img src='upload/profilePhotos/no-image.jpg' width="150" height="150" alt=''/></div>
              <div class="input_box">
                <input class="input2" id="signEmail" name="signEmail" type="text" value="email address" onfocus="if(value=='email address'){value=''; }" onblur="if(value==''){value='email address'; }" onclick="if(value=='email address'){value='';}" />
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
            
            <input class="button" type="button" name="btnLogin" id="btnLogin" tabindex="3" value="Login" onClick="return validatlogin();"/></div>
            
        	<div class="input_box" id="div_Pwd">
                <input class="input" name="txtPwd" id="txtPwd" type="password" tabindex="2" value="password" onFocus="if(value=='password'){value=''; }" 
                onblur="if(value==''){value='password'; }" onClick="if(value=='password'){value='';}" />
                <input class="button" name="btnSignup"  id="btnSignup" value="Sign Up" style="width: 50px;"/>
            </div>
            </form>         
        	<div class="input_box2"><button type="button" id="btnForgot" name="btnForgot">Forgot Your Password</button></div>
            <div id="div_forgotPwd"><form method="post" action="/script/index.php">
<div class="input_box" id="div_forgotPwd"><input type="text" title="Please enter your email address" name="email_address" class="input"/>
<input type="submit" value="Submit" class="button"/></div>
</form>

 </div>
  	  </div>
        	<div id="errbox"></div>
    	</div>
	</nav>  
    </header>

<section id="LargeVideo" class="home_video_box">
        <div class="home_video" id="div_video">
        <iframe id="div_youTube" width="960" height="540" src="http://www.youtube.com/embed/j6Nwdpa5PcU" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="home_des">
          <div class="title">EPIC Trailer 2013</div>
          <div class="username">Posted by : user03</div>
        </div>
                    <div class="like_bar">
                <div class="dislike" style="width:33.333333333333%;"></div>
                <div class="like" style="width:66.666666666667%;"></div>
            </div>
         	</section>
<div class="bot_bar" id="smVideo">
         
        <article class="thumb smallVideo" svId="32" ><img  class="video" src="http://i1.ytimg.com/vi/xTSxYvOaJXc/mqdefault.jpg" width="140" height="74" data="" videoType = "youtube" vidid = "32"/>
      <div class="home_des_thumb">
        <div class="title" title="The Chipettes- Tik Tok">The Chipettes- Tik Tok</div>
        <div class="username">usertwo</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:0%;"></div>
              <div class="like" style="width: 100%;"></div>
            </div>
		    </article>   
         
        <article class="thumb smallVideo" svId="41" ><img  class="video" src="http://i1.ytimg.com/vi/2jtOBWSko_E/mqdefault.jpg" width="140" height="74" data="" videoType = "youtube" vidid = "41"/>
      <div class="home_des_thumb">
        <div class="title" title="Tendulkar\'s Reply To Sreesanth">Tendulkar\'s Reply To...</div>
        <div class="username">usertwo</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:0%;"></div>
              <div class="like" style="width: 100%;"></div>
            </div>
		    </article>   
         
        <article class="thumb smallVideo" svId="4" ><img  class="video" src="http://b.vimeocdn.com/ts/392/307/392307658_200.jpg" width="140" height="74" data="" videoType = "vimeo" vidid = "4"/>
      <div class="home_des_thumb">
        <div class="title" title="2012 BIFA  // 15 Years">2012 BIFA  // 15 Years</div>
        <div class="username">usertwo</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:0%;"></div>
              <div class="like" style="width: 100%;"></div>
            </div>
		    </article>   
         
        <article class="thumb smallVideo" svId="7" ><img  class="video" src="http://i1.ytimg.com/vi/iGng9NLo37Y/mqdefault.jpg" width="140" height="74" data="" videoType = "youtube" vidid = "7"/>
      <div class="home_des_thumb">
        <div class="title" title="Skyfall Official Trailer #2 (2">Skyfall Official Trai...</div>
        <div class="username">usertwo</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:50%;"></div>
              <div class="like" style="width: 50%;"></div>
            </div>
		    </article>   
         
        <article class="thumb smallVideo" svId="14" ><img  class="video" src="http://i1.ytimg.com/vi/vGpjlfCfe2Y/mqdefault.jpg" width="140" height="74" data="" videoType = "youtube" vidid = "14"/>
      <div class="home_des_thumb">
        <div class="title" title="Oblivion Trailer (2013)">Oblivion Trailer (2013)</div>
        <div class="username">user04</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:60%;"></div>
              <div class="like" style="width: 40%;"></div>
            </div>
		    </article>   
         
        <article class="thumb smallVideo" svId="22" style="margin:0;"><img  class="video" src="http://i1.ytimg.com/vi/tyTRR2vT0Qk/mqdefault.jpg" width="140" height="74" data="" videoType = "youtube" vidid = "22"/>
      <div class="home_des_thumb">
        <div class="title" title="Tata Manza -  A class apart">Tata Manza -  A class...</div>
        <div class="username">user04</div>
      </div>
       
            <div class="like_bar2">
              <div class="dislike" style="width:50%;"></div>
              <div class="like" style="width: 50%;"></div>
            </div>
		    </article>   
        

</div>
<div class="footer"><a href="#">alacut</a> | <a href="#">Terms of Use</a> | <a href="#">Privacy Policty</a> | <a href="#">advertising</a></div>
</body>
</html>
