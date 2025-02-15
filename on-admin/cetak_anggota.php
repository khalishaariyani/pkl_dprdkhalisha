<?php
require('../fpdf/fpdf.php');
include '../include/env.config.php'; // Koneksi ke database
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../dist/img/dprdbulat.png', 10, 10, 20);
        $this->SetFont('Times', 'B', 14);
        $this->SetXY(35, 10);
        $this->Cell(0, 7, 'DEWAN PERWAKILAN RAKYAT DAERAH', 0, 1, 'L');
        $this->SetX(35);
        $this->Cell(0, 7, 'KOTA BANJARMASIN', 0, 1, 'L');
        $this->SetFont('Times', '', 11);
        $this->SetX(35);
        $this->MultiCell(0, 6, 'Jalan Lambung Mangkurat, Kelurahan Kertak Baru Ilir, Kecamatan Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan - 70114', 0, 'L');
        $this->Ln(5);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.5);
        $this->Line(10, 35, 200, 35);
        $this->Ln(10);
    }

    function Body($dataByMonth)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'LAPORAN ANGGOTA DINAS PER BULAN', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Ln(5);

        foreach ($dataByMonth as $month => $data) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 8, ucfirst($month), 0, 1); // Nama Bulan

            // Header tabel
            $this->SetFillColor(200, 220, 255);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(50, 8, 'Tanggal Rapat', 1, 0, 'C', true); // Kolom pertama
            $this->Cell(60, 8, 'Nama Dinas', 1, 0, 'C', true); // Kolom kedua
            $this->Cell(80, 8, 'Nama Rapat', 1, 1, 'C', true); // Kolom ketiga lebih lebar

            // Isi tabel
            $this->SetFont('Arial', '', 11);
            foreach ($data as $row) {
                $this->Cell(50, 16, $row['tanggal_rapat'], 1, 0, 'C'); // Tanggal Rapat
                $this->Cell(60, 16, $row['nama_dinas'], 1, 0, 'L'); // Nama Dinas
                $this->MultiCell(80, 8, implode("\n", $row['nama_rapat']), 1, 'L'); // Daftar nama rapat
                $this->Ln(0); // Tidak ada spasi antar baris data, sehingga garis antar kolom tetap terhubung
            }
            $this->Ln(5); // Spasi antar bulan
        }
    }
    function Footer()
    {
        // Menentukan posisi footer di bagian bawah
        $this->SetY(160);

        // Mengatur font untuk footer
        $this->SetFont('Arial', '', 11);

        // Menempatkan informasi "Dikeluarkan di Banjarmasin" di sebelah kanan
        $this->SetX(90);  // Atur posisi X ke kanan
        $this->Cell(7, 0, 'Dikeluarkan di Banjarmasin, pada tanggal: ' . date('d F Y'), 0, 1, 'L');

        // Menambahkan spasi sedikit
        $this->Ln(1);

        // Menambahkan informasi Ketua DPRD di sebelah kanan
        $this->SetX(150);  // Mengatur posisi X untuk di sebelah kanan
        $this->Cell(7, 10, 'Ketua DPRD Kota Banjarmasin', 0, 1, 'L');

        // Menambahkan spasi
        $this->Ln(15);

        // Menampilkan nama Ketua DPRD di sebelah kanan
        $this->SetX(150);  // Mengatur posisi X untuk di sebelah kanan
        $this->Cell(0, 20, 'H. Harry Wijaya, S.H., M.H.', 0, 5, 'L');

        // Menambahkan garis tanda tangan di sebelah kanan
        $this->SetX(150);  // Mengatur posisi X untuk di sebelah kanan
        $this->Cell(0, 10, '...................................................', 0, 1, 'L');
    }
}

// Query data dari tabel dinas
$query = "SELECT nama_dinas, nama_rapat, tanggal_rapat FROM dinas ORDER BY tanggal_rapat ASC";
$result = $koneksi->query($query);

// Organisasi data berdasarkan bulan
$dataByMonth = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = strtolower(date('F', strtotime($row['tanggal_rapat']))); // Nama bulan dalam huruf kecil
        if (!isset($dataByMonth[$month])) {
            $dataByMonth[$month] = [];
        }
        $dataByMonth[$month][] = [
            'tanggal_rapat' => $row['tanggal_rapat'],
            'nama_dinas' => $row['nama_dinas'],
            'nama_rapat' => [$row['nama_rapat']]
        ];
    }
} else {
    die("Data Anggota Dinas tidak ditemukan.");
}

// Inisialisasi dan cetak PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->Body($dataByMonth);
$pdf->Output();
