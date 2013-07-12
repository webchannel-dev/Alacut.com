<?php
    if($_POST['imgdata'])
    {
        $FileName = uniqid().'.jpeg';
        $data = $_POST['imgdata']; 
        $content = preg_split("/[:,]/", $data);
        // $content[2]; 
        file_put_contents('c:/wamp/www/alacut/upload/'.$FileName, base64_decode($content[2]));
        echo '../upload/'.$FileName;
    }
?>

