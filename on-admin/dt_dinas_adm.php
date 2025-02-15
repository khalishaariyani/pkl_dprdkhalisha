<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Form Dinas';
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

// Proses untuk menyimpan data Dinas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $nama_dinas = $_POST['nama_dinas'];
    $tujuan_dinas = $_POST['tujuan_dinas'];
    $nama_rapat = $_POST['nama_rapat'];
    $tempat_rapat = $_POST['tempat_rapat'];
    $tanggal_rapat = $_POST['tanggal_rapat'];
    $nama_pimpinan = $_POST['nama_pimpinan'];
    $jumlah_peserta = $_POST['jumlah_peserta'];
    $status = $_POST['status'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO dinas (id_karyawan, nama_dinas, tujuan_dinas, nama_rapat, tempat_rapat, tanggal_rapat, nama_pimpinan, jumlah_peserta, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssssssi", $id_karyawan, $nama_dinas, $tujuan_dinas, $nama_rapat, $tempat_rapat, $tanggal_rapat, $nama_pimpinan, $jumlah_peserta, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data Dinas berhasil disimpan.'); window.location.href='dt_dinas_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_dinas_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Edit Data Dinas
if (isset($_GET['edit'])) {
    $id_dinas = $_GET['edit'];
    $sql = "SELECT * FROM dinas WHERE id_dinas = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_dinas);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (isset($_POST['update'])) {
        $id_karyawan = $_POST['id_karyawan'];
        $nama_dinas = $_POST['nama_dinas'];
        $tujuan_dinas = $_POST['tujuan_dinas'];
        $nama_rapat = $_POST['nama_rapat'];
        $tempat_rapat = $_POST['tempat_rapat'];
        $tanggal_rapat = $_POST['tanggal_rapat'];
        $nama_pimpinan = $_POST['nama_pimpinan'];
        $jumlah_peserta = $_POST['jumlah_peserta'];
        $status = $_POST['status'];

        $update_sql = "UPDATE dinas SET id_karyawan = ?, nama_dinas = ?, tujuan_dinas = ?, nama_rapat = ?, tempat_rapat = ?, tanggal_rapat = ?, nama_pimpinan = ?, jumlah_peserta = ?, status = ? WHERE id_dinas = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("sssssssssi", $id_karyawan, $nama_dinas, $tujuan_dinas, $nama_rapat, $tempat_rapat, $tanggal_rapat, $nama_pimpinan, $jumlah_peserta, $status, $id_dinas);

        if ($stmt->execute()) {
            echo "<script>alert('Data Dinas berhasil diperbarui.'); window.location.href='dt_dinas_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_dinas_adm.php';</script>";
        }
    }
}

// Proses untuk Hapus Data Dinas
if (isset($_GET['delete'])) {
    $id_dinas = $_GET['delete'];
    $delete_sql = "DELETE FROM dinas WHERE id_dinas = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_dinas);

    if ($stmt->execute()) {
        echo "<script>alert('Data Dinas berhasil dihapus.'); window.location.href='dt_dinas_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_dinas_adm.php';</script>";
    }
}

// Mengambil semua data dinas
$sql = "SELECT * FROM dinas";
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
                            <h1 class="m-0 text-dark">Form Dinas</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Dinas</a></li>
                                <li class="breadcrumb-item active">Form Dinas</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Form Dinas -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Dinas</h6>
                        </div>

                        <!-- Form untuk Edit atau Tambah Data -->
                        <form action="" method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="id_karyawan">ID Karyawan</label>
                                            <input type="text" class="form-control" name="id_karyawan" value="<?= isset($result) ? $result['id_karyawan'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_dinas">Nama Dinas</label>
                                            <input type="text" class="form-control" name="nama_dinas" value="<?= isset($result) ? $result['nama_dinas'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tujuan_dinas">Tujuan Dinas</label>
                                            <input type="text" class="form-control" name="tujuan_dinas" value="<?= isset($result) ? $result['tujuan_dinas'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_rapat">Nama Rapat</label>
                                            <input type="text" class="form-control" name="nama_rapat" value="<?= isset($result) ? $result['nama_rapat'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tempat_rapat">Tempat Rapat</label>
                                            <input type="text" class="form-control" name="tempat_rapat" value="<?= isset($result) ? $result['tempat_rapat'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_rapat">Tanggal Rapat</label>
                                            <input type="date" class="form-control" name="tanggal_rapat" value="<?= isset($result) ? $result['tanggal_rapat'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_pimpinan">Nama Pimpinan</label>
                                            <input type="text" class="form-control" name="nama_pimpinan" value="<?= isset($result) ? $result['nama_pimpinan'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_peserta">Jumlah Peserta</label>
                                            <input type="number" class="form-control" name="jumlah_peserta" value="<?= isset($result) ? $result['jumlah_peserta'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Tugas Dinas</label>
                                            <input type="text" class="form-control" name="status" value="<?= isset($result) ? $result['status'] : ''; ?>" required>
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

                    <!-- Tabel Data Dinas -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Dinas</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dinas</th>
                                                <th>Tujuan Dinas</th>
                                                <th>Nama Rapat</th>
                                                <th>Tempat Rapat</th>
                                                <th>Tanggal Rapat</th>
                                                <th>Nama Pimpinan</th>
                                                <th>Jumlah Peserta</th>
                                                <th>Tugas Dinas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php $no = 1; // Inisialisasi nomor urut 
                                                ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td> <!-- Nomor urut otomatis -->
                                                        <td><?php echo $row['nama_dinas']; ?></td>
                                                        <td><?php echo $row['tujuan_dinas']; ?></td>
                                                        <td><?php echo $row['nama_rapat']; ?></td>
                                                        <td><?php echo $row['tempat_rapat']; ?></td>
                                                        <td><?php echo $row['tanggal_rapat']; ?></td>
                                                        <td><?php echo $row['nama_pimpinan']; ?></td>
                                                        <td><?php echo $row['jumlah_peserta']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td>
                                                            <a href="?edit=<?php echo $row['id_dinas']; ?>">Edit</a> |
                                                            <a href="?delete=<?php echo $row['id_dinas']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">Tidak ada data Dinas</td>
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