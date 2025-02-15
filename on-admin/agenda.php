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

// Mengambil semua data agenda rapat dari database
$sql = "SELECT * FROM jadwal";
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
                            <h1 class="m-0 text-dark">Agenda Rapat Paripurna DPRD KOTA BANJARMASIN</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Agenda Rapat -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Data Jadwal Paripurna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mx-auto" style="width: 90%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 10%;">Nomor Agenda</th>
                                            <th style="width: 15%;">Judul Raperda</th>
                                            <th style="width: 15%;">Tanggal Waktu</th>
                                            <th style="width: 15%;">Tempat</th>
                                            <th style="width: 20%;">Agenda Paripurna</th>
                                            <th style="width: 10%;">Peserta</th>
                                            <th style="width: 10%;">Status Agenda</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($results)): ?>
                                            <?php foreach ($results as $row): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['nomor_agenda']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['judul_paripurna']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tgl_waktu']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tempat']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['agenda_paripurna']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['peserta']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['status_agenda']); ?></td>
                                                
                                                </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada jadwal rapat yang tersedia.</td>
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
