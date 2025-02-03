<?php
include '../session_start.php'; // Karena session_start.php ada di root folder
include '../include/env.config.php'; // Karena env.config.php ada di folder include

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Beranda';
}

if (empty($_SESSION)) {
    include_once 'login.php';
    include_once 'include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Fungsi untuk mengambil data pengguna





// Mendapatkan data pengguna


// Menutup koneksi database
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
        include_once '../include/sidebar_mbr.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">Survey Kepuasan</h5>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <!-- Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <!-- Pendidikan -->
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <select class="form-control" id="pendidikan" name="pendidikan">
                                    <option value="">Pilih</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Sarjana">Sarjana</option>
                                    <option value="Magister">Magister</option>
                                    <option value="Doktor">Doktor</option>
                                </select>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <select class="form-control" id="pekerjaan" name="pekerjaan">
                                    <option value="">Pilih</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- Pertanyaan Survey -->
                            <h5 class="mt-4">Pendapat Responden Tentang Pelayanan</h5>
                            <?php
                            $questions = [
                                "Bagaimana pendapat Saudara tentang kesesuaian persyaratan yang ditentukan dengan jenis pelayanan?",
                                "Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan unit ini?",
                                "Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?",
                                "Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?",
                                "Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?",
                                "Bagaimana pendapat Saudara tentang kompetensi/keterampilan petugas dalam pelayanan?",
                                "Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?",
                                "Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?",
                                "Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?"
                            ];

                            foreach ($questions as $index => $question) {
                                echo '
                        <div class="form-group">
                            <label for="question_' . ($index + 1) . '">' . ($index + 1) . '. ' . $question . '</label>
                            <select class="form-control" id="question_' . ($index + 1) . '" name="question_' . ($index + 1) . '">
                                <option value="">Pilih Jawaban</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Cukup Puas">Cukup Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Sangat Puas">Sangat Puas</option>
                            </select>
                        </div>
                    ';
                            }
                            ?>

                            <!-- Tombol Kirim -->
                            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include_once '../include/footer.php';
    ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php
    include_once '../include/script.php';
    ?>

</body>

</html>