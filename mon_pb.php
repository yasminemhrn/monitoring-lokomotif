<?php

include "config.php";

$title = "Dashboard Monitoring";
include "template/header.php";
include "template/sidebar.php";
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Monitoring Perbaikan</h1>
                <ol class="breadcrumb mb-4">
                </ol>

                <div class="row"></div>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <head>
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    
    <style>
        /* Apply Poppins font globally */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Apply Poppins font to the entire container */
        .container-fluid {
            font-family: 'Poppins', sans-serif;
        }

        /* Card Header Style */
        .card-header {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #003b77; /* Matching color for header */
        }

        /* Style for buttons */
        .btn {
            font-family: 'Poppins', sans-serif;
        }

        /* Ensuring the card header has correct padding and rounded corners */
        .card-header {
            background-color: #f8f9fa;
            border-radius: 10px 10px 0 0;
            padding: 10px;
        }

        /* Customize the table style */
        table.dataTable {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            margin-top: 20px;
        }

        /* Styling the modal button to look better */
        .btn-secondary {
            background-color: #003b77;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #002c5a;
        }

        /* Add some space and padding for cleaner layout */
        .container-fluid {
            padding-top: 20px;
        }

        /* Modal Style */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #003b77;
            color: white;
        }

        /* Ensure the table has a border */
        .table-bordered {
            border: 1px solid #ddd;
        }

    </style>
</head>
    </head>
    <body>
    <div id="layoutSidenav">
    <div id="layoutSidenav_content" class="marginleft">
        <main>
            <div class="container-fluid px-4">
                <div class="card mb-4">
                    <div class="card-header">DataTable Example
                    <button class="btn btn-secondary pull-right" data-toggle="modal" data-target="#addEmployeeModal" style="border-radius:0%">Add</button>
                    </div>
    
                    <div class="card-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Change Data !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Data Successfully Changed!
                            </div>";
                    }

                    $depo_query = "SELECT * FROM mon_pb NATURAL JOIN depo";
                    if ($searchQuery) {
                        $depo_query .= " WHERE lokomotif LIKE '%$searchQuery%' OR depo LIKE '%$searchQuery%' OR sifat LIKE '%$searchQuery%'";
                    }
                    $depo_result = mysqli_query($koneksi, $depo_query);
                    ?>
                    <table id="table3" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="monpb">
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>No. Sarana</th>
                                <th>Depo</th>
                                <th>Sifat Perbaikan</th>
                                <th>Work Order</th>
                                <th>Kelengkapan Checksheet</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Action</th> 
                                <!-- <th width="100px">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $depo_query= "SELECT * FROM mon_pb NATURAL JOIN depo ";
                            $depo_result = mysqli_query($koneksi, $depo_query);
                            $no = 1;
                            while ($depo = mysqli_fetch_assoc($depo_result)) {  ?>
                                <tr>
                                <td width='100' class='center'><?= $no ?></td>
                                    <td><?php echo $depo['no_sarana'] ?></td>
                                    <td><?php echo $depo['depo'] ?></td>
                                    <td><?php echo $depo['sifat_pb'] ?></td>
                                    <td><?php echo $depo['work_order'] ?></td>
                                    <td><?php echo $depo['kelengkapan'] ?></td>
                                    <td><?php echo $depo['tgl_masuk'] ?></td>
                                    <td><?php echo $depo['tgl_keluar'] ?></td>
                                    <td>
                                        <!-- Tombol untuk membuka modal detail -->
                                        <button class="btn btn-warning" data-toggle="modal" 
                                                data-target="#customerDetailsModal"
                                                data-id="<?php echo $depo['id_pb']; ?>"
                                                data-no_sarana="<?php echo $depo['no_sarana']; ?>"
                                                data-depo="<?php echo $depo['depo']; ?>"
                                                data-sifat_pb="<?php echo $depo['sifat_pb']; ?>"
                                                data-work_order="<?php echo $depo['work_order']; ?>"
                                                data-tgl_masuk="<?php echo $depo['tgl_masuk']; ?>"
                                                data-tgl_keluar="<?php echo $depo['tgl_keluar']; ?>"
                                                data-ganti_komp="<?php echo $depo['ganti_komp']; ?>"
                                                data-komponen_revisi="<?php echo $depo['komponen_revisi']; ?>"
                                                data-komponen_pengganti="<?php echo $depo['komponen_pengganti']; ?>"
                                                data-asal_lok="<?php echo $depo['asal_lok']; ?>"
                                                data-rwyt_buku="<?php echo $depo['rwyt_buku']; ?>"
                                                data-sap="<?php echo $depo['sap']; ?>"
                                                data-softcopy_depo="<?php echo $depo['softcopy_depo']; ?>"
                                                data-f7_pdf="<?php echo $depo['f7_pdf']; ?>"
                                                data-KM_masuk="<?php echo $depo['KM_masuk']; ?>"
                                                data-kelengkapan="<?php echo $depo['kelengkapan']; ?>"
                                                style="border-radius:60px;">
                                            <i class="fa fa-info-circle"></i> View Details
                                        </button>

                                        <a href="#" 
   class="btn btn-danger mt-2" 
   style="border-radius:60px;" 
   data-bs-toggle="modal" 
   data-bs-target="#deleteConfirmationModal">
    <i class="fa fa-trash"></i> Hapus
</a>
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="functionmis.php?menu=prog&id=<?php echo $depo['id_pb']; ?>" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>
                                    </td>

                                </tr>
                                
                            <?php  $no++; } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .footer {
        position: absolute;
        bottom: 10px; /* Letakkan di bagian bawah */
        left: 50%; /* Pusatkan secara horizontal */
        transform: translateX(-50%); /* Koreksi posisi agar benar-benar berada di tengah */
        text-align: center; /* Rata tengah teks */
        font-size: 12px; /* Ukuran font kecil */
        color: #666; /* Warna teks */
    }
