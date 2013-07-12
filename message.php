<?php
session_start();
include('config/config1.php');

$user_check = $_SESSION['login_user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<div id="lightbox_form" style="width: 650px;">
    <div class="form_bg">
    	<div class="padT">
        	<div class="form_header">Message</div>
        </div>
        <form id="message" name="message" method="POST" action="otherUserProfile.php?id=<?php echo $_REQUEST['id']?>">
        <div class="form_pad">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Message content</strong>: </td>
                <td>
                	<textarea id="txtContent" name="txtContent" style="height:100px; width:340px;"></textarea>
                </td>
                <td class="status">&nbsp;</td>
              </tr>
            </table>
            <div class="form_sbmt"><input type="submit" id="btnSend" name="btnSend" class="search_sbmt" value="Send" /></div>
			<div class="clear"></div>
        </div>
        </form>
    </div>
    <div class="clear"></div>
</div>