<?php
  
//Image Storage Directory
function CreateThumb_40($srcpath,$fileName,$trgtpath)
{
	$img_dir=$trgtpath;
	
	$img = explode('.', $fileName);
	
	//Original File
	$originalImage=$srcpath;
	//Thumbnail file name File
	$image_filePath=$srcpath;
	$img_fileName=$fileName;
	$img_thumb = $img_dir . $img_fileName;
	$extension = strtolower($img[1]);
	
	//Check the file format before upload
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp'))){
	
		//Find the height and width of the image
		$newwidth=40;
		$newheight=40;
		//---------- To create thumbnail of image---------------
		if($extension=="jpg" || $extension=="jpeg" ){
		$src = imagecreatefromjpeg($srcpath);
		}
		else if($extension=="png"){
		$src = imagecreatefrompng($srcpath);
		}
		else{
		$src = imagecreatefromgif($srcpath);
		}
		list($width,$height)=getimagesize($srcpath);
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		
		//Create thumbnail image
		$createImageSave=imagejpeg($tmp,$img_thumb,100);
		
		
	}
	
}
function CreateProfileThumb($srcpath,$fileName,$trgtpath)
{
	$img_dir=$trgtpath;
	
	$img = explode('.', $fileName);
	//Original File
	$originalImage=$srcpath;
	//Thumbnail file name File
	$image_filePath=$srcpath;
	$img_fileName=$fileName;
	$img_thumb = $img_dir . $img_fileName;
	$extension = strtolower($img[1]);
	
	//Check the file format before upload
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp'))){
	
		//Find the height and width of the image
		$newwidth=300;
		$newheight=300;
		//---------- To create thumbnail of image---------------
		if($extension=="jpg" || $extension=="jpeg" ){
		$src = imagecreatefromjpeg($srcpath);
		}
		else if($extension=="png"){
		$src = imagecreatefrompng($srcpath);
		}
		else{
		$src = imagecreatefromgif($srcpath);
		}
		list($width,$height)=getimagesize($srcpath);
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		//Create thumbnail image
		$createImageSave=imagejpeg($tmp,$img_thumb,100);
		
		
	}
	
}
function CreateThumb_90($srcpath,$fileName,$trgtpath)
{
	$img_dir=$trgtpath;
	
	$img = explode('.', $fileName);
	
	//Original File
	$originalImage=$srcpath;
	//Thumbnail file name File
	$image_filePath=$srcpath;
	$img_fileName=$fileName;
	$img_thumb = $img_dir . $img_fileName;
	$extension = strtolower($img[1]);
	
	//Check the file format before upload
	if(in_array($extension , array('jpg','jpeg', 'gif', 'png', 'bmp'))){
	
		//Find the height and width of the image
		$newwidth=90;
		$newheight=90;
		//---------- To create thumbnail of image---------------
		if($extension=="jpg" || $extension=="jpeg" ){
		$src = imagecreatefromjpeg($srcpath);
		}
		else if($extension=="png"){
		$src = imagecreatefrompng($srcpath);
		}
		else{
		$src = imagecreatefromgif($srcpath);
		}
		list($width,$height)=getimagesize($srcpath);
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		
		//Create thumbnail image
		$createImageSave=imagejpeg($tmp,$img_thumb,100);
		
		
	}
	
}
if(isset($_REQUEST['img']))
{
CreateThumb_90($_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'.$_REQUEST['img'],$_REQUEST['img'],$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/thumb/t_90/');
CreateThumb_40($_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'.$_REQUEST['img'],$_REQUEST['img'],$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/thumb/t_40/');
CreateProfileThumb($_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/'.$_REQUEST['img'],$_REQUEST['img'],$_SERVER["DOCUMENT_ROOT"].'/upload/profilePhotos/');
}
?>