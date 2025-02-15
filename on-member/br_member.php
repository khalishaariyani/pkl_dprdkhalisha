<?php
include '../session_start.php'; // Karena session_start.php ada di root folder
include '../include/env.config.php'; // Karena env.config.php ada di folder include

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Beranda';
}

if (empty($_SESSION)) {
    include_once 'login.php';
    include_once 'include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Fungsi untuk mengambil data pengguna



// Mendapatkan data pengguna


// Menutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once '../include/head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        include_once '../include/navbar_adm.php';
        include_once '../include/sidebar_mbr.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h2>Selamat Datang <?= $_SESSION['username'] ?></h2>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="container-fluid">

                <!-- Welcome Message -->
                <section class="content">
                    <div class="card shadow-lg">
                        <div class="card-header text-white text-center" style="background-color: #002147;">
                            <h4 class="font-weight-bold">INFORMASI TERKINI</h4>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <!-- Jadwal Rapat -->
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <div class="small-box" style="background: linear-gradient(to right, #56CCF2, #2F80ED); color: white; border-radius: 10px; padding: 20px;">
                                            <h5 class="font-weight-bold">JADWAL RAPAT DPRD</h5>
                                            <div class="text-right">
                                                <i class="fas fa-calendar-alt fa-3x"></i>
                                            </div>
                                            <a href="jadwal_anggota.php" class="small-box-footer text-white font-weight-bold">
                                                More info <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Badan Pembentukan Perda -->
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <div class="small-box" style="background: linear-gradient(to right, #FDC830, #F37335); color: white; border-radius: 10px; padding: 20px;">
                                            <h5 class="font-weight-bold">BADAN PEMBENTUKAN PERDA</h5>
                                            <div class="text-right">
                                                <i class="fas fa-balance-scale fa-3x"></i>
                                            </div>
                                            <a href="bapemperda.php" class="small-box-footer text-white font-weight-bold">
                                                More info <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Dewan DPRD -->
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <div class="small-box" style="background: linear-gradient(to right, #FF416C, #FF4B2B); color: white; border-radius: 10px; padding: 20px;">
                                            <h5 class="font-weight-bold">DEWAN DPRD PERIODE 2024-2029</h5>
                                            <div class="text-right">
                                                <i class="fas fa-users fa-3x"></i>
                                            </div>
                                            <a href="dewan_dprd.php" class="small-box-footer text-white font-weight-bold">
                                                More info <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tentang DPRD Kota Banjarmasin -->
                <div class="container mt-4">
                    <h3 class="text-center font-weight-bold text-primary mb-4">Tentang DPRD Kota Banjarmasin</h3>
                    <p class="text-justify">
                        Dewan Perwakilan Rakyat Daerah (DPRD) Kota Banjarmasin adalah lembaga legislatif yang berperan penting dalam pengambilan keputusan terkait kebijakan daerah. DPRD bertugas untuk menyusun, mengawasi, dan menetapkan Peraturan Daerah (Perda) yang bertujuan meningkatkan kesejahteraan masyarakat serta memastikan transparansi dalam pemerintahan.
                    </p>
                    <div class="row">
                        <!-- Ketua DPRD -->
                        <div class="col-md-3 text-center">
                            <img src="../dist/img/ketua.jpeg" alt="Rikval Fachruri" class="profile-img mb-3">
                            <h5 class="font-weight-bold">Rikval Fachruri</h5>
                            <p class="text-muted"><em>Ketua DPRD Kota Banjarmasin</em></p>
                        </div>

                        <!-- Wakil Ketua DPRD -->
                        <div class="col-md-3 text-center">
                            <img src="../dist/img/wakil1.png" alt="H. Harry Wijaya" class="profile-img mb-3">
                            <h5 class="font-weight-bold">H. Harry Wijaya, S.H.</h5>
                            <p class="text-muted"><em>Wakil Ketua DPRD</em></p>
                        </div>

                        <div class="col-md-3 text-center">
                            <img src="../dist/img/wakil2.png" alt="H. Mathari" class="profile-img mb-3">
                            <h5 class="font-weight-bold">H. Mathari, S.Ag., M.I.Kom.</h5>
                            <p class="text-muted"><em>Wakil Ketua DPRD</em></p>
                        </div>

                        <div class="col-md-3 text-center">
                            <img src="../dist/img/wakil3.png" alt="Muhammad Isnaini" class="profile-img mb-3">
                            <h5 class="font-weight-bold">Muhammad Isnaini, S.E., M.M.</h5>
                            <p class="text-muted"><em>Wakil Ketua DPRD</em></p>
                        </div>
                    </div>
                </div>

                <!-- CSS -->
                <style>
                    .profile-img {
                        width: 180px;
                        height: 180px;
                        object-fit: cover;
                        border-radius: 50%;
                        border: 4px solid #fff;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    }

                    .profile-img:hover {
                        transform: scale(1.1);
                        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
                    }

                    .small-box {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 20px;
                        border-radius: 10px;
                        color: white;
                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                    }

                    .small-box-footer {
                        display: block;
                        margin-top: 10px;
                        font-size: 14px;
                        text-decoration: none;
                    }
                </style>




            </div>
            </section>


        </div>


    </div>
    </div>
    <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include_once '../include/footer.php';
    ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php
    include_once '../include/script.php';
    ?>

</body>

</html>