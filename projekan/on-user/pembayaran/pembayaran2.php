<?php
    include '../../config.php';
    session_start();

    $sql_valid = "SELECT valid FROM data_user WHERE username = ? ";
    $check_log = $con->prepare($sql_valid);
    $check_log->bind_param('s',$_SESSION['nama']);
    $check_log->execute();
    $check_log->store_result();
    $check_log->bind_result($valid);
    $row = array();

    if ($check_log->fetch()) {
        $row = array('valid'=>$valid);
    }    

    $sql_user = "SELECT foto_profil, jenis_kelamin, nomor_telepon, masa_aktif FROM data_user WHERE username = ?";
    $check_user = $con->prepare($sql_user);
    $check_user->bind_param('s', $_SESSION['nama']);
    $check_user->execute();
    $check_user->store_result();
    $check_user->bind_result($foto_profil, $jenis_kelamin, $nomor_telepon, $masa_aktif);
    $rows = array();

    if ($check_user->fetch()) {
        $rows = array('foto_profil'=>$foto_profil, 'jenis_kelamin'=>$jenis_kelamin, 'nomor_telepon'=>$nomor_telepon, 'masa_aktif'=>$masa_aktif);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>KURSUS Q - Pembayaran Paket</title>

    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

<script src="../../assets/vendor/jquery/jquery.min.js"></script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

</script>
<script>
   function change_image(parameter){
    // alert('cek');
      readURL(parameter);
   } 
</script>    
</head>
<body class="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KURSUS-Q</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <span>Menu Utama</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Pilihan Paket</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="../pilihan_paket.php">Paket Belajar</a>
                        <a class="collapse-item" href="../info.php">Info</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if ($row['valid'] == 'f' || $row['valid'] == 'i') { ?>
            <li class="nav-item disabled">
                <a class="nav-link collapsed disabled" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <span> Pembelajaran </span>
                </a>
            </li>
            <?php }else { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <span> Pembelajaran </span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../daftar_nilai.php"> Daftar Nilai </a>
                        <a class="collapse-item" href="../daftar_pengajar.php"> Daftar Pengajar </a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <span>Lainnya</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../tentang_kami.php"> Tentang Kami </a>
                        <a class="collapse-item" href="../contact_us.php"> Contact Us </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="../img/fotoprofil/<?php echo $foto_profil; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> Mendaftar Pilihan Paket </h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <form class="card shadow mb-4" method="POST" action="cek_pembayaran2.php" enctype="multipart/form-data" runat="server">
                                <br>
                                <div class="col-md-auto">
                                    <p align="justify"> Yang teman-teman dapatkan : </p>
                                    <p align="justify"> 1. Belajar Intens 2 pertemuan/minggu </p>
                                    <p align="justify"> 2. Jika teman-teman ingin belajar lebih, teman-teman dapat belajar lebih dengan tutor/guru yang  telah disediakan </p>
                                    <p align="justify"> 3. Teman-teman mendapatkan akses bebas bertanya tentang Bahasa Inggris kepada tutor/guru yang telah disediakan </p>
                                    <br>
                                    <i> Harga Paket 3 Bulan Adalah Senilai : Rp.2.950.000 </i>
                                </div>
                                <br>
                                    <a href="#" onclick="document.getElementById('img_input_data').click(); return false;" class="btn btn-secondary"> Silahkan Masukkan Bukti Transfer Anda </a>
                                    <input type="file" id="img_input_data" style="visibility: hidden;" onchange="change_image(this)"  name="file">
                                    <img id="blah" src="#" alt="your image" width="400" height="300">
                                <br>
                                    <input type="submit" name="kirim" value="Kirim" class="btn btn-success">
                            </form>
                        </div>
                    </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; KURSUS-Q Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan Tombol "Keluar" Jika ingin keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

</body>
</html>