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
$pdf->Image('C:\\xampp\\htdocs\\monitoring\\img\\logo kai.jpg', 15, 10, 20, 20);

// Atur font untuk kop surat
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 5, 'PT Kereta Api Indonesia (PERSERO)', 0, 1, 'C');
$pdf->Cell(0, 5, 'UPT Balai Yasa Yogyakarta', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'Jl. Kusbini No.1, Demangan, Kec.Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55221', 0, 1, 'C');

// Tambahkan garis horizontal
$pdf->Ln(5);
$pdf->SetLineWidth(0.8);
$pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
$pdf->SetLineWidth(0.2);
$pdf->Ln(5);

// Judul
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Detail Lokomotif', 0, 1, 'C');
$pdf->Ln(5);

// Ambil ID dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Koneksi ke database
include "config.php";
$query = "SELECT * FROM mon_prog WHERE id_prog = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Periksa apakah data ditemukan
if (!$data) {
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Data tidak ditemukan.', 0, 1, 'C');
    $pdf->Output('program lokomotif.pdf', 'I');
    exit;
}

// Buat tabel detail dengan tampilan sederhana
$html = '
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 10px;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<table>
    <tr>
        <th>ID</th>
        <td>' . htmlspecialchars($data['id_prog']) . '</td>
        <th>Lokomotif</th>
        <td>' . htmlspecialchars($data['lokomotif']) . '</td>
    </tr>
    <tr>
        <th>Depo</th>
        <td>' . htmlspecialchars($data['depo']) . '</td>
        <th>Work Order</th>
        <td>' . htmlspecialchars($data['work_order']) . '</td>
    </tr>
    <tr>
        <th>Sifat</th>
        <td>' . htmlspecialchars($data['sifat']) . '</td>
        <th>Tanggal Masuk</th>
        <td>' . htmlspecialchars($data['tgl_msk']) . '</td>
    </tr>
    <tr>
        <th>Tanggal Keluar</th>
        <td>' . htmlspecialchars($data['tgl_klr']) . '</td>
        <th>Engine</th>
        <td>' . htmlspecialchars($data['engine']) . '</td>
    </tr>
    <tr>
        <th>Cylinder Jacket</th>
        <td colspan="3">
            1L: ' . htmlspecialchars($data['cj_1l']) . ', 2L: ' . htmlspecialchars($data['cj_2l']) . ', 3L: ' . htmlspecialchars($data['cj_3l']) . ', 4L: ' . htmlspecialchars($data['cj_4l']) . '<br>
            1R: ' . htmlspecialchars($data['cj_1r']) . ', 2R: ' . htmlspecialchars($data['cj_2r']) . ', 3R: ' . htmlspecialchars($data['cj_3r']) . ', 4R: ' . htmlspecialchars($data['cj_4r']) . '
        </td>
    </tr>
    <tr>
        <th>Cylinder Linier</th>
        <td colspan="3">
            1L: ' . htmlspecialchars($data['cl_1l']) . ', 2L: ' . htmlspecialchars($data['cl_2l']) . ', 3L: ' . htmlspecialchars($data['cl_3l']) . ', 4L: ' . htmlspecialchars($data['cl_4l']) . '<br>
            1R: ' . htmlspecialchars($data['cl_1r']) . ', 2R: ' . htmlspecialchars($data['cl_2r']) . ', 3R: ' . htmlspecialchars($data['cl_3r']) . ', 4R: ' . htmlspecialchars($data['cl_4r']) . '
        </td>
    </tr>
    <tr>
        <th>Injection Pump</th>
        <td colspan="3">
            1L: ' . htmlspecialchars($data['ip_1l']) . ', 2L: ' . htmlspecialchars($data['ip_2l']) . ', 3L: ' . htmlspecialchars($data['ip_3l']) . ', 4L: ' . htmlspecialchars($data['ip_4l']) . '<br>
            1R: ' . htmlspecialchars($data['ip_1r']) . ', 2R: ' . htmlspecialchars($data['ip_2r']) . ', 3R: ' . htmlspecialchars($data['ip_3r']) . ', 4R: ' . htmlspecialchars($data['ip_4r']) . '
        </td>
    </tr>
    <tr>
        <th>Intercooler</th>
        <td colspan="3">
            Intercooler R: ' . htmlspecialchars($data['intercooler_r']) . ', L: ' . htmlspecialchars($data['intercooler_l']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Oil Pump</th>
        <td colspan="3">
            Oil Pump: ' . htmlspecialchars($data['oil_pump']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Turbocharger</th>
        <td colspan="3">
            Turbocharger: ' . htmlspecialchars($data['turbocharger']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Governor MD</th>
        <td colspan="3">
            Governor MD: ' . htmlspecialchars($data['governor_md']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Overspeed MD</th>
        <td colspan="3">
            Overspeed MD: ' . htmlspecialchars($data['overspeed_md']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Air Compressor</th>
        <td colspan="3">
            Air Compressor: ' . htmlspecialchars($data['air_compressor']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Fan Radiator</th>
        <td colspan="3">
            Fan Radiator: ' . htmlspecialchars($data['fan_radiator']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Lube Oil</th>
        <td colspan="3">
            Lube Oil: ' . htmlspecialchars($data['lube_oil']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Radiator</th>
        <td colspan="3">
           Radiator: ' . htmlspecialchars($data['radiator']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Automatic Brake</th>
        <td colspan="3">
           Automatic Brake 1: ' . htmlspecialchars($data['automaticbrake_1']) . '<br>
           Automatic Brake 2: ' . htmlspecialchars($data['automaticbrake_2']) . '
        </td>
    </tr>
     <tr>
        <th>Independent Brake</th>
        <td colspan="3">
           Independent Brake 1: ' . htmlspecialchars($data['independentbrake_1']) . '<br>
           Independent Brake 2: ' . htmlspecialchars($data['independentbrake_2']) . '
        </td>
    </tr>
     <tr>
        <th>Blower TM</th>
        <td colspan="3">
           Blower TM: ' . htmlspecialchars($data['blower_tm']) . '<br>
        </td>
    </tr>
      <tr>
        <th>Exhauster</th>
        <td colspan="3">
           Exhauster: ' . htmlspecialchars($data['exhauster']) . '<br>
        </td>
    </tr>
       <tr>
        <th>Auxilary Generator</th>
        <td colspan="3">
           Auxilary Generator: ' . htmlspecialchars($data['auxilary_gen']) . '<br>
        </td>
    </tr>
         <tr>
        <th>Exciter Generator</th>
        <td colspan="3">
           Exciter Generator: ' . htmlspecialchars($data['exciter_gen']) . '<br>
        </td>
    </tr>
           <tr>
        <th>Main Generator</th>
        <td colspan="3">
           Main Generator: ' . htmlspecialchars($data['main_gen']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Traksi Listrik</th>
        <td colspan="3">
          1: ' . htmlspecialchars($data['tl_1']) . '<br>
          2: ' . htmlspecialchars($data['tl_2']) . '<br>
          3: ' . htmlspecialchars($data['tl_3']) . '<br>
          4: ' . htmlspecialchars($data['tl_4']) . '<br>
          5: ' . htmlspecialchars($data['tl_5']) . '<br>
          6: ' . htmlspecialchars($data['tl_6']) . '<br>
        </td>
    </tr>
      </tr>
    <tr>
        <th>Battery</th>
        <td colspan="3">
           Battery: ' . htmlspecialchars($data['battery']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Full Pump</th>
        <td colspan="3">
           Full Pump: ' . htmlspecialchars($data['full_pump']) . '<br>
        </td>
    </tr>
       <tr>
        <th>Dynamik Brake</th>
        <td colspan="3">
           Dynamik Brake: ' . htmlspecialchars($data['dyn_brake']) . '<br>
        </td>
    </tr>
      <tr>
        <th>Voltage Regulator</th>
        <td colspan="3">
           Voltage Regulator: ' . htmlspecialchars($data['volt_regulator']) . '<br>
        </td>
    </tr>
    <tr>
        <th>Blower Rectifier</th>
        <td colspan="3">
           1: ' . htmlspecialchars($data['br_1']) . '<br>
           2: ' . htmlspecialchars($data['br_2']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Blower Exhauster</th>
        <td colspan="3">
           1: ' . htmlspecialchars($data['be_1']) . '<br>
           2: ' . htmlspecialchars($data['be_2']) . '<br>
        </td>
    </tr>
     <tr>
        <th>SDIS</th>
        <td colspan="3">
           1: ' . htmlspecialchars($data['sdis_1']) . '<br>
           2: ' . htmlspecialchars($data['sdis_2']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Boogie Sets</th>
        <td colspan="3">
           1: ' . htmlspecialchars($data['bs_1']) . '<br>
           2: ' . htmlspecialchars($data['bs_2']) . '<br>
        </td>
    </tr>
     <tr>
        <th>Wheel Sets</th>
        <td colspan="3">
           1: ' . htmlspecialchars($data['ws_1']) . '<br>
           2: ' . htmlspecialchars($data['ws_2']) . '<br>
           3: ' . htmlspecialchars($data['ws_3']) . '<br>
           4: ' . htmlspecialchars($data['ws_4']) . '<br>
           5: ' . htmlspecialchars($data['ws_5']) . '<br>
           6: ' . htmlspecialchars($data['ws_6']) . '<br>
        </td>
    </tr>
       <tr>
        <th>Kilometer Tempuhr</th>
        <td colspan="3">
            ' . htmlspecialchars($data['km']) . '<br>
        </td>
    </tr>
    </table>';

// Tambahkan tabel ke PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->writeHTML($html, true, false, true, false, '');

// Tanda tangan
$tanggal_ttd = date('d F Y', strtotime($data['tgl_klr']));
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'Yogyakarta, ' . $tanggal_ttd, 0, 1, 'R');
$pdf->Cell(0, 5, 'MENGETAHUI', 0, 1, 'R');
$pdf->Cell(0, 5, 'Assistant Manager Perangkat Tukar', 0, 1, 'R');
$pdf->Ln(20);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 5, 'MALIK RESPATI WIRA', 0, 1, 'R');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 5, 'NIP. 6897', 0, 1, 'R');

// Output PDF
$pdf->Output('program lokomotif.pdf', 'I');
?>
