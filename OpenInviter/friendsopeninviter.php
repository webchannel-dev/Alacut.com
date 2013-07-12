<?php
include($_SERVER['DOCUMENT_ROOT']."/app.top.php");
include(INCLUDES_DIR."connection.php");
include(LIB_DIR."data_utility_class.php");
include(INCLUDES_DIR."secure.php");
$dbconnect = new DB_Sql();
$user_id=@$_SESSION['uid'];
$uid=@$_SESSION['uid'];

/* left link */
$sqlm=mysql_query("select avatar,lastlogin from gb_accounts where id='$user_id'");
$rowm=mysql_fetch_array($sqlm);
$avatarm=$rowm['avatar'];
$lastlogin=$rowm['lastlogin'];

if($avatarm=="")
{
$avatarm="undefined.jpg";
}
/* *********/



$user_type=@$_SESSION['user_type'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GyanBandhu </title>
<?php include($_SERVER['DOCUMENT_ROOT']."/form_css_js.php"); ?>
<script type="text/JavaScript">  
  
<!--  
function show(id)  
{  
     if (document.getElementById(id).style.display == 'none')  
     {  
          document.getElementById(id).style.display = '';  
     }  
}  
//-->  
  
<!--  
function hide(id)  
{  
          document.getElementById(id).style.display = 'none';  
  
}  
//-->  
</script> 
<link rel="stylesheet" type="text/css" href="../tcal.css" />
	<script type="text/javascript" src="../tcal.js"></script> 
	<style type="text/css">
	.red {
	color:#FF0000;
	font-weight:bold;
	font-size:10px;
	padding-right:3px;
	vertical-align:top;
	
	}
	</style>
</head>

<body>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php include(INCLUDES_DIR."header_profile.php"); ?>
  
  <tr>
    <td align="center" valign="top"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="980" border="0" cellspacing="0" cellpadding="0">
            			  <tr>
              <td align="left" valign="top" colspan="3" height="10"></td>

            </tr>
			<tr>
             <td align="left" valign="top" colspan="3" style="padding-left:10px;"><?php include("../usershowdata.php");?></td>          
            </tr>
			  <tr>
              <td align="left" valign="top" colspan="3" height="8"></td>

            </tr>
            <tr>
              <td width="180" align="left" valign="top"><?php include("../leftstudenlink.php"); ?></td>
              <td width="550" align="center" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
     
     
      <tr>
        
        
        <td width="310" align="center" valign="top">

		  <table width="520" border="0" cellpadding="0" cellspacing="0" id="contactform">
		 <tr>
    <td width="222" align="left"><h3>Open Inviter</h3></td>
	<td width="298"></td>
	</tr>
		 <tr>
		   <td align="left"><?php include("example.php");?></td>
		   <td></td>
		   </tr>
</table>
		</td></tr>
		
		</div>
          

      </table>
                            </td>
              <td width="250" align="left" valign="top"><?php include(INCLUDES_DIR."right_link.php"); ?></td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="center" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  
    <tr>
    <td height="2" align="center" valign="top"></td>
  </tr>
  
  <tr>
    <td height="40" align="center" valign="top"><?php include(INCLUDES_DIR."footer.php"); ?></td>
  </tr>
</table>
</body>



</html>
