<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Form Kehadiran';
}

if (empty($_SESSION)) {
    include_once './login.php';
    include_once './include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Fungsi untuk menjalankan query dan mengambil satu nilai dari hasilnya
function get_single_value($koneksi, $query, $types = "", $params = [])
{
    $stmt = $koneksi->prepare($query);
    if ($types && $params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->num_rows > 0 ? $result->fetch_assoc() : null;
    $stmt->close();
    return $value;
}

// Proses untuk menyimpan data Kehadiran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $no_anggota = $_POST['no_anggota'];
    $status_kehadiran = $_POST['status_kehadiran'];
    $tgl_kehadiran = $_POST['tgl_kehadiran'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO kehadiran (nama, no_anggota, status_kehadiran, tgl_kehadiran) 
            VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssss", $nama, $no_anggota, $status_kehadiran, $tgl_kehadiran);

    if ($stmt->execute()) {
        echo "<script>alert('Data Kehadiran berhasil disimpan.'); window.location.href='dt_kehadiran_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_kehadiran_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Edit Data Kehadiran
if (isset($_GET['edit'])) {
    $id_kehadiran = $_GET['edit'];
    $sql = "SELECT * FROM kehadiran WHERE id_kehadiran = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_kehadiran);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $no_anggota = $_POST['no_anggota'];
        $status_kehadiran = $_POST['status_kehadiran'];
        $tgl_kehadiran = $_POST['tgl_kehadiran'];

        $update_sql = "UPDATE kehadiran SET nama = ?, no_anggota = ?, status_kehadiran = ?,  tgl_kehadiran = ? WHERE id_kehadiran = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("ssssi", $nama, $no_anggota, $status_kehadiran, $tgl_kehadiran, $id_kehadiran);

        if ($stmt->execute()) {
            echo "<script>alert('Data Kehadiran berhasil diperbarui.'); window.location.href='dt_kehadiran_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_kehadiran_adm.php';</script>";
        }
    }
}

// Proses untuk Hapus Data Kehadiran
if (isset($_GET['delete'])) {
    $id_kehadiran = $_GET['delete'];
    $delete_sql = "DELETE FROM kehadiran WHERE id_kehadiran = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_kehadiran);

    if ($stmt->execute()) {
        echo "<script>alert('Data Kehadiran berhasil dihapus.'); window.location.href='dt_kehadiran_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_kehadiran_adm.php';</script>";
    }
}

// Mengambil semua data kehadiran
$sql = "SELECT * FROM kehadiran";
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
    <?php
    include_once '../include/head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        include_once '../include/navbar_adm.php';
        include_once '../include/sidebar_adm.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Form Kehadiran</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Kehadiran</a></li>
                                <li class="breadcrumb-item active">Form Kehadiran</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Form Kehadiran -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Kehadiran</h6>
                        </div>

                        <!-- Form untuk Edit atau Tambah Data -->
                        <form action="" method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama">Nama Anggota</label>
                                            <input type="text" class="form-control" name="nama" value="<?= isset($result) ? $result['nama'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_anggota">No Anggota</label>
                                            <input type="text" class="form-control" name="no_anggota" value="<?= isset($result) ? $result['no_anggota'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status_kehadiran">Status Kehadiran</label>
                                            <input type="text" class="form-control" name="status_kehadiran" value="<?= isset($result) ? $result['status_kehadiran'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_kehadiran">Tanggal Hadir</label>
                                            <input type="date" class="form-control" name="tgl_kehadiran" value="<?= isset($result) ? $result['tgl_kehadiran'] : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-4 text-center">
                                <?php if (isset($_GET['edit'])): ?>
                                    <!-- Menampilkan tombol Update hanya jika dalam mode edit -->
                                    <button type="submit" name="update" class="btn btn-warning">Update Raperda</button>
                                <?php else: ?>
                                    <!-- Menampilkan tombol Simpan hanya jika dalam mode tambah data -->
                                    <button type="submit" name="create" class="btn btn-primary">Simpan Raperda</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Data Kehadiran -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Kehadiran</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama Anggota</th>
                                                <th>No Anggota</th>
                                                <th>Status Kehadiran</th>
                                                <th>Tanggal Kehadiran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['id_kehadiran']; ?></td>
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
                                                    <td colspan="5" class="text-center">Tidak ada data Kehadiran</td>
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

    <?php
    include_once '../include/footer.php';
    include_once '../include/script.php';
    ?>

</body>

</html>