<?php
include '../session_start.php';  // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

// Proses untuk menyimpan informasi terbaru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_info'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d H:i:s");

    // Query untuk memasukkan data informasi terbaru ke tabel
    $sql = "INSERT INTO info (judul, deskripsi, tanggal) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $judul, $deskripsi, $tanggal);

    if ($stmt->execute()) {
        echo "<script>alert('Informasi Terbaru berhasil disimpan.'); window.location.href='informasi_terbaru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='informasi_terbaru.php';</script>";
    }

    $stmt->close();
}

// Proses untuk menghapus informasi terbaru
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM info WHERE id = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Informasi Terbaru berhasil dihapus.'); window.location.href='informasi_terbaru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='informasi_terbaru.php';</script>";
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

// Proses untuk update informasi terbaru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_info'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Query untuk update informasi terbaru
    $sql = "UPDATE info SET judul = ?, deskripsi = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $judul, $deskripsi, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Informasi Terbaru berhasil diperbarui.'); window.location.href='informasi_terbaru.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='informasi_terbaru.php';</script>";
    }
    $stmt->close();
}

// Mengambil data informasi terbaru
$sql = "SELECT * FROM info ORDER BY tanggal DESC";  // Mengambil semua data informasi terbaru
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
        <!-- Sidebar dan Navbar Admin -->
        <?php include_once '../include/navbar_adm.php'; ?>
        <?php include_once '../include/sidebar_adm.php'; ?>

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

            <!-- Form Input Informasi -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Informasi Terbaru</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="judul">Judul Informasi</label>
                                    <input type="text" class="form-control" name="judul" value="<?= isset($result) ? htmlspecialchars($result['judul']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Informasi</label>
                                    <textarea class="form-control" name="deskripsi" rows="5" required><?= isset($result) ? htmlspecialchars($result['deskripsi']) : ''; ?></textarea>
                                </div>
                                <?php if (isset($result)): ?>
                                    <input type="hidden" name="id" value="<?= $result['id']; ?>">
                                    <button type="submit" name="update_info" class="btn btn-warning"><i class="fas fa-edit"></i> Update Informasi</button>
                                <?php else: ?>
                                    <button type="submit" name="submit_info" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Informasi</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>

                    <!-- Menampilkan Data Informasi Terbaru dalam Tabel -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Data Informasi Terbaru</h6>
                        </div>
                        <div class="card-body">
                            <!-- Tabel untuk menampilkan data -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Judul Informasi</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($results)): ?>
                                            <?php foreach ($results as $row): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                                    <td class="text-center">
                                                        <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning text-white" data-toggle="tooltip" data-placement="top" title="Edit Informasi">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger text-white" data-toggle="tooltip" data-placement="top" title="Hapus Informasi">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada informasi terbaru.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Tambahkan CSS untuk efek hover -->
            <style>
                .btn-warning,
                .btn-danger {
                    transition: all 0.3s ease;
                }

                .btn-warning:hover {
                    background-color: #d39e00;
                    transform: scale(1.05);
                }

                .btn-danger:hover {
                    background-color: #a71d2a;
                    transform: scale(1.05);
                }
            </style>

            <!-- Tambahkan JavaScript untuk tooltip -->
            <script>
                $(document).ready(function() {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>

        </div>
    </div>

    <?php include_once '../include/footer.php'; ?>
    <?php include_once '../include/script.php'; ?>

</body>

</html>