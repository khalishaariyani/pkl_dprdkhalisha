<?php
include '../session_start.php'; // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Laporan Jadwal Rapat';
}

if (empty($_SESSION)) {
    include_once './login.php';
    include_once './include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Proses untuk Filter dan Pencarian
$whereClause = "";
if (isset($_POST['search'])) {
    $nomor_agenda = $_POST['nomor_agenda'];
    $judul_paripurna = $_POST['judul_paripurna'];

    if ($nomor_agenda != "") {
        $whereClause .= " AND nomor_agenda LIKE '%$nomor_agenda%'";
    }

    if ($judul_paripurna != "") {
        $whereClause .= " AND judul_paripurna LIKE '%$judul_paripurna%'";
    }
}

// Mengambil semua data jadwal rapat dengan filter
$sql = "SELECT * FROM jadwal WHERE 1=1" . $whereClause;
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
        <?php
        include_once '../include/navbar_adm.php';
        include_once '../include/sidebar_adm.php';
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Laporan Jadwal Rapat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Rapat</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan Jadwal Rapat Form -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Filter Jadwal Rapat</h6>
                        </div>
                        <form method="POST">
                            <div class="m-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nomor_agenda">Nomor Agenda</label>
                                            <input type="text" class="form-control" name="nomor_agenda" placeholder="Masukkan Nomor Agenda">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="judul_paripurna">Judul Rapat</label>
                                            <input type="text" class="form-control" name="judul_paripurna" placeholder="Masukkan Judul Rapat">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="search" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Laporan Jadwal Rapat -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-1 font-weight-bold text-info">Data Jadwal Rapat</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Jadwal</th>
                                                <th>Nomor Agenda</th>
                                                <th>Judul Rapat</th>
                                                <th>Tanggal & Waktu</th>
                                                <th>Tempat</th>
                                                <th>Agenda</th>
                                                <th>Peserta</th>
                                                <th>Status</th>
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
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data jadwal rapat</td>
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
