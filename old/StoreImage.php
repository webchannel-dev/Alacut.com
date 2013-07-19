<?php

    class StoreImage
    {
    	
        function StoreTwitterImage($uri)
        {
	        $uri=str_replace("_normal","",$uri);
	
	        $ch = curl_init();
	        //$output_filename='/upload/profilePhotos/'.com_create_guid()."_profile.jpeg";
	        $output_filename=uniqid()."_profile.jpeg";
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_REFERER, "http://twimg0-a.akamaihd.net");
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $result = curl_exec($ch);
            curl_close($ch);

            // the following lines write the contents to a file in the same directory (provided permissions etc)
            $fp = fopen($_SERVER["DOCUMENT_ROOT"].'upload/profilePhotos/'.$output_filename, 'w');
	       // $fp = fopen('C:/wamp/www/alacut/upload/profilePhotos/'.$output_filename, 'w');
            fwrite($fp, $result);
            fclose($fp);
	        return $output_filename;
        }
        function StoreImageLinkedin($uri)
        {
	        
	        $ch = curl_init();
	        //$output_filename='/upload/profilePhotos/'.com_create_guid()."_profile.jpeg";
	        $output_filename=uniqid()."_profile.jpeg";
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_REFERER, "http://m3.licdn.com");
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $result = curl_exec($ch);
            curl_close($ch);

            // the following lines write the contents to a file in the same directory (provided permissions etc)
            $fp = fopen($_SERVER["DOCUMENT_ROOT"].'upload/profilePhotos/'.$output_filename, 'w');
	        
            fwrite($fp, $result);
            fclose($fp);
	        return $output_filename;
        }
    }

?>


