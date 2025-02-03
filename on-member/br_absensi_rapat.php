<?php
include '../session_start.php'; // Karena session_start.php ada di root folder
include '../include/env.config.php'; // Karena env.config.php ada di folder include

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
} else {
    $menu = 'Manajemen Rapat';
}

if (empty($_SESSION)) {
    include_once 'login.php';
    include_once 'include/login.php';
}

// Mengambil ID pengguna yang sedang login dari session
$id = $_SESSION['id'];

// Fungsi untuk mengambil data pengguna


// Mendapatkan data pengguna


// Proses pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_instansi = $_POST['nama_instansi'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $pekerjaan = $_POST['pekerjaan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $bentuk_kegiatan = $_POST['bentuk_kegiatan'];
    $waktu = $_POST['waktu'];
    $tempat = $_POST['tempat'];
    $rangka = $_POST['rangka'];
    $jumlah_peserta = $_POST['jumlah_peserta'];
    $berkas = '';

    // Proses unggah file
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] == 0) {
        $upload_dir = '../Berkas/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_tmp = $_FILES['berkas_persyaratan']['tmp_name'];
        $file_name = basename($_FILES['berkas_persyaratan']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $berkas_persyaratan = $target_file;
        } else {
            echo "<script>alert('Gagal mengunggah file.'); window.history.back();</script>";
            exit;
        }
    }

    // Simpan data ke database
    $stmt = $koneksi->prepare("
        INSERT INTO berkas_pemohon 
        (nama_instansi, penanggung_jawab, pekerjaan, alamat, no_hp, bentuk_kegiatan, waktu, tempat, rangka, peserta, berkas) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "sssssssssssi",
        $nama_instansi,
        $penanggung_jawab,
        $pekerjaan,
        $alamat,
        $no_hp,
        $bentuk_kegiatan,
        $waktu,
        $tempat,
        $rangka,
        $jumlah_peserta,
        $berkas,
    );

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan.'); window.location.href='formulir_berkas.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}

// Menutup koneksi database
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
        <?php include_once '../include/sidebar_mbr.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active"><?= $menu ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../include/footer.php'; ?>
    <?php include_once '../include/script.php'; ?>
</body>

</html>