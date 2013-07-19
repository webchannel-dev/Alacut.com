<?php
//session_start();

if (array_key_exists("logout", $_GET)) {
    include('session_header.php');
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['oauth_provider']);
    session_destroy();
    header("location: home.php");
}
?>
