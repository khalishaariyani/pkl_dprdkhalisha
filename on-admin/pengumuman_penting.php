<?php
session_start();
include '../include/env.config.php'; // Koneksi ke database

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// Proses untuk menyimpan pengumuman penting
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_pengumuman'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d H:i:s");

    // Query untuk memasukkan data ke tabel pengumuman
    $sql = "INSERT INTO info (judul, deskripsi, tanggal) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $judul, $deskripsi, $tanggal);

    if ($stmt->execute()) {
        echo "<script>alert('Pengumuman berhasil disimpan.'); window.location.href='pengumuman_penting.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='pengumuman_penting.php';</script>";
    }

    $stmt->close();
}

// Proses untuk menghapus pengumuman
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM info WHERE id = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengumuman berhasil dihapus.'); window.location.href='pengumuman_penting.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='pengumuman_penting.php';</script>";
    }
    $stmt->close();
}

// Proses untuk mengambil data untuk edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM info WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Proses untuk update pengumuman penting
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_pengumuman'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk update pengumuman
    $sql = "UPDATE info SET judul = ?, deskripsi = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $judul, $deskripsi, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengumuman berhasil diperbarui.'); window.location.href='pengumuman_penting.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='pengumuman_penting.php';</script>";
    }
    $stmt->close();
}

// Mengambil data pengumuman penting
$sql = "SELECT * FROM info ORDER BY tanggal DESC";  
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
        <!-- Sidebar dan Navbar Admin -->
        <?php include_once '../include/navbar_adm.php'; ?>
        <?php include_once '../include/sidebar_adm.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Pengumuman Penting</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Agenda Rapat -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Pengumuman</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mx-auto" style="width: 90%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Judul Pengumuman</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($results)): ?>
                                            <?php foreach ($results as $row): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada pengumuman tersedia.</td>
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

    <?php include_once '../include/footer.php'; ?>
    <?php include_once '../include/script.php'; ?>

</body>

</html>
