<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Laporan Kehadiran';
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
    $status_kehadiran = $_POST['status_kehadiran'];
    $tanggal_kehadiran = $_POST['tanggal_kehadiran'];

    if ($status_kehadiran != "") {
        $whereClause .= " AND status_kehadiran LIKE '%$status_kehadiran%'";
    }

    if ($tanggal_kehadiran != "") {
        $whereClause .= " AND tgl_kehadiran LIKE '%$tanggal_kehadiran%'";
    }
}

// Mengambil semua data kehadiran dengan filter
$sql = "SELECT * FROM kehadiran WHERE 1=1" . $whereClause;
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
                            <h1 class="m-0 text-dark">Laporan Kehadiran</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Kehadiran</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Laporan Kehadiran Form -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Filter Kehadiran</h6>
                        </div>
                        <form method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status_kehadiran">Status Kehadiran</label>
                                            <input type="text" class="form-control" name="status_kehadiran" placeholder="Masukkan Status Kehadiran">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_kehadiran">Tanggal Kehadiran</label>
                                            <input type="date" class="form-control" name="tanggal_kehadiran">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="search" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Laporan Kehadiran -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Kehadiran</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Form Filter dan Cetak -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="cetak_kehadiran.php" target="_blank">
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <label for="bulan">Pilih Bulan:</label>
                                                        <input type="month" class="form-control mb-2" name="bulan" required>
                                                    </div>
                                                    <div class="col-auto">
                                                        <label>&nbsp;</label>
                                                        <a href="cetak_kehadiran.php" class="btn btn-primary btn-block mb-2" target="_blank">
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
                                                <th>NO</th>
                                                <th>Nama Anggota</th>
                                                <th>No Anggota</th>
                                                <th>Status Kehadiran</th>
                                                <th>Tanggal Kehadiran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php $no = 1; // Variabel untuk nomor urut 
                                                ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td> <!-- Nomor urut otomatis -->
                                                        <td><?php echo $row['nama']; ?></td>
                                                        <td><?php echo $row['no_anggota']; ?></td>
                                                        <td><?php echo $row['status_kehadiran']; ?></td>
                                                        <td><?php echo $row['tgl_kehadiran']; ?></td>
                                                        <td>
                                                            <a href="?edit=<?php echo $row['id_kehadiran']; ?>">Edit</a> |
                                                            <a href="?delete=<?php echo $row['id_kehadiran']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data Kehadiran</td>
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