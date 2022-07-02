<?php
    include '../config.php';
    session_start();

    $kode_pengajar= $_GET['kode_pengajar'];

    $sql_hapus = "DELETE FROM pengajar WHERE kode_pengajar = ? ";
    $check_hapus = $con->prepare($sql_hapus);
    $check_hapus->bind_param('i', $kode_pengajar);
    $check_hapus->execute();

    header("location: data_pengajar.php");
?>