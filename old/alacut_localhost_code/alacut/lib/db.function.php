<?php	
	//Vimeo video Description
	 function vimeoVideoDetails($vObj)
	 {	
	 	$vimeoObject = new stdClass;
		$url = "http://vimeo.com/api/v2/video/".$vObj.".php";
	 	
		$ch = curl_init();
	    $output_filename=$iframeVidObject.".php";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, "http://vimeo.com");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
	    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/alacut/upload/videoDetails/'.$output_filename, 'w'); 
        fwrite($fp, $result);
        fclose($fp);	
		
		$vimeoFile = unserialize($result); 
		$vimeoArray = $vimeoFile[0];
		//print_r($vimeoArray);
		$vimeoObject->id=$vimeoArray['id'];
		$vimeoObject->title=$vimeoArray['title'];
		$vimeoObject->description=$vimeoArray['description'];
		$vimeoObject->thumbnail_medium=$vimeoArray['thumbnail_medium'];
		$vimeoObject->duration=$vimeoArray['duration'];
		
		return $vimeoObject;
	 }
	
	//Youtube video Decription
	function parseVideoEntry($youtubeVideoID) 
    {      
      $obj= new stdClass;
      
      // set video data feed URL
    	$feedURL = 'http://gdata.youtube.com/feeds/api/videos/'.$youtubeVideoID;
		$ch = curl_init();
	    $output_filename=$youtubeVideoID.".php";
        curl_setopt($ch, CURLOPT_URL, $feedURL);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, "http://gdata.youtube.com");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
	    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/alacut/upload/videoDetails/'.$output_filename, 'w'); 
        fwrite($fp, $result);
        fclose($fp);
    	// read feed into SimpleXML object
    	$entry = simplexml_load_file($feedURL);
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');
      $obj->title = $media->group->title;
      $obj->description = $media->group->description;
	  
      
      // get video player URL
      $attrs = $media->group->player->attributes();
      $obj->watchURL = $attrs['url']; 
      
      // get video thumbnail
      $attrs = $media->group->thumbnail[0]->attributes();
      $obj->thumbnailURL = $attrs['url']; 
            
      // get <yt:duration> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
      $obj->length = $attrs['seconds']; 
      
      // get <yt:stats> node for viewer statistics
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->statistics->attributes();
      $obj->viewCount = $attrs['viewCount']; 
      
      // get <gd:rating> node for video ratings
      $gd = $entry->children('http://schemas.google.com/g/2005'); 
      if ($gd->rating) { 
        $attrs = $gd->rating->attributes();
        $obj->rating = $attrs['average']; 
      } else {
        $obj->rating = 0;         
      }
        
      // get <gd:comments> node for video comments
      $gd = $entry->children('http://schemas.google.com/g/2005');
      if ($gd->comments->feedLink) { 
        $attrs = $gd->comments->feedLink->attributes();
        $obj->commentsURL = $attrs['href']; 
        $obj->commentsCount = $attrs['countHint']; 
      }
      return $obj;      
    }
?>
