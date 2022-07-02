<?php
    include '../config.php';

    $mapel = @$_POST['nama_mapel'];

    $sql_mapel = "INSERT INTO mata_pelajaran (nama_mata_pelajaran) VALUES ('$mapel')";
    $check_sql = $con->prepare($sql_mapel);

    $sql_check = "SELECT nama_mata_pelajaran FROM mata_pelajaran WHERE nama_mata_pelajaran = ? ";
    $check_check = $con->prepare($sql_check);
    $check_check->bind_param('s', $mapel);
    $check_check->execute();

    if ($check_check->fetch() !=  NULL) {
        header("location: input_mapel.php");        
    }else{
        $check_sql->execute();
        header("location: daftar_mapel.php");
        exit();
    }
    
?>