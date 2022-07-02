<?php
session_start();
include 'config.php';

if ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != NULL ) :
    $halaman = $_SESSION['user_login'];
    //var_dump($_SESSION['user_login']);
    header("location: on-". $_SESSION['user_login']);
    exit();
else :
    header("location: login.php");
    exit();
endif;
?>