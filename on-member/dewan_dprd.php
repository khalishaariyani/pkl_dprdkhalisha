<?php
include '../session_start.php';  // Memulai session
include '../include/env.config.php'; // Koneksi ke database

// **Konfigurasi Google API (Opsional, Bisa Dimatikan)**
$use_google_api = false; // Ubah ke "true" jika ingin menampilkan hasil dari Google
$api_key = "YOUR_GOOGLE_API_KEY"; // Ganti dengan API Key Google Anda
$search_engine_id = "YOUR_SEARCH_ENGINE_ID"; // Ganti dengan Search Engine ID Anda
$query = "Dewan DPRD Kota Banjarmasin Periode 2024-2029";
$search_results = [];

// **Ambil data dari Google jika API aktif**
if ($use_google_api) {
    $url = "https://www.googleapis.com/customsearch/v1?q=" . urlencode($query) . "&key=$api_key&cx=$search_engine_id";
    $response = file_get_contents($url);
    $search_results = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php include_once '../include/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Sidebar dan Navbar Admin -->
        <?php include_once '../include/navbar_adm.php'; ?>
        <?php include_once '../include/sidebar_mbr.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dewan DPRD Kota Banjarmasin Periode 2024-2029</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Konten -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-danger">Informasi Tentang Dewan DPRD</h6>
                        </div>
                        <div class="card-body">
                            <!-- ✅ Menampilkan Informasi Statis -->
                            <h4>🔹 Apa itu Dewan DPRD?</h4>
                            <p>
                                Dewan Perwakilan Rakyat Daerah (DPRD) Kota Banjarmasin adalah lembaga legislatif daerah
                                yang memiliki peran dalam merumuskan kebijakan daerah, mengawasi jalannya pemerintahan,
                                dan mengesahkan anggaran. Dewan ini bertugas untuk mewakili kepentingan masyarakat Kota Banjarmasin
                                dalam pengambilan keputusan politik dan peraturan daerah.
                            </p>
                            <p>
                                Periode 2024-2029 akan difokuskan pada peningkatan pelayanan publik, penguatan transparansi,
                                serta penyusunan kebijakan yang mendukung pembangunan kota.
                            </p>

                            <!-- ✅ Tautan langsung ke website DPRD Banjarmasin -->
                            <h4>🔹 Lihat Informasi Lengkap</h4>
                            <a href="https://dprd.banjarmasinkota.go.id/p/dprd-kota-banjarmasin-2024-2029.html" target="_blank" class="btn btn-primary">
                                Kunjungi Website Resmi 📄
                            </a>
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