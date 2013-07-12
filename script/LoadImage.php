<?php
session_start();
include('../config/config1.php');
$member_id = $_SESSION['login_user_id'];

    if($_POST['imgdata'])
    {
        $FileName = uniqid().'.jpeg';
		$data = $_POST['imgdata']; 
		$content = preg_split("/[:,]/", $data);
		// $content[2]; 
		
		$file = $_SERVER['DOCUMENT_ROOT'].'/upload/imagePost/'.$FileName;
		$fp = fopen($file, 'w');
		fwrite($fp, base64_decode($content[2]));
		fclose($fp);
		
		
		$insetImage = "INSERT INTO `upload_image`(`img_upload_by`,`image_url`,`image_desc`) VALUES ('".$member_id."','".$FileName."','')";
		mysql_query($insetImage);
		echo '../upload/imagePost/'.$FileName;
    }
?>
