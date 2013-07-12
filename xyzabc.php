

    <?php
    //The Youtube's API url
    include('ThumbImage.php');
    $directory = $_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'; 
	//get all text files with a .txt extension.
	$texts = glob($directory . "*.jpeg");
	//print each file name
	
	foreach($texts as $text)
	{
		//echo $text.'='.strrev(substr(strrev($text),0,strpos(strrev($text), '/'))).'<br>';
	    CreateThumb_90($text,strrev(substr(strrev($text),0,strpos(strrev($text), '/'))),$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/thumb/t_90/');
		CreateThumb_40($text,strrev(substr(strrev($text),0,strpos(strrev($text), '/'))),$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/thumb/t_40/');
		CreateProfileThumb($text,strrev(substr(strrev($text),0,strpos(strrev($text), '/'))),$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/');
	}
	echo '<h1>Done</h1>';
?>

