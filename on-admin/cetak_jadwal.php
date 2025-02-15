<?php
ob_start(); // Menangkap output agar tidak ada data sebelum Output()

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
        $this->Cell(0, 10, 'LAPORAN JADWAL RAPAT PER BULAN', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Ln(5);

        foreach ($dataByMonth as $month => $data) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 8, 'Bulan: ' . ucfirst($month), 0, 1);

            // Header tabel
            $this->SetFillColor(200, 220, 255);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(40, 8, 'Nomor Agenda', 1, 0, 'C', true);
            $this->Cell(150, 8, 'Judul Paripurna', 1, 1, 'C', true);

            // Isi tabel
            $this->SetFont('Arial', '', 9);
            foreach ($data as $row) {
                $this->Cell(40, 10, $row['nomor_agenda'], 1, 0, 'C');
                $this->Cell(150, 10, $row['judul_paripurna'], 1, 1, 'L');
            }

            $this->Ln(5);
        }

        // Bagian tanda tangan
        $this->Ln(20);
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, 'Dikeluarkan di Banjarmasin, pada tanggal: ' . date('d F Y'), 0, 1, 'R');
        $this->Ln(15);
        $this->Cell(0, 10, 'Ketua DPRD Kota Banjarmasin', 0, 1, 'R');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 10, 'H. Harry Wijaya, S.H., M.H.', 0, 1, 'R');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, '...............................................', 0, 1, 'R');
    }

}

// Query data dari tabel jadwal rapat
$query = "SELECT nomor_agenda, judul_paripurna, tgl_waktu FROM jadwal ORDER BY tgl_waktu ASC";
$result = $koneksi->query($query);

// Organisasi data berdasarkan bulan
$dataByMonth = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = strtolower(date('F', strtotime($row['tgl_waktu'])));
        if (!isset($dataByMonth[$month])) {
            $dataByMonth[$month] = [];
        }
        $dataByMonth[$month][] = [
            'nomor_agenda' => $row['nomor_agenda'],
            'judul_paripurna' => $row['judul_paripurna']
        ];
    }
} else {
    die("Data Jadwal Rapat tidak ditemukan.");
}

// Inisialisasi dan cetak PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->Body($dataByMonth);
$pdf->Output();

ob_end_flush(); // Mengakhiri penangkapan output
