<?php
include '../session_start.php';  // Untuk memulai session
include '../include/env.config.php'; // Koneksi ke database

// Mengambil semua data jadwal yang sudah disimpan oleh admin
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
    <?php include_once '../include/head.php'; ?>
    <!-- Pastikan Bootstrap CSS sudah dimasukkan di sini -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        // Menyertakan navbar dan sidebar jika diperlukan
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Jadwal Rapat Paripurna</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Jadwal -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-info">Data Jadwal Paripurna</h6>
                        </div>
                        <div class="card-body">
                            <!-- Menambahkan class table-responsive agar tabel responsif -->
                            <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover mx-auto" style="width: 90%; margin-left: 5%; margin-right: 5%;">
        <thead class="thead-dark">
            <tr>
                <th style="width: 12%;">Nomor Agenda</th>
                <th style="width: 18%;">Judul Raperda</th>
                <th style="width: 15%;">Tanggal Waktu</th>
                <th style="width: 18%;">Tempat</th>
                <th style="width: 20%;">Agenda Paripurna</th>
                <th style="width: 10%;">Peserta</th>
                <th style="width: 10%;">Status Agenda</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nomor_agenda']); ?></td>
                        <td><?php echo htmlspecialchars($row['judul_paripurna']); ?></td>
                        <td><?php echo htmlspecialchars($row['tgl_waktu']); ?></td>
                        <td><?php echo htmlspecialchars($row['tempat']); ?></td>
                        <td><?php echo htmlspecialchars($row['agenda_paripurna']); ?></td>
                        <td><?php echo htmlspecialchars($row['peserta']); ?></td>
                        <td><?php echo htmlspecialchars($row['status_agenda']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada jadwal rapat yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="br_member.php" class="btn btn-primary">Kembali Halaman</a>
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

    <!-- Menambahkan Bootstrap dan JavaScript jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
