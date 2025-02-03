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
    <div class="card">
        <div class="card-header">
            <h4>INFORMASI TERKINI</h4>
        </div>

        <div class="card-body">
            <div class="container-fluid p-3">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- Baris 1: Agenda Rapat Raperda dan Status Kehadiran -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="small-box bg-info shadow-lg rounded-lg">
                            <div class="inner">
                                <h3>5</h3>
                                <p>Agenda Rapat Raperda di DPRD Kota Banjarmasin</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="small-box bg-success shadow-lg rounded-lg">
                            <div class="inner">
                                <h3>85%</h3>
                                <p>Status Kehadiran Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Baris 2: Keputusan Hasil Rapat dan Pengumuman Penting -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="small-box bg-warning shadow-lg rounded-lg">
                            <div class="inner">
                                <h3>2</h3>
                                <p>Keputusan Hasil Rapat Raperda</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="small-box bg-danger shadow-lg rounded-lg">
                            <div class="inner">
                                <h3>!</h3>
                                <p>Pengumuman Penting</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat Pengumuman <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Additional Information Section -->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0">Statistik Kehadiran </h5>
                </div>
                <div class="card-body">
                    <p>Data statistik kehadiran anggota rapat  Grafik akan menunjukkan tren kehadiran berdasarkan waktu dan kategori.</p>
                    <!-- Include a small chart or graph here -->
                    <a href="#" class="btn btn-light">Lihat Statistik</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-info text-white">
                    <h5 class="m-0">Agenda Rapat </h5>
                </div>
                <div class="card-body">
                    <p>Daftar agenda rapat DPRD Kota Banjarmasin Anggota dapat mempersiapkan diri dengan melihat detail setiap rapat yang terjadwal.</p>
                    <a href="#" class="btn btn-light">Lihat Agenda</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-warning text-white">
                    <h5 class="m-0">Keputusan Terbaru</h5>
                </div>
                <div class="card-body">
                    <p>Tampilkan keputusan terbaru yang dihasilkan dari rapat DPRD untuk disebarkan kepada anggota dan dinas dinas terkait</p>
                    <a href="#" class="btn btn-light">Lihat Keputusan</a>
                </div>
            </div>
        </div>
    </div>
</section>

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