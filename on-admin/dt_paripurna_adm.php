<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Form Jadwal Rapat';
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

// Proses untuk menyimpan data Jadwal Rapat
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $nomor_agenda = $_POST['nomor_agenda'];
    $judul_paripurna = $_POST['judul_paripurna'];
    $tgl_waktu = $_POST['tgl_waktu'];
    $tempat = $_POST['tempat'];
    $agenda_paripurna = $_POST['agenda_paripurna'];
    $peserta = $_POST['peserta'];
    $status_agenda = $_POST['status_agenda'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO jadwal (nomor_agenda, judul_paripurna, tgl_waktu, tempat, agenda_paripurna, peserta, status_agenda) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssssss", $nomor_agenda, $judul_paripurna, $tgl_waktu, $tempat, $agenda_paripurna, $peserta, $status_agenda);

    if ($stmt->execute()) {
        echo "<script>alert('Data Jadwal Rapat berhasil disimpan.'); window.location.href='dt_paripurna_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_paripurna_adm.php';</script>";
    }

    $stmt->close();
}

// Proses untuk Edit Data Jadwal
if (isset($_GET['edit'])) {
    $id_jadwal = $_GET['edit'];
    $sql = "SELECT * FROM jadwal WHERE id_jadwal = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (isset($_POST['update'])) {
        $nomor_agenda = $_POST['nomor_agenda'];
        $judul_paripurna = $_POST['judul_paripurna'];
        $tgl_waktu = $_POST['tgl_waktu'];
        $tempat = $_POST['tempat'];
        $agenda_paripurna = $_POST['agenda_paripurna'];
        $peserta = $_POST['peserta'];
        $status_agenda = $_POST['status_agenda'];

        $update_sql = "UPDATE jadwal SET nomor_agenda = ?, judul_paripurna = ?, tgl_waktu = ?, tempat = ?, agenda_paripurna = ?, peserta = ?, status_agenda = ? WHERE id_jadwal = ?";
        $stmt = $koneksi->prepare($update_sql);
        $stmt->bind_param("sssssssi", $nomor_agenda, $judul_paripurna, $tgl_waktu, $tempat, $agenda_paripurna, $peserta, $status_agenda, $id_jadwal);

        if ($stmt->execute()) {
            echo "<script>alert('Data Jadwal Rapat berhasil diperbarui.'); window.location.href='dt_paripurna_adm.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_paripurna_adm.php';</script>";
        }
    }
}

// Proses untuk Hapus Data Jadwal
if (isset($_GET['delete'])) {
    $id_jadwal = $_GET['delete'];
    $delete_sql = "DELETE FROM jadwal WHERE id_jadwal = ?";
    $stmt = $koneksi->prepare($delete_sql);
    $stmt->bind_param("i", $id_jadwal);

    if ($stmt->execute()) {
        echo "<script>alert('Data Jadwal Rapat berhasil dihapus.'); window.location.href='dt_paripurna_adm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.location.href='dt_paripurna_adm.php';</script>";
    }
}

// Mengambil semua data jadwal
$sql = "SELECT * FROM jadwal";
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
                            <h1 class="m-0 text-dark">Form Jadwal Rapat</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                                <li class="breadcrumb-item active">Form Jadwal Rapat</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Form Jadwal Rapat -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Form Jadwal Rapat</h6>
                        </div>

                        <!-- Form untuk Edit atau Tambah Data -->
                        <form action="" method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nomor_agenda">Nomor Agenda</label>
                                            <input type="text" class="form-control" name="nomor_agenda" value="<?= isset($result) ? $result['nomor_agenda'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="judul_paripurna">Judul Raperda</label>
                                            <input type="text" class="form-control" name="judul_paripurna" value="<?= isset($result) ? $result['judul_paripurna'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_waktu">Tanggal Waktu</label>
                                            <input type="datetime-local" class="form-control" name="tgl_waktu" value="<?= isset($result) ? $result['tgl_waktu'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tempat">Tempat</label>
                                            <input type="text" class="form-control" name="tempat" value="<?= isset($result) ? $result['tempat'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agenda_paripurna">Agenda Paripurna</label>
                                            <input type="text" class="form-control" name="agenda_paripurna" value="<?= isset($result) ? $result['agenda_paripurna'] : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="peserta">Peserta</label>
                                            <textarea class="form-control" name="peserta" required><?= isset($result) ? $result['peserta'] : ''; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status_agenda">Status Agenda</label>
                                            <input type="text" class="form-control" name="status_agenda" value="<?= isset($result) ? $result['status_agenda'] : ''; ?>" required>
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

                    <!-- Tabel Data Jadwal -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Jadwal</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Jadwal</th>
                                                <th>Nomor Agenda</th>
                                                <th>Judul Raperda</th>
                                                <th>Tanggal Waktu</th>
                                                <th>Tempat</th>
                                                <th>Agenda Paripurna</th>
                                                <th>Peserta</th>
                                                <th>Status Agenda</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['id_jadwal']; ?></td>
                                                        <td><?php echo $row['nomor_agenda']; ?></td>
                                                        <td><?php echo $row['judul_paripurna']; ?></td>
                                                        <td><?php echo $row['tgl_waktu']; ?></td>
                                                        <td><?php echo $row['tempat']; ?></td>
                                                        <td><?php echo $row['agenda_paripurna']; ?></td>
                                                        <td><?php echo $row['peserta']; ?></td>
                                                        <td><?php echo $row['status_agenda']; ?></td>
                                                        <td>
                                                            <a href="?edit=<?php echo $row['id_jadwal']; ?>">Edit</a> |
                                                            <a href="?delete=<?php echo $row['id_jadwal']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data Jadwal</td>
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
