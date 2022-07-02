<?php

    include '../config.php';

    $username = @$_GET['username'];

    $sql_hapus = "UPDATE data_user SET bukti_pembayaran = NULL, valid = 'f', paket = NULL WHERE username = ?" ;
    $check_hapus = $con->prepare($sql_hapus);
    $check_hapus->bind_param('s', $username);
    $check_hapus->execute();

    header("location: konfirmasi.php");

?>