</style>

    <div class="footer">
            &copy; <?= date('Y'); ?> Unit Perangkat Tukar UPT Balai Yasa Yogyakarta. All Rights Reserved.
            <br>
        </div>

<!-- Kode modal HTML -->
<div id="customerDetailsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Details</b></h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                            <td><b>id</b></td>
                            <td id="id"></td>
                    </tr>
                        <tr><td><b>NO. SARANA</b></td>
                        <td id="no_sarana"></td>
                    </tr>
                        <tr><td><b>DEPO</b></td>
                        <td id="depo"></td>
                    </tr>
                        <tr><td><b>SIFAT PERBAIKAN</b></td>
                        <td id="sifat_pb"></td>
                    </tr>
                        <tr><td><b>WORK ORDER</b></td>
                        <td id="work_order"></td>
                    </tr>
                        <tr><td><b>TANGGAL MASUK</b></td>
                        <td id="tgl_masuk"></td>
                    </tr>
                        <tr><td><b>TANGGAL KELUAR</b></td>
                        <td id="tgl_keluar"></td>
                    </tr>
                        <tr><td><b>GANTI KOMPONEN</b></td>
                        <td id="ganti_komp"></td>
                    </tr>
                        <tr><td><b>KOMPONEN REVISI</b></td>
                        <td id="komponen_revisi"></td>
                    </tr>
                        <tr><td><b>KOMPONEN PENGGANTI</b></td>
                        <td id="komponen_pengganti"></td>
                    </tr>
                        <tr><td><b>ASAL LOK</b></td>
                        <td id="asal_lok"></td>
                    </tr>
                        <tr><td><b>RIWAYAT BUKU</b></td>
                        <td id="rwyt_buku"></td>
                    </tr>
                        <tr><td><b>SAP</b></td>
                        <td id="sap"></td>
                    </tr>
                        <tr><td><b>SOFTCOPY DEPO</b></td>
                        <td id="softcopy_depo"></td>
                    </tr>
                        <tr><td><b>F7 PDF</b></td>
                        <td id="f7_pdf"></td>
                    </tr>
                        <tr><td><b>KM MASUK</b></td>
                        <td id="KM_masuk"></td>
                    </tr>
                        <tr><td><b>KELENGKAPAN CHECKSHEET</b></td>
                        <td id="kelengkapan"></td>
                    </tr>

                    </tbody>
                </table>

                <!-- Kode untuk Tombol Export PDF di modal detail -->
                <button type="button" class="btn btn-primary" onclick="exportToPDF()">Export to PDF</button>

