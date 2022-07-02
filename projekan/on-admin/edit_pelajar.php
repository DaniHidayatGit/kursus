<?php
    include '../config.php';
    session_start();

    $username = $_GET['username'];

    $sql_data_pelajar = "SELECT a.nama_depan, a.nama_belakang, a.password, a.email, a.username, b.jenis_kelamin, b.nomor_telepon FROM _user a, data_user b WHERE a.username = b.username";
    $check_pelajar = $con->prepare($sql_data_pelajar);
    $check_pelajar->execute();
    $check_pelajar->store_result();
    $check_pelajar->bind_result($nama_depan, $nama_belakang, $password, $email, $username1, $jenis_kelamin, $nomor_telepon);
    $row = array();
    if ($check_pelajar->fetch()) {
        $row = array('nama_depan'=>$nama_depan, 'nama_belakang'=>$nama_belakang, 'password'=>$password, 'email'=>$email, 'username'=>$username1, 'jenis_kelamin'=>$jenis_kelamin, 'nomor_telepon'=>$nomor_telepon);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-KURSUS - Edit Data Pelajar</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../assets/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-KURSUS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span>Menu Utama</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed active" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Data Pelajar</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="data_pelajar.php"> Data Pelajar </a>
                        <a class="collapse-item" href="konfirmasi.php"> Butuh Konfirmasi </a>
                        <a class="collapse-item" href="valid.php"> Sudah Valid </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <span> Data Pengajar </span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="data_pengajar.php"> Data Pengajar </a>
                        <a class="collapse-item" href="input_pengajar.php"> Input Pengajar </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <span>Lainnya</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="daftar_mapel.php"> Daftar Mata Pelajaran </a>
                        <a class="collapse-item" href="input_nilai.php"> Input Nilai </a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="undraw_rocket.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"aria-labelledby="userDropdown">
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
                        <h1 class="h3 mb-0 text-gray-800"> Data Pelajar </h1>
                    </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-7">
                        <div class="card shadow mb-5">
                    <?php 
                        if ($username != 'admin' && $username == $row['username']) {
                    ?> 
                            <form class="user col-md-auto" method="POST" action="cek_edit_pelajar.php">
                                <br>
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Nama Depan : </i>
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <input type="text" value="<?= $row['nama_depan']; ?>" placeholder="Nama Depan" name="nama_depan" class="form-control form-control-user" required>
                                    </div>
                                <br>  
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Nama Belakang : </i>
                                        <input type="text" value="<?= $row['nama_belakang']; ?>" placeholder="Nama Belakang" name="nama_belakang" class="form-control form-control-user" required>
                                    </div> 
                                <br>
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Username : </i>
                                        <input type="text" value="<?= $row['username']; ?>" placeholder="Username" name="username" class="form-control form-control-user" readonly>
                                    </div> 
                                <br>
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Password : </i>
                                        <input type="password" value="<?= $row['password']; ?>" placeholder="Password" autocomplete="on" name="password" class="form-control form-control-user" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                                    </div> 
                                <br>
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Email : </i>
                                        <input type="email" value="<?= $row['email']; ?>" placeholder="Email" class="form-control form-control-user" name="email" required>
                                    </div>
                                <br>        
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Jenis Kelamin : </i>
                                <?php 
                                    if ($jenis_kelamin == 'laki-laki') {
                                        echo "<input type='radio' name='jk' value='laki-laki' checked> Laki-laki <input type='radio' name='jk' value='perempuan'> Perempuan";
                                    }else {
                                        echo "<input type='radio' name='jk' value='laki-laki'> Laki-laki <input type='radio' name='jk' value='perempuan' checked> Perempuan";
                                    }
                                ?>
                                    </div>
                                <br>
                                    <div class="col-xl-5 col-lg-7">
                                        <i> Nomor Telepon : </i>
                                        <input type="text" value="<?= $row['nomor_telepon']; ?>" placeholder="Nomor Telepon" id="nomor_telepon" name="nomor_telepon" class="form-control form-control-user" required>
                                    </div>  
                                <br>
                                    <input type="submit" value="Ubah" class="btn btn-success btn-block" onclick="konfirm()">
                                <br>
                            </form>
                    <?php
                        }
                    ?>
                        </div>
                    </div>
                </div>

            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; E-KURSUS Website 2022</span>
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
                    <a class="btn btn-primary" href="logout.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    
    <script type="text/javascript">
        $("#nomor_telepon").inputmask({
            "mask": "(+62) 899-9999-99999"
        });
    </script>
    
</body>

</html>