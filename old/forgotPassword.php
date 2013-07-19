<?php
session_start();  
$email_address = $_POST['email_address'];
if (!isset($_POST['email_address'])) {
?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div class="input_box" id="div_forgotPwd"><input type="text" title="Please enter your email address" name="email_address" class="input"/>
<input type="submit" value="Submit" class="button"/></div>
</form>

<?php
}
elseif (empty($email_address)) {
echo $empty_fields_message;
}
else {
	//include('config/config1.php');
	mysql_connect("mavajsunco.netfirmsmysql.com", "alacut", "123456789") or die(mysql_error());
	mysql_select_db("alacut")
	or die(mysql_error());
	
	$email_address = mysql_real_escape_string($email_address);
	$status = "OK";
	$msg="";

	if (!stristr($email_address,"@") OR !stristr($email_address,".")) 
	{
	$msg="<p>Your email address is not in the correct format.</p>Click <a class=\"two\" href=\"javascript:history.go(-1)\">here</a> to go back";
	$status= "NOTOK";}
	
	echo "";
	if($status=="OK"){ $query="SELECT email,full_name FROM alacut_member WHERE alacut_member.email = '$email_address'";
	$st=mysql_query($query);
	$recs=mysql_num_rows($st);
	$row=mysql_fetch_object($st);
	$em=$row->email_address;// email is stored to a variable
	if ($recs == 0) {
	echo "<p>Sorry your address is not there in our database. Please try again.</p>Click <a class=\"two\" href=\"javascript:history.go(-1)\">here</a> to go back";
	exit;
	}
//$random_password = makeRandomPassword();
//$db_password = md5($random_password);
$db_password = mysql_query("SELECT password FROM `alacut_member` WHERE email='".$email_address."'");
$passwordInfo = mysql_fetch_array($db_password);
$password = $passwordInfo['password'];

$subject = "Your Password";
$message = "Hello, you have chosen to retrieve your password.

Your Password: ".$password."

http://www.alacut.com/test/script/index.php

Thanks!
Site admin

This is an automated response, please do not reply!";

mail($email_address, $subject, $message, "From: admin@alacut.com\n");

echo "<p>Your password has been send! Please check your email!";
}
else {echo "$msg";}
}
?> 