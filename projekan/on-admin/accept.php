<?php
    include '../config.php';

    date_default_timezone_set('Asia/Jakarta');

    $username = @$_GET['username'];

    $sql_cek = "SELECT valid, paket, nomor_telepon FROM data_user WHERE username = ?";
    $check_cek = $con->prepare($sql_cek);
    $check_cek->bind_param('s', $username);
    $check_cek->execute();
    $check_cek->store_result();
    $check_cek->bind_result($valid, $paket, $nomor_telepon);
    $row =  array();

    if ($check_cek->fetch()) {
        $row = array('valid'=>$valid, 'paket'=>$paket, 'nomor_telepon'=>$nomor_telepon);
    }

    if ($row['valid'] == 'i' && $row['paket'] == 1) {
        $habis = date('Y-m-d', strtotime("+3 month"));
        $sql_update = "UPDATE data_user SET masa_aktif = '$habis', valid = 't', paket = '1' WHERE username = ?";
        $check_update = $con->prepare($sql_update);
        $check_update->bind_param('s', $username);
        $check_update->execute();
        echo "data berhasil dan sukses ";
        header("location: konfirmasi.php");
    }else if ($row['valid'] == 'i' && $row['paket'] == 2) {
        $habis = date('Y-m-d', strtotime("+6 month"));
        $sql_update = "UPDATE data_user SET masa_aktif = '$habis', valid = 't', paket = '2' WHERE username = ?";
        $check_update = $con->prepare($sql_update);
        $check_update->bind_param('s', $username);
        $check_update->execute();
        echo "data berhasil dan sukses ";
        header("location: konfirmasi.php");        
    }else if ($row['valid'] == 'i' && $row['paket'] == 3) {
        $habis = date('Y-m-d', strtotime("+9 month"));
        $sql_update = "UPDATE data_user SET masa_aktif = '$habis', valid = 't', paket = '3' WHERE username = ?";
        $check_update = $con->prepare($sql_update);
        $check_update->bind_param('s', $username);
        $check_update->execute();
        echo "data berhasil dan sukses ";
        header("location: konfirmasi.php");
    }else if ($row['valid'] == 'i' && $row['paket'] == 4) {
        $habis = date('Y-m-d', strtotime("+1 year"));
        $sql_update = "UPDATE data_user SET masa_aktif = '$habis', valid = 't', paket = '4' WHERE username = ?";
        $check_update = $con->prepare($sql_update);
        $check_update->bind_param('s', $username);
        $check_update->execute();
        echo "data berhasil dan sukses ";
        header("location: konfirmasi.php");
    }else {
        header("location: konfirmasi.php");
    }
        

?>