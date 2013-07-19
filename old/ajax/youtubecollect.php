<?php

include('../config/config1.php');
$sqlquery="SELECT video_id,video_object from `upload_video` WHERE `video_type`='youtube' AND (video_name IS NULL OR video_name='')";
$result=mysql_query($sqlquery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<script type="text/javascript"> 
var id=0;
	var obj="";
$(document).ready(function() {
	
  $('.you').click(function(){
  	id=$(this).attr("data");
  	obj=$(this).attr("obj");
  	getYouTubeDetails($(this).attr("obj"));  	
  });
});
function getYouTubeDetails(videoid){     
	
	$.getScript('http://gdata.youtube.com/feeds/api/videos/' + encodeURIComponent(videoid) + '?v=2&alt=json-in-script&callback=youtubeDataCallback');
}
function refineString(value)
{
	var delim="\\'";
	return value.replace(/\'/g,delim).replace(/&/g,'');
}
function youtubeDataCallback(data) 
{
	var odesc = data.entry.media$group.media$description.$t.replace(/\n/g, '<br/>');
	var otit = data.entry.title.$t;
	var sec = data.entry.media$group.yt$duration.seconds;
	desc=refineString(odesc);
	tit=refineString(otit);
	//alert(id+"-"+obj);
	UploadVideoToDb(obj,id,desc,tit);
}
function UploadVideoToDb(object,id,desc,tit)
{
	$.ajax({
			type: "POST",
			dataType: 'json',
			url: 'updateYoutube.php',
			data: 'id='+id+'&object='+object+'&desc='+desc+'&title='+tit,
			success: function(data) {
				id=0;
				obj="";
			}
	});
}
</script>
</head>
<body>
	<?php 
	while($resultArr = mysql_fetch_array($result)) { 
	echo "<div class='you' data='".$resultArr['video_id']."' obj='".$resultArr['video_object']."'>youtube</div>";
}
	?>
</body>
</html>