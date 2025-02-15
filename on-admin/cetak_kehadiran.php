<?php
require('../fpdf/fpdf.php');
include '../include/env.config.php'; // Koneksi ke database

class PDF extends FPDF
{
    public $pengusul; // Variabel untuk menyimpan nama pengusul

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
        $this->Cell(0, 10, 'LAPORAN KEHADIRAN ANGGOTA DPRD PER BULAN', 0, 1, 'C');
        $this->Ln(5);

        foreach ($dataByMonth as $month => $data) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 8, 'Bulan: ' . ucfirst($month), 0, 1);

            // Header tabel
            $this->SetFillColor(200, 220, 255);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(60, 8, 'Nama Anggota', 1, 0, 'C', true);
            $this->Cell(30, 8, 'Hadir', 1, 0, 'C', true);
            $this->Cell(30, 8, 'Sakit', 1, 0, 'C', true);
            $this->Cell(30, 8, 'Izin', 1, 1, 'C', true);

            // Isi tabel
            $this->SetFont('Arial', '', 9);
            foreach ($data as $nama => $counts) {
                $this->Cell(60, 8, $nama, 1, 0, 'L');
                $this->Cell(30, 8, $counts['hadir'] . 'x', 1, 0, 'C');
                $this->Cell(30, 8, $counts['sakit'] . 'x', 1, 0, 'C');
                $this->Cell(30, 8, $counts['izin'] . 'x', 1, 1, 'C');
            }
            $this->Ln(5);
        }
    }

    function Footer()
    {
        $this->SetY(160); // Naikkan posisi footer lebih tinggi
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, 'Dikeluarkan di Banjarmasin, pada tanggal: ' . date('d F Y'), 0, 1, 'R');
        $this->Ln(10);
        $this->Cell(0, 10, 'Ketua DPRD Kota Banjarmasin', 0, 1, 'R');
        $this->Ln(15);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 10, $this->pengusul, 0, 1, 'R');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, '...............................................', 0, 1, 'R');
    }
}

// Ambil nama pengusul (Ketua DPRD)
$queryPengusul = "SELECT pengusul FROM raperda ORDER BY id_raperda DESC LIMIT 1";
$resultPengusul = $koneksi->query($queryPengusul);

$pengusul = "Nama Ketua Tidak Ditemukan";
if ($resultPengusul->num_rows > 0) {
    $pengusul = $resultPengusul->fetch_assoc()['pengusul'];
}

// Query data kehadiran per bulan
$query = "SELECT nama, status_kehadiran, MONTH(tgl_kehadiran) as bulan FROM kehadiran ORDER BY tgl_kehadiran ASC";
$result = $koneksi->query($query);

// Mengorganisasi data berdasarkan bulan
$dataByMonth = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = strtolower(date('F', mktime(0, 0, 0, $row['bulan'], 10)));
        $nama = $row['nama'];

        if (!isset($dataByMonth[$month][$nama])) {
            $dataByMonth[$month][$nama] = ['hadir' => 0, 'sakit' => 0, 'izin' => 0];
        }

        $status = strtolower($row['status_kehadiran']);
        if (isset($dataByMonth[$month][$nama][$status])) {
            $dataByMonth[$month][$nama][$status]++;
        }
    }
}

// Inisialisasi dan cetak PDF
$pdf = new PDF();
$pdf->pengusul = $pengusul; // Mengatur nama pengusul di dalam objek PDF
$pdf->AddPage();
$pdf->Body($dataByMonth);
$pdf->Output();
