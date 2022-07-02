<?php 
    include '../config.php';
    session_start();

    $nama_mapel = @$_POST['nama_mata_pelajaran'];
    $kode_mapel = @$_POST['kode_mata_pelajaran'];

    $sql_select = "SELECT kode_mata_pelajaran, nama_mata_pelajaran FROM mata_pelajaran WHERE kode_mata_pelajaran = ?";
    $check_sql = $con->prepare($sql_select);
    $check_sql->bind_param('i', $kode_mapel);
    $check_sql->execute();
    $check_sql->store_result();
    $check_sql->bind_result($kode_mata_pelajaran, $nama_mata_palajaran);
    $row = array();
    if ($check_sql->fetch()) {
        $row = array('kode_mata_pelajaran'=>$kode_mata_pelajaran, 'nama_mata_pelajaran'=>$nama_mata_palajaran);
    }
    

    if ($nama_mapel == NULL) {
        $nama_mapel = $row['nama_mata_pelajaran'];
    }

    $sql_query = "UPDATE mata_pelajaran SET nama_mata_pelajaran = ? WHERE kode_mata_pelajaran = ? ";
    $check_query = $con->prepare($sql_query);
    $check_query->bind_param('si', $nama_mapel, $row['kode_mata_pelajaran']);
    $check_query->execute();

    header("location: daftar_mapel.php");
    exit();
?>
