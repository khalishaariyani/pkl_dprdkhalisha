<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

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

// Proses untuk Menambahkan Data Karyawan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $departemen = $_POST['departemen'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];
    $status = $_POST['status'];

    $sql = "INSERT INTO karyawan (nama, jabatan, departemen, tanggal_lahir, tanggal_bergabung, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssss", $nama, $jabatan, $departemen, $tanggal_lahir, $tanggal_bergabung, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data Karyawan berhasil disimpan.'); window.location.href='dt_karyawan_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_karyawan_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Mengedit Data Karyawan
if (isset($_GET['edit'])) {
    $id_karyawan = $_GET['edit'];
    $sql = "SELECT * FROM karyawan WHERE id_karyawan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_karyawan);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $departemen = $_POST['departemen'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tanggal_bergabung = $_POST['tanggal_bergabung'];
        $status = $_POST['status'];

        $update_sql = "UPDATE karyawan SET nama = ?, jabatan = ?, departemen = ?, tanggal_lahir = ?, tanggal_bergabung = ?, status = ? WHERE id_karyawan = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("ssssssi", $nama, $jabatan, $departemen, $tanggal_lahir, $tanggal_bergabung, $status, $id_karyawan);

        if ($stmt->execute()) {
            echo "<script>alert('Data Karyawan berhasil diperbarui.'); window.location.href='dt_karyawan_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_karyawan_adm.php';</script>";
        }

        $stmt->close();
    }
}

// Proses untuk Menghapus Data Karyawan
if (isset($_GET['delete'])) {
    $id_karyawan = $_GET['delete'];
    $delete_sql = "DELETE FROM karyawan WHERE id_karyawan = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_karyawan);

    if ($stmt->execute()) {
        echo "<script>alert('Data Karyawan berhasil dihapus.'); window.location.href='dt_karyawan_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.'); window.location.href='dt_karyawan_adm.php';</script>";
    }

    $stmt->close();
}

// Ambil data karyawan
$sql = "SELECT * FROM karyawan";
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
        <?php include_once '../include/navbar_adm.php'; ?>
        <?php include_once '../include/sidebar_adm.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Data Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                                <li class="breadcrumb-item active">Data Karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Karyawan -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Karyawan</h6>
                        </div>
                        <form action="" method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= isset($row) ? $row['nama'] : '' ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" class="form-control" name="jabatan" value="<?= isset($row) ? $row['jabatan'] : '' ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departemen">Departemen</label>
                                            <input type="text" class="form-control" name="departemen" value="<?= isset($row) ? $row['departemen'] : '' ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?= isset($row) ? $row['tanggal_lahir'] : '' ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_bergabung">Tanggal Bergabung</label>
                                            <input type="date" class="form-control" name="tanggal_bergabung" value="<?= isset($row) ? $row['tanggal_bergabung'] : '' ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" name="status" value="<?= isset($row) ? $row['status'] : '' ?>" required>
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

                    <!-- Tabel Data Karyawan -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Departemen</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Tanggal Bergabung</th>
                                                <th>Status</th>
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
                                                        <td><?php echo $row['nama']; ?></td>
                                                        <td><?php echo $row['jabatan']; ?></td>
                                                        <td><?php echo $row['departemen']; ?></td>
                                                        <td><?php echo $row['tanggal_lahir']; ?></td>
                                                        <td><?php echo $row['tanggal_bergabung']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td>
                                                            <a href="dt_karyawan_adm.php?edit=<?php echo $row['id_karyawan']; ?>">Edit</a> |
                                                            <a href="dt_karyawan_adm.php?delete=<?php echo $row['id_karyawan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data Karyawan</td>
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