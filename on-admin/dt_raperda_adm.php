<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Form Raperda';
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

// Proses untuk menyimpan data Raperda
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $nomor_raperda = $_POST['nomor_raperda'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $status_raperda = $_POST['status_raperda'];
    $pengusul = $_POST['pengusul'];
    $judul_raperda = $_POST['judul_raperda'];
    $catatan = $_POST['catatan'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO raperda (nomor_raperda, tgl_masuk, status_raperda, pengusul, judul_raperda, catatan) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssss", $nomor_raperda, $tgl_masuk, $status_raperda, $pengusul, $judul_raperda, $catatan);

    if ($stmt->execute()) {
        echo "<script>alert('Data Raperda berhasil disimpan.'); window.location.href='dt_raperda_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_raperda_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Edit Data Raperda
if (isset($_GET['edit'])) {
    $id_raperda = $_GET['edit'];
    $sql = "SELECT * FROM raperda WHERE id_raperda = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_raperda);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (isset($_POST['update'])) {
        $nomor_raperda = $_POST['nomor_raperda'];
        $judul_raperda = $_POST['judul_raperda'];
        $tgl_masuk = $_POST['tgl_masuk'];
        $status_raperda = $_POST['status_raperda'];
        $pengusul = $_POST['pengusul'];
        $catatan = $_POST['catatan'];

        $update_sql = "UPDATE raperda SET nomor_raperda = ?, judul_raperda = ?, tgl_masuk = ?, status_raperda = ?, pengusul = ?, catatan = ? WHERE id_raperda = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("ssssssi", $nomor_raperda, $judul_raperda, $tgl_masuk, $status_raperda, $pengusul, $catatan, $id_raperda);

        if ($stmt->execute()) {
            echo "<script>alert('Data Raperda berhasil diperbarui.'); window.location.href='dt_raperda_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_raperda_adm.php';</script>";
        }
    }
}

// Proses untuk Hapus Data Raperda
if (isset($_GET['delete'])) {
    $id_raperda = $_GET['delete'];
    $delete_sql = "DELETE FROM raperda WHERE id_raperda = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_raperda);

    if ($stmt->execute()) {
        echo "<script>alert('Data Raperda berhasil dihapus.'); window.location.href='dt_raperda_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_raperda_adm.php';</script>";
    }
}

// Mengambil semua data raperda
$sql = "SELECT * FROM raperda";
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
                            <h1 class="m-0 text-dark">Form Raperda</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Form Raperda -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Raperda</h6>
                        </div>

                        <!-- Form untuk Edit atau Tambah Data -->
                        <form action="" method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nomor_raperda">Nomor Raperda</label>
                                            <input type="text" class="form-control" name="nomor_raperda" value="<?= isset($result) ? $result['nomor_raperda'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" name="tgl_masuk" value="<?= isset($result) ? $result['tgl_masuk'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status_raperda">Status Raperda</label>
                                            <input type="text" class="form-control" name="status_raperda" value="<?= isset($result) ? $result['status_raperda'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pengusul">Pengusul</label>
                                            <input type="text" class="form-control" name="pengusul" value="<?= isset($result) ? $result['pengusul'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="judul_raperda">Judul Raperda</label>
                                            <input type="text" class="form-control" name="judul_raperda" value="<?= isset($result) ? $result['judul_raperda'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="catatan">Catatan</label>
                                            <textarea class="form-control" name="catatan" required><?= isset($result) ? $result['catatan'] : ''; ?></textarea>
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

                    <!-- Tabel Data Raperda -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Raperda</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Raperda</th>
                                                <th>Nomor Raperda</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Status Raperda</th>
                                                <th>Pengusul</th>
                                                <th>Judul Raperda</th>
                                                <th>Catatan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['id_raperda']; ?></td>
                                                        <td><?php echo $row['nomor_raperda']; ?></td>
                                                        <td><?php echo $row['tgl_masuk']; ?></td>
                                                        <td><?php echo $row['status_raperda']; ?></td>
                                                        <td><?php echo $row['pengusul']; ?></td>
                                                        <td><?php echo $row['judul_raperda']; ?></td>
                                                        <td><?php echo $row['catatan']; ?></td>
                                                        <td>
                                                            <a href="?edit=<?php echo $row['id_raperda']; ?>">Edit</a> |
                                                        <td>
                                                        <a href="laporan_berita_acara.php?id=<?= $row['id_raperda']; ?>" target="_blank">Cetak</a>

                                                        </td>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data Raperda</td>
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