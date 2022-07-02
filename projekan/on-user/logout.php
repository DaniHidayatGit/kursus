<?php
    include '../config.php';
    session_start();
        $sql_status = "UPDATE _user SET status = 'f' WHERE username =?";
        $check_status = $con->prepare($sql_status);
        $check_status->bind_param('s',$_SESSION['nama']);
        $check_status->execute();
    session_destroy();
    header("location: ../index.php");
?>