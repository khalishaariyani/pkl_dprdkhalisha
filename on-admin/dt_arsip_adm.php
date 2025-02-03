<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Form Arsip';
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

// Proses untuk menyimpan data Arsip
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $no_dokumen = $_POST['no_dokumen'];
    $jenis_dokumen = $_POST['jenis_dokumen'];
    $tgl_arsip = $_POST['tgl_arsip'];
    $keterangan = $_POST['ket'];
    $lampiran_dokumen = $_FILES['lampiran_dok']['name'];

    // Memindahkan file lampiran ke folder "uploads" jika ada
    if ($lampiran_dokumen) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($lampiran_dokumen);
        move_uploaded_file($_FILES["lampiran_dok"]["tmp_name"], $target_file);
    }

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO arsip (no_dokumen, jenis_dokumen, tgl_arsip, ket, lampiran_dok) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssss", $no_dokumen, $jenis_dokumen, $tgl_arsip, $keterangan, $lampiran_dokumen);

    if ($stmt->execute()) {
        echo "<script>alert('Data Arsip berhasil disimpan.'); window.location.href='dt_arsip_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_arsip_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Edit Data Arsip
if (isset($_GET['edit'])) {
    $id_arsip = $_GET['edit'];
    $sql = "SELECT * FROM arsip WHERE id_arsip = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_arsip);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (isset($_POST['update'])) {
        $no_dokumen = $_POST['no_dokumen'];
        $jenis_dokumen = $_POST['jenis_dokumen'];
        $tgl_arsip = $_POST['tgl_arsip'];
        $keterangan = $_POST['ket'];

        // Cek apakah file lampiran baru diupload
        $lampiran_dokumen = $_FILES['lampiran_dok']['name'];
        if ($lampiran_dokumen) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($lampiran_dokumen);
            move_uploaded_file($_FILES["lampiran_dok"]["tmp_name"], $target_file);
        } else {
            $lampiran_dokumen = $result['lampiran_dok']; // Tetap menggunakan file yang lama jika tidak ada file baru
        }

        $update_sql = "UPDATE arsip SET no_dokumen = ?, jenis_dokumen = ?, tgl_arsip = ?, ket = ?, lampiran_dok = ? WHERE id_arsip = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("sssssi", $no_dokumen, $jenis_dokumen, $tgl_arsip, $keterangan, $lampiran_dokumen, $id_arsip);

        if ($stmt->execute()) {
            echo "<script>alert('Data Arsip berhasil diperbarui.'); window.location.href='dt_arsip_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_arsip_adm.php';</script>";
        }
    }
}

// Proses untuk Hapus Data Arsip
if (isset($_GET['delete'])) {
    $id_arsip = $_GET['delete'];
    $delete_sql = "DELETE FROM arsip WHERE id_arsip = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_arsip);

    if ($stmt->execute()) {
        echo "<script>alert('Data Arsip berhasil dihapus.'); window.location.href='dt_arsip_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_arsip_adm.php';</script>";
    }
}

// Mengambil semua data arsip
$sql = "SELECT * FROM arsip";
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
                            <h1 class="m-0 text-dark">Form Arsip</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Arsip</a></li>
                                <li class="breadcrumb-item active">Form Arsip</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Form Arsip -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Arsip</h6>
                        </div>

                        <!-- Form untuk Edit atau Tambah Data -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="no_dokumen">No Dokumen</label>
                                            <input type="text" class="form-control" name="no_dokumen" value="<?= isset($result) ? $result['no_dokumen'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_dokumen">Jenis Dokumen</label>
                                            <input type="text" class="form-control" name="jenis_dokumen" value="<?= isset($result) ? $result['jenis_dokumen'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_arsip">Tanggal Arsip</label>
                                            <input type="date" class="form-control" name="tgl_arsip" value="<?= isset($result) ? $result['tgl_arsip'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ket">Keterangan</label>
                                            <textarea class="form-control" name="ket" required><?= isset($result) ? $result['ket'] : ''; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lampiran_dok">Lampiran Dokumen</label>
                                            <input type="file" class="form-control" name="lampiran_dok">
                                            <?php if (isset($result) && $result['lampiran_dok']): ?>
                                                <p>Current File: <a href="../uploads/<?= $result['lampiran_dok'] ?>" target="_blank"><?= $result['lampiran_dok'] ?></a></p>
                                            <?php endif; ?>
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

                    <!-- Tabel Data Arsip -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Arsip</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Arsip</th>
                                                <th>No Dokumen</th>
                                                <th>Jenis Dokumen</th>
                                                <th>Tanggal Arsip</th>
                                                <th>Keterangan</th>
                                                <th>Lampiran Dokumen</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['id_arsip']; ?></td>
                                                        <td><?php echo $row['no_dokumen']; ?></td>
                                                        <td><?php echo $row['jenis_dokumen']; ?></td>
                                                        <td><?php echo $row['tgl_arsip']; ?></td>
                                                        <td><?php echo $row['ket']; ?></td>
                                                        <td><a href="../uploads/<?php echo $row['lampiran_dok']; ?>" target="_blank">Lihat Lampiran</a></td>
                                                        <td>
                                                            <a href="?edit=<?php echo $row['id_arsip']; ?>">Edit</a> |
                                                            <a href="?delete=<?php echo $row['id_arsip']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data Arsip</td>
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