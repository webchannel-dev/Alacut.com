<?php
include "config.php";
$total=$_POST['total'];
$subject=$_POST['subject'];
$msg=$_POST['msg'];
$msg = str_replace( array("\n","\r","\r\n"), '<br />', $msg );
for($i=0;$i<=$total;$i++)
{
 if($_POST[$i] != "")
   {
   
	$emailid=$_POST[$i];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= $mailheader . "\r\n";
	 mail($emailid,$subject,$msg,$headers);
   }
   }
   header('location:'.$redirectpage);
   ?>