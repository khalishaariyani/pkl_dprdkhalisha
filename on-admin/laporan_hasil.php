<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Laporan Anggota Dinas';
}

if (empty($_SESSION)) {
    include_once './login.php';
    include_once './include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Proses untuk Filter dan Pencarian
$whereClause = "";
if (isset($_POST['search'])) {
    $nama_dinas = $_POST['nama_dinas'];
    $tanggal_rapat = $_POST['tanggal_rapat'];

    if ($nama_dinas != "") {
        $whereClause .= " AND nama_dinas LIKE '%$nama_dinas%'";
    }

    if ($tanggal_rapat != "") {
        $whereClause .= " AND tanggal_rapat LIKE '%$tanggal_rapat%'";
    }
}

// Mengambil semua data dinas dengan filter
$sql = "SELECT * FROM dinas WHERE 1=1" . $whereClause;
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Menutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../include/head.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include_once '../include/navbar_adm.php';
        include_once '../include/sidebar_adm.php';
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Laporan Anggota Dinas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Dinas</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan Anggota Dinas Form -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Filter Anggota Dinas</h6>
                        </div>
                        <form method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_dinas">Nama Dinas</label>
                                            <input type="text" class="form-control" name="nama_dinas" placeholder="Masukkan Nama Dinas">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_rapat">Tanggal Rapat</label>
                                            <input type="date" class="form-control" name="tanggal_rapat">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="search" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Laporan Anggota Dinas -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Anggota Dinas</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Dinas</th>
                                                <th>ID Karyawan</th>
                                                <th>Nama Dinas</th>
                                                <th>Tujuan Dinas</th>
                                                <th>Nama Rapat</th>
                                                <th>Tempat Rapat</th>
                                                <th>Tanggal Rapat</th>
                                                <th>Nama Pimpinan</th>
                                                <th>Jumlah Peserta</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['id_dinas']; ?></td>
                                                        <td><?php echo $row['id_karyawan']; ?></td>
                                                        <td><?php echo $row['nama_dinas']; ?></td>
                                                        <td><?php echo $row['tujuan_dinas']; ?></td>
                                                        <td><?php echo $row['nama_rapat']; ?></td>
                                                        <td><?php echo $row['tempat_rapat']; ?></td>
                                                        <td><?php echo $row['tanggal_rapat']; ?></td>
                                                        <td><?php echo $row['nama_pimpinan']; ?></td>
                                                        <td><?php echo $row['jumlah_peserta']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">Tidak ada data Anggota Dinas</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include_once '../include/footer.php'; ?>
    <?php include_once '../include/script.php'; ?>

</body>

</html>
