<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Laporan Arsip';
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
    $no_dokumen = $_POST['no_dokumen'];
    $jenis_dokumen = $_POST['jenis_dokumen'];

    if ($no_dokumen != "") {
        $whereClause .= " AND no_dokumen LIKE '%$no_dokumen%'";
    }

    if ($jenis_dokumen != "") {
        $whereClause .= " AND jenis_dokumen LIKE '%$jenis_dokumen%'";
    }
}

// Mengambil semua data arsip dengan filter
$sql = "SELECT * FROM arsip WHERE 1=1" . $whereClause;
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
                            <h1 class="m-0 text-dark">Laporan Arsip</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Arsip</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan Arsip Form -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Filter Arsip</h6>
                        </div>
                        <form method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_dokumen">No Dokumen</label>
                                            <input type="text" class="form-control" name="no_dokumen" placeholder="Masukkan No Dokumen">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_dokumen">Jenis Dokumen</label>
                                            <input type="text" class="form-control" name="jenis_dokumen" placeholder="Masukkan Jenis Dokumen">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="search" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Laporan Arsip -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Arsip</h6>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="cetak_arsip.php" target="_blank">
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <label for="bulan">Pilih Bulan:</label>
                                                        <input type="month" class="form-control mb-2" name="bulan" required>
                                                    </div>
                                                    <div class="col-auto">
                                                        <label>&nbsp;</label>
                                                        <a href="cetak_arsip.php" class="btn btn-primary btn-block mb-2" target="_blank">
                                                            <i class="fas fa-print"></i> Cetak Laporan
                                                        </a>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th> <!-- Mengganti ID Arsip dengan NO -->
                                                <th>No Dokumen</th>
                                                <th>Jenis Dokumen</th>
                                                <th>Tanggal Arsip</th>
                                                <th>Keterangan</th>
                                                <th>Lampiran Dokumen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php $no = 1; // Variabel untuk nomor urut 
                                                ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td> <!-- Nomor urut otomatis -->
                                                        <td><?php echo $row['no_dokumen']; ?></td>
                                                        <td><?php echo $row['jenis_dokumen']; ?></td>
                                                        <td><?php echo $row['tgl_arsip']; ?></td>
                                                        <td><?php echo $row['ket']; ?></td>
                                                        <td><a href="../uploads/<?php echo $row['lampiran_dok']; ?>" target="_blank">Lihat Lampiran</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data Arsip</td>
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