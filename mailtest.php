<?php
$to = "rajesh.khatei@aabsys.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "anshuman.nayak@aabsys.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?> 