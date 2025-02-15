<?php
session_start();
include '../include/env.config.php'; // Koneksi ke database

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// Mengambil semua data raperda dari database
$sql = "SELECT * FROM raperda";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Menutup koneksi database
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
                            <h1 class="m-0 text-dark"> Rapat Dewan Perwakilan Rakyat Daerah Kota Banjarmasin</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Hasil Keputusan Rapat -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info"> Keputisan Hasil Rapat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mx-auto" style="width: 90%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th style="width: 15%;">Nomor Raperda</th>
                                            <th style="width: 12%;">Tanggal Masuk</th>
                                            <th style="width: 12%;">Status Raperda</th>
                                            <th style="width: 15%;">Pengusul</th>
                                            <th style="width: 20%;">Judul Raperda</th>
                                            <th style="width: 20%;">Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($results)): ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($results as $row): ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo htmlspecialchars($row['nomor_raperda']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tgl_masuk']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['status_raperda']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['pengusul']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['judul_raperda']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['catatan']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data keputusan rapat tersedia.</td>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
