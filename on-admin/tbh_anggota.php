<?php
include '../session_start.php'; // Karena session_start.php ada di root folder
include '../include/env.config.php'; // Karena env.config.php ada di folder include

if (isset($_GET['menu'])) {

    $menu = $_GET['menu'];
} else {
    $menu = 'Dashboard';
}

if (empty($_SESSION)) {
    include_once './login.php';
    include_once './include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

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
                        <button onclick="window.history.back();" class="btn btn-secondary mr-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </button>
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Anggota Rapat</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Tambah Anggota</a></li>
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
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- Full-width column -->
                        <div class="col-md-12">
                            <!-- General Form Elements -->
                            <div class="card card-primary shadow">
                                <div class="card-header">
                                    <h3 class="card-title">Formulir Tambah Anggota</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- Form start -->
                                <form action="check_petugas.php" method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="namaLengkap" class="font-weight-bold">Nama Lengkap</label>
                                                    <input type="text" class="form-control rounded-pill" id="namaLengkap" name="nama" placeholder="Masukkan nama lengkap" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username" class="font-weight-bold">Username</label>
                                                    <input type="text" class="form-control rounded-pill" id="username" name="username" placeholder="Masukkan username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="font-weight-bold">Email</label>
                                                    <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Masukkan email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password" class="font-weight-bold">Password</label>
                                                    <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Masukkan password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="level" class="font-weight-bold">Level</label>
                                            <input type="text" class="form-control rounded-pill bg-light" id="level" name="level" value="anggota" readonly>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary px-5 rounded-pill">Simpan</button>
                                        <button type="reset" class="btn btn-secondary px-5 rounded-pill">Reset</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col -->
                    </div>
                </div>
            </section>


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