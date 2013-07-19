<?php 

?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico">
<title>alacut</title>
<script type="text/javascript">

$(document).ready(function(e) {
	$('#search').hide();
	$("form").keypress(function(e) {
	  //Enter key
	  if (e.which == 13) {
	    return false;
	  }
	});
});

function repetedSearch(e)
{
	var keyword=$("#txtFriendSearch").val();
	if(keyword.trim() != '' && e.keyCode != 27 )
	{
	//$("#loading").show();
	
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
</script>


<div class="top_bar" > 
<img src="indicator.gif" id="loading" style="position:absolute; display: none"/>
  	<div class="logo"><a href="./"><img src="images/logo.jpg" width="111" height="36" alt="alacut" /></a></div>
    <div class="home"><a href="home.php">Home</a></div>
    <div style="width: 220px; height: 36px;"></div>
    <div class="search" id="loading">
  <a name="btnSearch" id="btnSearch" class="button popup" ><input type="submit" name="btnFriendSearch" id="btnFriendSearch" value="1" style="visibility:hidden"/></a>
   <input type="text" id="txtFriendSearch" onkeyup="repetedSearch(event);"  name="txtFriendSearch"  class="input" />
    </div>
    <?php include('notification.php');?>
</div>
<div id="search" style="margin-left: 50px; position: absolute; top: 45px; z-index: 9999999999; border: 1px solid #333; background: #666;display:none;">
</div>