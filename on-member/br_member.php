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
                <div class="card">
                    <div class="card-header">INROMASI TERKINI</div>

                    <div class="card-body">
                        <div class="container-fluid p-2">

                            <!-- Small boxes (Stat box) -->
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3></h3>
                                            <p> JADWAL RAPAT DPRD KOTA BANJARMASIN </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="jadwal_anggota.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3></h3>
                                            <p> STATUS RANCANGAN RAPERDA DPRD KOTA BANJARMASIN </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3></h3>
                                            <p> Badan Pembentukan Peraturan Daerah ( Periode 2024- 2029)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3></h3>
                                            <p> DEWAN DPRD KOTA BANJARMASIN PERIPDE 2024-2029</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="row">

                            <!--Laporan Statistik-->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Tentang DPRD Kota Banjarmasin</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <a href="#" class="dropdown-item">Action</a>
                                                    <a href="#" class="dropdown-item">Another action</a>
                                                    <a href="#" class="dropdown-item">Something else here</a>
                                                    <a class="dropdown-divider"></a>
                                                    <a href="#" class="dropdown-item">Separated link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="../dist/img/ketua.jpeg" alt="Rikval Fachruri" class="img-fluid rounded-circle" style="width: 100%; height: auto;">
                                            </div>
                                            <div class="col-md-8">
                                                <p class="text-center">
                                                    <strong>Rikval Fachruri</strong><br>
                                                    <small>Ketua DPRD Kota Banjarmasin</small>
                                                </p>
                                                <p>
                                                    Dewan Perwakilan Rakyat Daerah (DPRD) Kota Banjarmasin adalah lembaga legislatif di tingkat kota
                                                    yang memiliki fungsi utama sebagai perwakilan rakyat dalam menyuarakan aspirasi masyarakat serta
                                                    mengawasi jalannya pemerintahan di Kota Banjarmasin, Kalimantan Selatan. DPRD Kota Banjarmasin
                                                    juga berperan dalam pembentukan peraturan daerah (Perda) dan penganggaran daerah melalui fungsi
                                                    legislasi, anggaran, dan pengawasan.
                                                </p>

                                                <h5>Fungsi DPRD Kota Banjarmasin</h5>
                                                <ul>
                                                    <li><strong>Fungsi Legislasi:</strong> DPRD memiliki wewenang untuk membahas dan menetapkan peraturan daerah (Perda) bersama dengan pemerintah kota. Perda ini mencakup berbagai aspek, seperti tata kelola kota, anggaran, pembangunan, dan kebijakan-kebijakan lain yang menyangkut kesejahteraan masyarakat.</li>
                                                    <li><strong>Fungsi Anggaran:</strong> DPRD terlibat dalam pembahasan dan penetapan Anggaran Pendapatan dan Belanja Daerah (APBD). DPRD bertanggung jawab memastikan anggaran tersebut dialokasikan sesuai dengan dengan prioritas pembangunan di Kota Banjarmasin.</li>
                                                    <li><strong>Fungsi Pengawasan:</strong> DPRD juga bertanggung jawab dalam mengawasi jalannya pemerintahan, termasuk pelaksanaan kebijakan-kebijakan yang telah disepakati, pengelolaan keuangan daerah, dan penggunaan APBD. Pengawasan ini bertujuan untuk memastikan transparansi dan akuntabilitas pemerintah kota dalam melaksanakan tugas-tugasnya.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./card-body -->
                                    <div class="card-footer">
                                        <div class="row">
                                            <!-- Gambar untuk individu pertama -->
                                            <div class="col-sm-4 col-6 text-center">
                                                <img src="../dist/img/wakil1.png" alt="H. Harry Wijaya" class="img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                                                <h6 class="mt-2">H. Harry Wijaya, S.H.</h6>
                                                <p>Wakil Ketua DPRD</p>
                                            </div>

                                            <!-- Gambar untuk individu kedua -->
                                            <div class="col-sm-4 col-6 text-center">
                                                <img src="../dist/img/wakil2.png" alt="H. Mathari" class="img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                                                <h6 class="mt-2">H. Mathari, S.Ag., M.I.Kom.</h6>
                                                <p>Wakil Ketua DPRD</p>
                                            </div>

                                            <!-- Gambar untuk individu ketiga -->
                                            <div class="col-sm-4 col-6 text-center">
                                                <img src="../dist/img/wakil3.png" alt="Muhammad Isnaini" class="img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                                                <h6 class="mt-2">Muhammad Isnaini, S.E., M.M.</h6>
                                                <p>Wakil Ketua DPRD</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.card-footer -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
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