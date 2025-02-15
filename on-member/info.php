<?php
include '../session_start.php';  // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

// Cek apakah tanggal pencarian dipilih
if (isset($_POST['tanggal'])) {
    $tanggal_pencarian = $_POST['tanggal'];

    // Mengambil data informasi terbaru berdasarkan tanggal
    $sql = "SELECT * FROM info WHERE DATE(tanggal) = ? ORDER BY tanggal DESC";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $tanggal_pencarian);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    // Jika tidak ada tanggal yang dipilih, ambil informasi terbaru (1 data terbaru)
    $sql = "SELECT * FROM info ORDER BY tanggal DESC LIMIT 1";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

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
        <!-- Sidebar dan Navbar Anggota -->
        <?php include_once '../include/navbar_adm.php'; ?>
        <?php include_once '../include/sidebar_mbr.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Informasi Terbaru</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pencarian Tanggal -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Cari Informasi Berdasarkan Tanggal</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="tanggal">Pilih Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>

                    <!-- Menampilkan Informasi Terbaru Berdasarkan Tanggal -->
                    <?php if (isset($results) && !empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info"><?php echo htmlspecialchars($row['judul']); ?></h6>
                                </div>
                                <div class="card-body">
                                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                                    <small>Published on: <?php echo $row['tanggal']; ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif (isset($results)): ?>
                        <p class="text-center">Tidak ada informasi terbaru pada tanggal ini.</p>
                    <?php else: ?>
                        <!-- Jika tidak ada pencarian, tampilkan informasi terbaru -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-1 font-weight-bold text-info"><?php echo htmlspecialchars($result['judul']); ?></h6>
                            </div>
                            <div class="card-body">
                                <p><?php echo htmlspecialchars($result['deskripsi']); ?></p>
                                <small>Published on: <?php echo $result['tanggal']; ?></small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>

    <?php include_once '../include/footer.php'; ?>
    <?php include_once '../include/script.php'; ?>

</body>

</html>
