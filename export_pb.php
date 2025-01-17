<?php
require_once('tcpdf/tcpdf.php');

// Inisialisasi PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Atur margin
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);

// Tambah halaman
$pdf->AddPage();

// Tambahkan logo
$pdf->Image('C:\xampp\htdocs\monitoring\img\logo kai.jpg', 15, 10, 20, 20);

// Atur font untuk judul
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 5, 'PT Kereta Api Indonesia (PERSERO)', 0, 1, 'C');
$pdf->Cell(0, 5, 'UPT Balai Yasa Yogyakarta', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'Jl. Kusbini No.1, Demangan, Kec.Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55221', 0, 1, 'C');

// Tambahkan garis horizontal tebal di bawah kop
$pdf->Ln(5); // Spasi sebelum garis
$pdf->SetLineWidth(0.8); // Ketebalan garis
$pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
$pdf->SetLineWidth(0.2); // Kembalikan ke default
$pdf->Ln(5);

// Atur font untuk header
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Detail Data Perbaikan', 0, 1, 'C');
$pdf->Ln(5); // Spasi tambahan

// Validasi ID dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'ID tidak valid.', 0, 1, 'C');
    $pdf->Output('depo_detail.pdf', 'I');
    exit;
}

// Koneksi ke database dan ambil data berdasarkan ID
include "config.php"; // Pastikan file koneksi ada dan benar
$query = "SELECT * FROM mon_pb WHERE id_pb = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Periksa apakah data ditemukan
if (!$data) {
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Data tidak ditemukan.', 0, 1, 'C');
    $pdf->Output('depo_detail.pdf', 'I');
    exit;
}

// Buat tabel detail
$html = '
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th width="30%">ID</th>
        <td width="70%">' . htmlspecialchars($data['id_pb']) . '</td>
    </tr>
    <tr>
        <th>No. Sarana</th>
        <td>' . htmlspecialchars($data['no_sarana']) . '</td>
    </tr>
    <tr>
        <th>Depo</th>
        <td>' . htmlspecialchars($data['depo']) . '</td>
    </tr>
    <tr>
        <th>Sifat Perbaikan</th>
        <td>' . htmlspecialchars($data['sifat_pb']) . '</td>
    </tr>
     <tr>
        <th>Kilometer Masuk</th>
        <td>' . htmlspecialchars($data['KM_masuk']) . '</td>
    </tr>
    <tr>
        <th>Work Order</th>
        <td>' . htmlspecialchars($data['work_order']) . '</td>
    </tr>
    <tr>
        <th>Kelengkapan</th>
        <td>' . htmlspecialchars($data['kelengkapan']) . '</td>
    </tr>
    <tr>
        <th>Tanggal Masuk</th>
        <td>' . htmlspecialchars($data['tgl_masuk']) . '</td>
    </tr>
    <tr>
        <th>Tanggal Keluar</th>
        <td>' . htmlspecialchars($data['tgl_keluar']) . '</td>
    </tr>
    <tr>
        <th>Komponen Revisi</th>
        <td>' . htmlspecialchars($data['komponen_revisi']) . '</td>
    </tr>
    <tr>
        <th>Komponen Pengganti</th>
        <td>' . htmlspecialchars($data['komponen_pengganti']) . '</td>
    </tr>
    <tr>
        <th>Asal Lokomotif</th>
        <td>' . htmlspecialchars($data['asal_lok']) . '</td>
    </tr>
    <tr>
        <th>Riwayat Buku</th>
        <td>' . htmlspecialchars($data['rwyt_buku']) . '</td>
    </tr>
    <tr>
        <th>SAP</th>
        <td>' . htmlspecialchars($data['sap']) . '</td>
    </tr>
    <tr>
        <th>Softcopy Depo</th>
        <td>' . htmlspecialchars($data['softcopy_depo']) . '</td>
    </tr>
    <tr>
        <th>F7</th>
        <td>' . htmlspecialchars($data['f7_pdf']) . '</td>
    </tr>
</table>';

// Tambahkan tabel ke PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->writeHTML($html, true, false, true, false, '');

// Ambil dan format tanggal selesai
$tanggal_ttd = !empty($data['tgl_pasang']) ? date('d F Y', strtotime($data['tgl_pasang'])) : date('d F Y');

// Tambahkan tanda tangan
$pdf->Ln(20); // Beri jarak sebelum tanda tangan
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'Yogyakarta, ' . $tanggal_ttd, 0, 1, 'R');
$pdf->Cell(0, 5, 'MENGETAHUI', 0, 1, 'R');
$pdf->Cell(0, 5, 'Assistant Manager Perangkat Tukar', 0, 1, 'R');

$pdf->Ln(20); // Jarak antara posisi teks dan nama
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 5, 'MALIK RESPATI WIRA', 0, 1, 'R');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'NIP. 6897', 0, 1, 'R');

// Output PDF
$pdf->Output('perbaikan_detail.pdf', 'I'); // 'I' untuk tampil di browser
?>
