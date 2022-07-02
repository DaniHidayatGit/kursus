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
    
    $nama_depan2 = @$_POST['nama_depan'];
    $nama_belakang2 = @$_POST['nama_belakang'];
    $password2 = @$_POST['password'];
    $email2 = @$_POST['email'];
    $jenis_kelamin2 = @$_POST['jk'];
    $nomor_telepon2 = @$_POST['nomor_telepon'];

if ($nama_depan2 == NULL) {
    $nama_depan2 = $row['nama_depan'];
}
if ($nama_belakang2 == NULL) {
    $nama_belakang2 = $row['nama_belakang'];
}
if ($password2 == NULL) {
    $password2 = $row['password'];
}
if ($email2 == NULL) {
    $email2 = $row['email'];
}
if ($jenis_kelamin2 == NULL) {
    $jenis_kelamin2 = $row['jenis_kelamin'];
}
if ($nomor_telepon2 == NULL) {
    $nomor_telepon2 = $row['nomor_telepon'];
}

if ($nama_depan2 != NULL && $nama_belakang2 != NULL && $password2 != NULL && $email2 != NULL && $jenis_kelamin2 != NULL && $nomor_telepon2 != NULL) {
    $sql_query = "UPDATE data_user SET jenis_kelamin = ?, nomor_telepon = ? WHERE username = ? ";
    $sql_check = $con->prepare($sql_query);
    $sql_check->bind_param('sss', $jenis_kelamin2, $nomor_telepon2, $row['username']);
    $sql_check->execute();

    $sql_query1 = "UPDATE _user SET nama_depan = ?, nama_belakang = ?, password = ?, email = ? WHERE username = ? ";
    $sql_check1 = $con->prepare($sql_query1);
    $sql_check1->bind_param('sssss', $nama_depan2, $nama_belakang2, $password2, $email2, $row['username']);
    $sql_check1->execute();

    header("location: data_pelajar.php");
    exit();

}else {
    echo "GAGAL";
}

?>