<?php
    include '../config.php';
    session_start();

    $sql_data_pelajar = "SELECT a.nama_depan, a.nama_belakang, a.username, a.password, a.email, a.username, b.jenis_kelamin, b.nomor_telepon FROM _user a, data_user b WHERE a.username = b.username";
    $check_pelajar = $con->prepare($sql_data_pelajar);
    $check_pelajar->execute();
    $check_pelajar->store_result();
    $check_pelajar->bind_result($nama_depan, $nama_belakang, $username, $password, $email, $username1, $jenis_kelamin, $nomor_telepon);
    $row = array();
    if ($check_pelajar->fetch()) {
        $row = array('nama_depan'=>$nama_depan, 'nama_belakang'=>$nama_belakang, 'userame'=>$username, 'password'=>$password, 'email'=>$email, 'username'=>$username1, 'jenis_kelamin'=>$jenis_kelamin, 'nomor_telepon'=>$nomor_telepon);
    }
    
    $kode_pengajar2 = @$_POST['kode_pengajar'];
    $nama_pengajar2 = @$_POST['nama_pengajar'];
    $nik2 = @$_POST['nik'];
    $alamat2 = @$_POST['alamat'];
    $jenis_kelamin2 = @$_POST['jk'];
    $nomor_telepon2 = @$_POST['nomor_telepon'];

if ($kode_pengajar2 == NULL) {
    $kode_pengajar2 = $row['kode_pengajar'];
}
if ($nama_pengajar2 == NULL) {
    $nama_pengajar2 = $row['nama_pengajar'];
}
if ($nik2 == NULL) {
    $nik2 = $row['nik'];
}
if ($alamat2 == NULL) {
    $alamat2 = $row['alamat'];
}
if ($jenis_kelamin2 == NULL) {
    $jenis_kelamin2 = $row['jenis_kelamin'];
}
if ($nomor_telepon2 == NULL) {
    $nomor_telepon2 = $row['nomor_telepon'];
}


    $sql_query = "UPDATE pengajar SET nama_pengajar = ?, nik = ?, alamat = ?, jenis_kelamin = ?, nomor_telepon = ? WHERE kode_pengajar = ? ";
    $sql_check = $con->prepare($sql_query);
    $sql_check->bind_param('sssssi', $nama_pengajar2, $nik2, $alamat2, $jenis_kelamin2, $nomor_telepon2, $kode_pengajar2);
    $sql_check->execute();

    $sql_query = "UPDATE data_nilai SET kode_pengajar = ?, nama_pengajar = ? WHERE kode_pengajar = ? ";
    $sql_check = $con->prepare($sql_query);
    $sql_check->bind_param('isi', $kode_pengajar2, $nama_pengajar2, $kode_pengajar2);
    $sql_check->execute();
    header("location: data_pengajar.php");
    exit();

?>
