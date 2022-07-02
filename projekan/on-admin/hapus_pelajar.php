<?php
    include '../config.php';
    session_start();

    $username = $_GET['username'];

    $sql_hapus1 = "DELETE FROM _user WHERE username = ?";
    $check_hapus1 = $con->prepare($sql_hapus1);
    $check_hapus1->bind_param('s', $username);
    $check_hapus1->execute();

    $sql_hapus2 = "DELETE FROM data_nilai WHERE username = ?";
    $check_hapus2 = $con->prepare($sql_hapus2);
    $check_hapus2->bind_param('s', $username);
    $check_hapus2->execute();

    $sql_hapus = "DELETE FROM data_user WHERE username = ? ";
    $check_hapus = $con->prepare($sql_hapus);
    $check_hapus->bind_param('s', $username);
    $check_hapus->execute();

    header("location: data_pelajar.php");
?>