<script>
    function exportToPDF() {
        // Ambil ID dari detail modal
        var id = $('#id').text();

        // Arahkan ke export_pdf.php dengan ID yang sesuai
        window.location.href = "export_pb.php?id=" + id;
    }
</script>

               <!-- Tombol Edit -->
               <button type="button" class="btn btn-info" data-toggle="modal" 
                        data-target="#editModal" id="editButtonFromDetails">
                    Edit
                </button>  
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Employee -->
<div id="addEmployeeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Add Data</b></h4>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" method="POST" action="add_pb.php">
                    <div class="form-group">
                        <label for="no_sarana">No. Sarana:</label>
                        <input type="text" class="form-control" name="no_sarana">
                    </div>
                    <div class="form-group">
                        <label for="depo">Depo:</label>
                        <input type="text" class="form-control" name="depo">
                    </div>
                    <div class="form-group">
                        <label for="sifat_pb">Sifat Perbaikan:</label>
                        <input type="text" class="form-control" name="sifat_pb">
                    </div>
                    <div class="form-group">
                        <label for="work_order">Work Order:</label>
                        <input type="text" class="form-control" name="work_order">
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk:</label>
                        <input type="date" class="form-control" name="tgl_masuk">
                    </div>
                    <div class="form-group">
                        <label for="tgl_keluar">Tanggal Keluar:</label>
                        <input type="date" class="form-control" name="tgl_keluar">
                    </div>
                    <div class="form-group">
                        <label for="ganti_komp">Ganti Komponen:</label>
                        <input type="text" class="form-control" name="ganti_komp">
                    </div>
                    <div class="form-group">
                        <label for="komponen_revisi">Komponen Revisi:</label>
                        <input type="text" class="form-control" name="komponen_revisi">
                    </div>
                    <div class="form-group">
                        <label for="komponen_pengganti">Komponen Pengganti:</label>
                        <input type="text" class="form-control" name="komponen_pengganti">
                    </div>
                    <div class="form-group">
                        <label for="asal_lok">Asal Lok:</label>
                        <input type="text" class="form-control" name="asal_lok">
                    </div>
                    <div class="form-group">
                        <label for="rwyt_buku">Riwayat Buku:</label>
                        <input type="date" class="form-control" name="rwyt_buku">
                    </div>
                    <div class="form-group">
                        <label for="sap">SAP:</label>
                        <input type="date" class="form-control" name="sap">
                    </div>
                    <div class="form-group">
                        <label for="softcopy_depo">Softcopy Depo:</label>
                        <input type="date" class="form-control" name="softcopy_depo">
                    </div>
                    <div class="form-group">
                        <label for="f7_pdf">F7 PDF:</label>
                        <input type="date" class="form-control" name="f7_pdf">
                    </div>
                    <div class="form-group">
                        <label for="KM_masuk">KM Masuk:</label>
                        <input type="text" class="form-control" name="KM_masuk">
                    </div>
                    <div class="form-group">
                        <label for="kelengkapan">Kelengkapan Checksheet:</label>
                        <input type="text" class="form-control" name="kelengkapan">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- buat form di modal edit -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Edit Data</b></h4>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="edit_pb.php">

                <input type="hidden" id="edit_id" name="id_pb" >
                <input type="hidden" id="edit_id_depo" name="id_depo">
                    <div class="form-group">
                        <label for="edit_no_sarana">No. Sarana:</label>
                        <input type="text" class="form-control" id="edit_no_sarana" name="no_sarana" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_depo">Depo:</label>
                        <input type="text" class="form-control" id="edit_depo" name="depo" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sifat_pb">Sifat Perbaikan:</label>
                        <input type="text" class="form-control" id="edit_sifat_pb" name="sifat_pb" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_work_order">Work Order:</label>
                        <input type="text" class="form-control" id="edit_work_order" name="work_order" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tgl_masuk">Tanggal Masuk:</label>
                        <input type="date" class="form-control" id="edit_tgl_masuk" name="tgl_masuk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tgl_keluar">Tanggal Keluar:</label>
                        <input type="date" class="form-control" id="edit_tgl_keluar" name="tgl_keluar" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ganti_komp">Ganti Komponen:</label>
                        <input type="text" class="form-control" id="edit_ganti_komp" name="ganti_komp" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_komponen_revisi">Komponen Revisi:</label>
                        <input type="text" class="form-control" id="edit_komponen_revisi" name="komponen_revisi" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_komponen_pengganti">Komponen Pengganti:</label>
                        <input type="text" class="form-control" id="edit_komponen_pengganti" name="komponen_pengganti" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_asal_lok">Asal Lok:</label>
                        <input type="text" class="form-control" id="edit_asal_lok" name="asal_lok" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_rwyt_buku">Riwayat Buku:</label>
                        <input type="text" class="form-control" id="edit_rwyt_buku" name="rwyt_buku" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sap">SAP:</label>
                        <input type="date" class="form-control" id="edit_sap" name="sap" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_softcopy_depo">SOFTCOPY:</label>
                        <input type="date" class="form-control" id="edit_softcopy_depo" name="softcopy_depo" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_f7_pdf">F7 PDF:</label>
                        <input type="date" class="form-control" id="edit_f7_pdf" name="f7_pdf" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_KM_masuk">KM Masuk:</label>
                        <input type="text" class="form-control" id="edit_KM_masuk" name="KM_masuk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kelengkapan">Kelengkapan Checksheet:</label>
                        <input type="text" class="form-control" id="edit_kelengkapan" name="kelengkapan" required>
                    </div>
                    <!-- Tambah field lainnya seperti yang ada di modal detail -->
                    <button type="submit" name="edit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    new DataTable('#table3', {

});
</script>

