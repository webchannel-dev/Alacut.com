<?php
$id = 'bc-fZaLbyJM';
$url = "http://gdata.youtube.com/feeds/api/videos/$id?v=2&alt=json";
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
$output = curl_exec($ch); 
curl_close($ch);  
print_r(json_decode($output));
?>