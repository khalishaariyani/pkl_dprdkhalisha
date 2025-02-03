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
function get_user_data($koneksi, $id)
{
    $stmt = $koneksi->prepare("
        SELECT 
            u.nama,
            u.username,
            u.email,
            p.gambar
        FROM user u
        LEFT JOIN profil p ON u.id = p.user_id
        WHERE u.id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}




// Mendapatkan data pengguna
$user_data = get_user_data($koneksi, $id);

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
                            <h1 class="m-0">Beranda</h1>
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
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">Status SIK Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <!--komen dulu
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Berkas Di Tolak</h5>
                            Upload Kembali dan Lengkapi Syarat
                        </div>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Tidak Ada </h5>
                            Tidak Ada Status Terbaru, Isi Form Pengajuan SIK
                        </div>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Proses Penelitian</h5>
                            Berkas sedang di teliti, cek secara berkala pada status pengajuan
                        </div>
                        komen dulu-->
                        <div class="d-flex align-items-start">
                            <!-- Alert -->
                            <div class="alert alert-success alert-dismissible flex-fill mr-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Berkas Diterima</h5>
                                Silahkan Unduh Surat Izin Keramaian di samping
                            </div>

                            <!-- Button -->
                            <div class="d-flex">
                                <!-- Unduh SIK -->
                                <a class="btn btn-app bg-success mr-3">
                                    <i class="fas fa-download"></i> Unduh SIK
                                </a>
                                <!-- Edit SIK -->
                                <a class="btn btn-app bg-warning">
                                    <i class="fas fa-edit"></i> Edit SIK
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">Riwayat Pembuatan SIK</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh Data -->
                                <tr>
                                    <td>1</td>
                                    <td>2023-12-01</td>
                                    <td>Festival Musik</td>
                                    <td>2023-12-10</td>
                                    <td>Lapangan Kota</td>
                                    <td>
                                        <a href="unduh_sik.php?id=1" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> Unduh SIK
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>-</td>
                                    <td>Bazar Amal</td>
                                    <td>2023-11-20</td>
                                    <td>Gedung Serbaguna</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>-</td>
                                    <td>Konser Band</td>
                                    <td>2023-10-30</td>
                                    <td>Stadion Utama</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
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