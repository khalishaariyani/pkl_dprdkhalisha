<?php
include '../session_start.php'; // Karena session_start.php ada di root folder
include '../include/env.config.php'; // Karena env.config.php ada di folder include

if (isset($_GET['menu'])) {

    $menu = $_GET['menu'];
} else {
    $menu = 'Dashboard';
}

if (empty($_SESSION)) {
    include_once './login.php';
    include_once './include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Fungsi untuk menjalankan query dan mengambil satu nilai dari hasilnya
function get_single_value($koneksi, $query, $types = "", $params = [])
{
    $stmt = $koneksi->prepare($query);
    if ($types && $params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->num_rows > 0 ? $result->fetch_assoc() : null;
    $stmt->close();
    return $value;
}

// Menutup koneksi
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
        include_once '../include/sidebar_adm.php';
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

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

            <!-- Main content -->
            <section class="content">
                <section class="content">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <!-- HEADER DENGAN ANIMASI DAN TAMPILAN MEWAH -->
                        <div class="card-header marquee-header">
                            <marquee behavior="scroll" direction="left" scrollamount="6">
                                <h2 class="text-white font-weight-bold">
                                    SELAMAT DATANG DI WEBSITE MANAJEMEN RAPERDA DEWAN PERWAKILAN RAKYAT DAERAH KOTA BANJARMASIN
                                </h2>
                            </marquee>
                        </div>

                        <div class="card-body">
                            <div class="container-fluid p-3">
                                <!-- Row 1: Agenda Rapat & Status Kehadiran -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="info-box gradient-gold">
                                            <div class="inner">
                                                <p class="text-title">Agenda Rapat Raperda di DPRD Kota Banjarmasin</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-calendar-check fa-3x"></i>
                                            </div>
                                            <a href="agenda.php" class="info-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="info-box gradient-blue">
                                            <div class="inner">
                                                <p class="text-title">Status Kehadiran Anggota</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-users fa-3x"></i>
                                            </div>
                                            <a href="kehadiran.php" class="info-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Keputusan Rapat & Pengumuman -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="info-box gradient-black">
                                            <div class="inner">
                                                <p class="text-title">Keputusan Hasil Rapat Raperda</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-gavel fa-3x"></i>
                                            </div>
                                            <a href="cetak_keputusan.php" class="info-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="info-box gradient-red">
                                            <div class="inner">
                                                <p class="text-title">Pengumuman Penting</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-bell fa-3x"></i>
                                            </div>
                                            <a href="pengumuman_penting.php" class="info-footer">Lihat Pengumuman <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- CSS Custom -->
                <style>
                    .marquee-header {
                        background: linear-gradient(to right, #003366, #00509e);
                        padding: 20px 0;
                        border-radius: 10px 10px 0 0;
                    }

                    .marquee-header h2 {
                        font-size: 24px;
                        margin: 0;
                    }

                    .info-box {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 25px;
                        border-radius: 10px;
                        color: white;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                    }

                    .text-title {
                        font-size: 20px;
                        font-weight: bold;
                    }

                    .info-footer {
                        font-size: 16px;
                        color: white;
                        text-decoration: none;
                    }

                    .gradient-gold {
                        background: linear-gradient(135deg, #f0c75e, #d4a417);
                    }

                    .gradient-blue {
                        background: linear-gradient(135deg, #007bff, #0056b3);
                    }

                    .gradient-black {
                        background: linear-gradient(135deg, #343a40, #212529);
                    }

                    .gradient-red {
                        background: linear-gradient(135deg, #e74c3c, #c0392b);
                    }
                </style>






                <!-- right col -->
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