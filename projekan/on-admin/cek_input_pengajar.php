<?php
    include '../config.php';
    session_start();
    
    $nama_pengajar2 = @$_POST['nama_pengajar'];
    $nik2 = @$_POST['nik'];
    $alamat2 = @$_POST['alamat'];
    $jenis_kelamin2 = @$_POST['jk'];
    $nomor_telepon2 = @$_POST['nomor_telepon'];

    $sql_check = "SELECT * FROM pengajar WHERE nik = ?";
    $check_check = $con->prepare($sql_check);
    $check_check->bind_param('s', $nik2);
    $check_check->execute();
    $check_check->store_result();

    $sql_query = "INSERT INTO pengajar (nama_pengajar, nik, alamat, nomor_telepon, jenis_kelamin) VALUES ( '$nama_pengajar2', '$nik2', '$alamat2', '$nomor_telepon2', '$jenis_kelamin2') ";                    
    $sql_check = $con->prepare($sql_query);
    
    if ($check_check->num_rows == 0) {
        $sql_check->execute();
        header("location: data_pengajar.php");
        exit();
    }else {
        header("location: input_pengajar.php");
        exit();
    }   
    
?>