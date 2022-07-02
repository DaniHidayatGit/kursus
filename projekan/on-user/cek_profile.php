<?php
    include '../config.php';
    session_start();

    $sql_user = "SELECT foto_profil, jenis_kelamin, nomor_telepon, masa_aktif FROM data_user WHERE username = ?";
    $check_user = $con->prepare($sql_user);
    $check_user->bind_param('s', $_SESSION['nama']);
    $check_user->execute();
    $check_user->store_result();
    $check_user->bind_result($foto_profil, $jenis_kelamin, $nomor_telepon, $masa_aktif);
    $rows = array();

    if ($check_user->fetch()) {
        $rows = array('foto_profil'=>$foto_profil, 'jenis_kelamin'=>$jenis_kelamin, 'nomor_telepon'=>$nomor_telepon);
    }

if ($rows['masa_aktif'] != NULL) {
    $tenggat = date('Y-m-d');
    if ($tenggat > $rows['masa_aktif']) {
        $sql_update = "UPDATE data_user SET masa_aktif = NULL, valid = 'f', paket = NULL WHERE  username = ? ";
        $check_update = $con->prepare($sql_update);
        $check_update->bind_param('s', $_SESSION['nama']);
        $check_update->execute();
    }
}

    $tipe_file = $_FILES['file']['type'];
    $nama_file = $_FILES['file']['name'];
    if ($nama_file == NULL) {
        $nama_file = $foto_profil;
    }
    $ukuran_file = $_FILES['file']['size'];
    $tmp_file = $_FILES['file']['tmp_name'];
    $path = "img/fotoprofil/" . $nama_file;

        $jk = @$_POST['jk'];
        if ($jk == NULL) {
            $jk = $jenis_kelamin;
        }
        $nomor_hp = @$_POST['nomor_hp'];
        if ($nomor_hp == NULL) {
            $nomor_hp = $nomor_telepon;
        }
                        
            if ($tipe_file = 'jpg' || $tipe_file = 'png' || $tipe_file = 'jpeg' || $tipe_file = 'svg') {
                if ($ukuran_file <= 3132210) {
                    move_uploaded_file($tmp_file, $path);
                    $sql_data = "UPDATE data_user SET foto_profil = ? WHERE username = ?";
                    $check_data = $con->prepare($sql_data);
                    $check_data->bind_param('ss', $nama_file, $_SESSION['nama']);
                    $check_data->execute();
                    $sql_update = "UPDATE data_user SET jenis_kelamin = ?, nomor_telepon = ? WHERE username = ?";
                    $check_update = $con->prepare($sql_update);
                    $check_update->bind_param('sss', $jk, $nomor_hp, $_SESSION['nama']);
                    $check_update->execute();    
                }else{
                    header("location: profile.php");
                }
            }
            $sql_data = "UPDATE data_user SET foto_profil = ? WHERE username = ?";
            $check_data = $con->prepare($sql_data);
            $check_data->bind_param('ss', $nama_file, $_SESSION['nama']);
            $check_data->execute();
            $sql_update = "UPDATE data_user SET jenis_kelamin = ?, nomor_telepon = ? WHERE username = ?";
            $check_update = $con->prepare($sql_update);
            $check_update->bind_param('sss', $jk, $nomor_hp, $_SESSION['nama']);
            $check_update->execute();    
            header("location: index.php");

?>