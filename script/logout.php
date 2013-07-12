<?php
session_start();
include('../config/config1.php');
if(session_destroy())
{
echo "Logout sucessfully";
header("Location: index.php");
}
?>