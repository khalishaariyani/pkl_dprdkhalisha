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

// Mengambil semua data kehadiran dari database
$sql = "SELECT * FROM kehadiran"; // Pastikan ada tabel `kehadiran` di database
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php include_once '../include/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include_once '../include/navbar_adm.php';
        include_once '../include/sidebar_adm.php'; // Sidebar admin
        ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Data Kehadiran Anggota DPRD</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Kehadiran -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Rekap Kehadiran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mx-auto" style="width: 90%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 20%;">Nama Anggota</th>
                                            <th style="width: 15%;">Tanggal Kehadiran</th>
                                            <th style="width: 20%;">Status Kehadiran</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($results)): ?>
                                            <?php foreach ($results as $row): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tgl_kehadiran']); ?></td>
                                            
                                                    <td>
                                                        <?php if ($row['status_kehadiran'] == 'Hadir'): ?>
                                                            <span class="badge badge-success">Hadir</span>
                                                        <?php elseif ($row['status_kehadiran'] == 'Izin'): ?>
                                                            <span class="badge badge-warning">Izin</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Tidak Hadir</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data kehadiran tersedia.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php
    include_once '../include/footer.php';
    include_once '../include/script.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
