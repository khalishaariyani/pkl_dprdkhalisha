<?php
include '../session_start.php';  // Memulai session
include '../include/env.config.php'; // Koneksi ke database

// **Konfigurasi Google API (Opsional, Bisa Dimatikan)**
$use_google_api = false; // Ubah ke "true" jika ingin menampilkan hasil dari Google
$api_key = "YOUR_GOOGLE_API_KEY"; // Ganti dengan API Key Google Anda
$search_engine_id = "YOUR_SEARCH_ENGINE_ID"; // Ganti dengan Search Engine ID Anda
$query = "Badan Pembentukan Peraturan Daerah Periode 2024-2029";
$search_results = [];

// **Ambil data dari Google jika API aktif**
if ($use_google_api) {
    $url = "https://www.googleapis.com/customsearch/v1?q=".urlencode($query)."&key=$api_key&cx=$search_engine_id";
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
                            <h1 class="m-0 text-dark">Badan Pembentukan Peraturan Daerah (Periode 2024-2029)</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Konten -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-1 font-weight-bold text-warning">Informasi Tentang Bapemperda</h6>
                        </div>
                        <div class="card-body">
                            <!-- ✅ Metode 1: Menampilkan Informasi Statis -->
                            <h4>🔹 Apa itu Bapemperda?</h4>
                            <p>
                                Badan Pembentukan Peraturan Daerah (Bapemperda) adalah lembaga yang bertugas untuk menyusun 
                                dan membahas rancangan peraturan daerah (Perda) di tingkat DPRD. Pada periode 2024-2029, Bapemperda 
                                berfokus pada penyusunan peraturan yang berkaitan dengan pengelolaan sumber daya daerah, tata kelola pemerintahan,
                                dan peningkatan kesejahteraan masyarakat.
                            </p>
                            <p>
                                Untuk informasi lebih lanjut, kunjungi situs resmi DPRD Banjarmasin:
                            </p>

                            <!-- ✅ Metode 3: Link langsung ke website DPRD Banjarmasin -->
                            <a href="https://dprd.banjarmasinkota.go.id/p/badan-pembentukan-peraturan-daerah_7.html" target="_blank" class="btn btn-primary">
                                Lihat Informasi Resmi 📄
                            </a>

                            <!-- ✅ Metode 2: Menampilkan Hasil Pencarian dari Google API (Opsional) -->
                            <?php if ($use_google_api && !empty($search_results['items'])): ?>
                                <h4 class="mt-4">🔹 Hasil Pencarian Terbaru dari Google</h4>
                                <ul class="list-group">
                                    <?php foreach ($search_results['items'] as $item): ?>
                                        <li class="list-group-item">
                                            <a href="<?= $item['link']; ?>" target="_blank"><strong><?= $item['title']; ?></strong></a>
                                            <p><?= $item['snippet']; ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
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
