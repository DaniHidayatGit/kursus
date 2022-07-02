<?php
    include '../config.php';
    
    $kode_mapel = @$_GET['kode_mata_pelajaran'];

    $sql_nilai = "DELETE FROM mata_pelajaran WHERE kode_mata_pelajaran = ?";
    $check_nilai = $con->prepare($sql_nilai);
    $check_nilai->bind_param('i', $kode_mapel);
    $check_nilai->execute();

    header("location: daftar_mapel.php");
?>