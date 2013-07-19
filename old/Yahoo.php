<?php
/*
 * AddressBookImport.com is a PHP-Yahoo gateway. It will allow you to
 * retrieve your contacts from Yahoo Server using PHP and cURL Libraries.
 *
 * Created by: AddressBookImport.com <info@addressbookimport.com>, November 01, 2005
 *
 * This program is trial version of this script. The script can be purchased at
 * www.AddressBookImport.com
 */


$sMessage = '
join me @ the new virtual community @ mydomainname.com.<br>
create your free custom profile with unlimited pictures,<br>
rate other members, message other members, watch music videos,<br>
listen to online radio streams and more.<br>
Register today FREE @ www.mydomianname.com<br>
';

$sSubject = "Join me at alacut.com";
$sFromEmailName = "alacut.com";
$sFromEmail = "admin@alacut.com";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="AddressBookImport.com">
<head>
<title>Yahoo Address Book Import Script - AddressBookImport - Address Book Import Script for Yahoo, Hotmail, Gmail, AOL and more</title>
<meta name="keywords" content="AddressBookImport, addressbook, import, script, grabber, addressbook grabber, addressbook import script, php, curl" />
<meta name="description" content="AddressBookImport - Address Book Import Script for Yahoo, Hotmail, Gmail, AOL and more" />
<meta name="author" content="AddressBookImport.com" />
</head>
<body bgcolor=#FFFFFF leftmargin=0 topmargin=5 marginwidth=0 marginheight=0>
<br>
<h3 align=center>Yahoo! AddressBookImport Script - www.AddressBookImport.com</h3><hr size=1><br>

	<table border=0 cellspacing=0 cellpadding=1 width="50%" align=center>
	<form method="post" action="<?php $_SERVER['SCRIPT_NAME']; ?>">
	<tr>
	 <td width="120"><img src="http://www.AddressBookImport.com/images/invite/yahoo.gif"></td>
	 <td>Yahoo! Email Address:<br /><input type="text" class="form1" name="emailaddress"></td>
	 <td>Yahoo! Password:<br /><input type="password" class="form1" name="password"></td><td><br /><input type="submit" class="form1" value="Submit"></td>
	</tr>
	</form>
	</table>
<div align=center>
<?php
if ($_SERVER["CONTENT_LENGTH"] > 0)
{
    $sAction = fnGet("action");

    if ($sAction == "sendemails")
    {
        // Send the Email Addresses
    	$num = fnGet("i");
	    $sEmailAddress = fnGet("fromname");

	    for ($i=0; $i < $num; $i++)
	    {
		    $sName = fnGet("name" . $i);
		    $sEmail = fnGet("email" . $i);
		    $sCheck = fnGet("check" . $i);

    		if ($sCheck == "on")
	    	{
          		$headers  = 'MIME-Version: 1.0' . "\r\n";
          		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

          		// Additional headers
          		$headers .= 'To: ' . $sName . ' <' . $sEmail . '>' . "\r\n";
          		$headers .= 'From: ' . $sFromEmailName . ' <' . $sFromEmail . '>' . "\r\n";

        		// Mail it
        		$bMailReturn = mail($sEmail, $sSubject, $sMessage, $headers);
        		if ($bMailReturn == true)
        			print('Message sent to ' . $sEmail . '<br>');
		    }
	    }
    }
    else
    {
        $varURL = "http://www.AddressBookImport.com/trial/";

        $params = "service=Yahoo&emailaddress=" . fnGet("emailaddress") . "&password=" . fnGet("password");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL,$varURL);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $content = curl_exec ($ch);

        if (strpos($content, "~Invalid Login~") !== false)
  		    print('<br><br><div align=center>... INVALID LOGIN ...</div>');
  	    else
  	    {
  	        print('
                <form method="post" action="yahoo.php">
                <div align=center><br><br>Select the Contacts you want to send invite to:<br/></div>
                <table border=0 cellspacing=0 cellpadding=3 width="40%" align=center>');

            $content = str_replace('<!-- -->', '', $content);

            $sList = explode("\n", $content);

            for ($i=0; $i < count($sList)-1; $i++)
            {
                $sList2 = explode(",", $sList[$i]);
                print('<tr><td width="10" align=center><input type="checkbox" id="check' . $i . '" name="check' . $i . '" checked></td><td><input type="text" size="30" name="name' . $i . '" value="' . $sList2[0] . '"></td><td><input type="text" size="30" name="email' . $i . '" value="' . $sList2[1] . '"></td></tr>');
            }
            print('
            </table>
            <br /><br />
            <div align=center><input type="submit" value="Send Invite"></div>
            <input type="hidden" name="action" value="sendemails">
            <input type="hidden" name="i" value="' . $i . '">
            <input type="hidden" name="fromname" value="' . fnGet("emailaddress") . '">
            </form>
            ');
        }
    }
}

function fnGet($varQuery, $varType = "AUTO")
{
    if ($varType == "AUTO")
    {
    	if (isset($_GET["$varQuery"]))
        {
    		return($_GET["$varQuery"]);
        }
    	elseif (isset($_POST["$varQuery"]))
        {
    		return($_POST["$varQuery"]);
        }
    }
    elseif ($varType == "GET")
    {
    	if (isset($_GET["$varQuery"]))
        {
    		return($_GET["$varQuery"]);
        }
    }
    elseif ($varType == "POST")
    {
    	if (isset($_POST["$varQuery"]))
        {
    		return($_POST["$varQuery"]);
        }
    }

    return("");
}
?>
</div>
</body>
</html>