<!-- JavaScript untuk modal -->
<script>
$(document).ready(function() {
    $('#customerDetailsModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);

        // Ambil data dari tombol
        var id = button.data('id');
        var no_sarana = button.data('no_sarana');
        var depo = button.data('depo');
        var sifat_pb = button.data('sifat_pb');
        var work_order = button.data('work_order');
        var tgl_masuk = button.data('tgl_masuk');
        var tgl_keluar = button.data('tgl_keluar');
        var ganti_komp = button.data('ganti_komp');
        var komponen_revisi = button.data('komponen_revisi');
        var komponen_pengganti = button.data('komponen_pengganti');
        var asal_lok = button.data('asal_lok');
        var rwyt_buku = button.data('rwyt_buku');
        var sap = button.data('sap');
        var softcopy_depo = button.data('softcopy_depo');
        var f7_pdf = button.data('f7_pdf');
        var KM_masuk = button.data('KM_masuk');
        var kelengkapan = button.data('kelengkapan');

        // Masukkan data ke modal
        var modal = $(this);
        modal.find('#id').text(id || 'Tidak Ada Data');
        modal.find('#no_sarana').text(no_sarana || 'Tidak Ada Data');
        modal.find('#depo').text(depo || 'Tidak Ada Data');
        modal.find('#sifat_pb').text(sifat_pb|| 'Tidak Ada Data');
        modal.find('#work_order').text(work_order || 'Tidak Ada Data');
        modal.find('#tgl_masuk').text(tgl_masuk || 'Tidak Ada Data');
        modal.find('#tgl_keluar').text(tgl_keluar || 'Tidak Ada Data');
        modal.find('#ganti_komp').text(ganti_komp || 'Tidak Ada Data');
        modal.find('#komponen_revisi').text(komponen_revisi || 'Tidak Ada Data');
        modal.find('#komponen_pengganti').text(komponen_pengganti || 'Tidak Ada Data');
        modal.find('#asal_lok').text(asal_lok || 'Tidak Ada Data');
        modal.find('#rwyt_buku').text(rwyt_buku || 'Tidak Ada Data');
        modal.find('#sap').text(sap || 'Tidak Ada Data');
        modal.find('#softcopy_depo').text(softcopy_depo || 'Tidak Ada Data');
        modal.find('#f7_pdf').text(f7_pdf || 'Tidak Ada Data');
        modal.find('#KM_masuk').text(KM_masuk || 'Tidak Ada Data');
        modal.find('#kelengkapan').text(kelengkapan || 'Tidak Ada Data');
    });

    // Ketika tombol Edit di modal Detail diklik
    $('#editButtonFromDetails').on('click', function() {
        var modal = $('#customerDetailsModal');
        
        // Ambil data dari modal Detail
        var id = modal.find('#id').text();
        var no_sarana = modal.find('#no_sarana').text();
        var depo = modal.find('#depo').text();
        var sifat_pb = modal.find('#sifat_pb').text();
        var work_order = modal.find('#work_order').text();
        var tgl_masuk = modal.find('#tgl_masuk').text();
        var tgl_keluar = modal.find('#tgl_keluar').text();
        var ganti_komp = modal.find('#ganti_komp').text();
        var komponen_revisi = modal.find('#komponen_revisi').text();
        var komponen_pengganti = modal.find('#komponen_pengganti').text();
        var asal_lok = modal.find('#asal_lok').text();
        var rwyt_buku = modal.find('#rwyt_buku').text();
        var sap = modal.find('#sap').text();
        var softcopy_depo = modal.find('#softcopy_depo').text();
        var f7_pdf = modal.find('#f7_pdf').text();
        var KM_masuk = modal.find('#KM_masuk').text();
        var kelengkapan = modal.find('#kelengkapan').text();

        // Isi modal Edit dengan data yang sudah ada
        $('#editModal').find('#edit_id').val(id);
        $('#editModal').find('#edit_no_sarana').val(no_sarana);
        $('#editModal').find('#edit_depo').val(depo);
        $('#editModal').find('#edit_sifat_pb').val(sifat_pb);
        $('#editModal').find('#edit_work_order').val(work_order);
        $('#editModal').find('#edit_tgl_masuk').val(tgl_masuk);
        $('#editModal').find('#edit_tgl_keluar').val(tgl_keluar);
        $('#editModal').find('#edit_ganti_komp').val(ganti_komp);
        $('#editModal').find('#edit_komponen_revisi').val(komponen_revisi);
        $('#editModal').find('#edit_komponen_pengganti').val(komponen_pengganti);
        $('#editModal').find('#edit_asal_lok').val(asal_lok);
        $('#editModal').find('#edit_rwyt_buku').val(rwyt_buku);
        $('#editModal').find('#edit_sap').val(sap);
        $('#editModal').find('#edit_softcopy_depo').val(softcopy_depo);
        $('#editModal').find('#edit_f7_pdf').val(f7_pdf);
        $('#editModal').find('#edit_KM_masuk').val(KM_masuk);
        $('#editModal').find('#edit_kelengkapan').val(kelengkapan);
    });
});
</script>


<!-- Tambahkan juga jQuery dan Bootstrap JS di sini -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    body {
        background-color: #f5f5f5;
        font-family: 'arial', sans-serif;
    }

    .bg-primary {
        background-color: #0055d4 !important;
    }

    .text-white {
        color: #ffffff !important;
    }

    .card {
        border-radius: 15px;
    }

    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }

    #layoutSidenav_nav {
        background-color: #ffffff;
    }

    #layoutSidenav_nav .nav-link {
        color: #343a40;
    }

    #layoutSidenav_nav .nav-link:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }
</style>
<?php include "template/footer.php"; ?>
    </body>
</html>
