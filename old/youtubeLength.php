<?php
    //The Youtube's API url
   function getYouTubeVideoLength($video_id)
   {
   	 define('YT_API_URL', 'http://gdata.youtube.com/feeds/api/videos?q=');
     
    //Change below the video id.
    //$video_id = '_cO02dH28_o';
     
    //Using cURL php extension to make the request to youtube API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, YT_API_URL . $video_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //$feed holds a rss feed xml returned by youtube API
    $feed = curl_exec($ch);
    curl_close($ch);
     
    //Using SimpleXML to parse youtube's feed
    $xml = simplexml_load_string($feed);
     
    $entry = $xml->entry[0];
    //If no entry whas found, then youtube didn't find any video with specified id
    if(!$entry) return 0;
    $media = $entry->children('media', true);
    $group = $media->group;
    $content_attributes = $group->content->attributes();
    //$vid_duration: the duration of the video in seconds. Ex.: 192.
    $vid_duration = $content_attributes['duration'];
    //$duration_formatted: the duration of the video formatted in "mm:ss". Ex.:01:54
    $duration_formatted = str_pad(floor($vid_duration/60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($vid_duration%60, 2, '0', STR_PAD_LEFT);
     
    //echoing the variables for testing purposes:
    
    return $vid_duration ;
    }
?>

