<?php
// Memanggil pustaka FPDF
require('../fpdf/fpdf.php');

// Koneksi ke database
include '../include/env.config.php';

// Ambil ID dari parameter URL (GET)
if (isset($_GET['id'])) {
    $id_raperda = intval($_GET['id']); // Pastikan ID adalah angka
} else {
    die("ID Raperda tidak ditemukan! Pastikan Anda mengakses dengan benar.");
}

// Query untuk mengambil data Raperda berdasarkan ID
$query = "SELECT * FROM raperda WHERE id_raperda = $id_raperda"; // Sesuaikan nama kolom di sini
$result = $koneksi->query($query);

// Periksa apakah query berhasil
if (!$result) {
    die("Error dalam query: " . $koneksi->error);
}

// Periksa apakah data ditemukan
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Data Raperda dengan ID tersebut tidak ditemukan!");
}

// Kelas PDF
class PDF extends FPDF
{
    function Header()
    {
        global $data;
        $this->SetFont('Times', 'B', 10); // Gunakan font lebih kecil
        $this->Cell(0, 5, 'BERITA ACARA PEMBICARAAN TINGKAT I', 0, 1, 'C');
        $this->Cell(0, 5, 'PEMBAHASAN RANCANGAN PERATURAN DAERAH KOTA BANJARMASIN', 0, 1, 'C');
        $this->Cell(0, 5, 'TENTANG ' . strtoupper($data['judul_raperda']), 0, 1, 'C');
        $this->Ln(3); // Kurangi jarak antar elemen
        $this->SetFont('Times', '', 9);
        $this->Cell(0, 5, 'NOMOR: ' . $data['nomor_raperda'], 0, 1, 'C');
        $this->Ln(5); // Kurangi jarak antar elemen
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, ' ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Buat PDF
$pdf = new PDF();
$pdf->SetMargins(10, 10, 10); // Margin lebih kecil
$pdf->AddPage();
$pdf->SetFont('Times', '', 10); // Font lebih kecil

// Konten PDF
$pdf->MultiCell(0, 5, "Pada hari Selasa, tanggal Dua Belas, bulan Februari, tahun Dua Ribu Dua Puluh Lima (" . date('d-m-Y', strtotime($data['tgl_masuk'])) . "), kami yang bertanda tangan di bawah ini:");
$pdf->Ln(3);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 5, '1.', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, $data['pengusul'], 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(0, 5, 'Ketua DPRD Kota Banjarmasin untuk selanjutnya disebut PIHAK PERTAMA', 0, 1);

$pdf->Ln(3);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 5, '2.', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, 'IKHSAN BUDIMAN, SH, MM', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(0, 5, 'Sekretaris Daerah Banjarmasin untuk selanjutnya disebut PIHAK KEDUA', 0, 1);
$pdf->Ln(5);

$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(0, 5, "PIHAK PERTAMA dan PIHAK KEDUA yang selanjutnya disebut PARA PIHAK telah selesai melaksanakan pembahasan Rancangan Peraturan Daerah Kota Banjarmasin tentang " . $data['judul_raperda'] . " yang merupakan usulan Pemerintah Daerah Kota Banjarmasin, dengan tetap mengacu kepada peraturan perundang-undangan yang berlaku, termasuk Tata Tertib Dewan Perwakilan Rakyat Daerah Kota Banjarmasin.");
$pdf->Ln(3);

$pdf->MultiCell(0, 5, "Berita Acara Pembicaraan Tingkat I ini dibuat untuk memenuhi ketentuan persyaratan permohonan fasilitasi Rancangan Peraturan Daerah Kota Banjarmasin tentang " . $data['judul_raperda'] . " kepada Gubernur sebagai Wakil Pemerintah Pusat di Daerah sebagaimana dimaksud dalam ketentuan Pasal 89 ayat (2) huruf b Peraturan Menteri Dalam Negeri Nomor 120 Tahun 2018 tentang Perubahan Peraturan Menteri Dalam Negeri Nomor 80 Tahun 2015 tentang Pembentukan Produk Hukum Daerah.");
$pdf->Ln(3);

$pdf->MultiCell(0, 5, "Catatan: " . $data['catatan']);
$pdf->Ln(3);

$pdf->MultiCell(0, 5, "Demikian Berita Acara Pembicaraan Tingkat I Rancangan Peraturan Daerah Kota Banjarmasin tentang " . $data['judul_raperda'] . " dibuat dan ditandatangani oleh PARA PIHAK dalam rangkap 3 (tiga) untuk dipergunakan sebagaimana mestinya.");
$pdf->Ln(8);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(0, 5, 'Banjarmasin, ' . date('d F Y', strtotime($data['tgl_masuk'])), 0, 1, 'R');
$pdf->Ln(8);

// Signature section
$pdf->Cell(0, 5, 'Sekretaris Daerah Kota', 0, 1, 'L');
$pdf->Cell(0, 5, 'Banjarmasin', 0, 1, 'L');
$pdf->Cell(0, 5, 'DPRD Kota Banjarmasin', 0, 1, 'R');
$pdf->Ln(12);

$pdf->Cell(0, 5, 'IKHSAN BUDIMAN, SH, MM', 0, 1, 'L');
$pdf->Cell(0, 5, 'NIP: 19761205 200604 1 016', 0, 1, 'L');
$pdf->Cell(0, 5, $data['pengusul'], 0, 1, 'R');

$pdf->Output('I', 'Berita_Acara.pdf');

// Tutup koneksi
$koneksi->close();
?>
