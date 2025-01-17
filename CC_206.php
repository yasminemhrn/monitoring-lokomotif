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
                <h1 class="mt-4">Monitoring Perawatan CC 206</h1>
                <ol class="breadcrumb mb-4">
                </ol>

                <div class="row"></div>
<html>

<head>
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
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
                            <button
                                class="btn btn-secondary pull-right"
                                data-toggle="modal"
                                data-target="#addEmployeeModal"
                                style="border-radius:0%">Add</button>
                        </div>
                        <!-- Search Form -->
                        <!-- <form method="GET" action=""> <input class="datatable-input" name="search"
                            placeholder="Search..." type="search" value="<?= htmlspecialchars($searchQuery);
                                                                            ?>" title="Search within table"> <button type="submit" class="btn
                            btn-primary">Search</button> </form> -->
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

                            $depo_query = "SELECT * FROM prwtan_cc206 NATURAL JOIN depo";
                            if ($searchQuery) {
                                $depo_query .= " WHERE lokomotif LIKE '%$searchQuery%' OR depo LIKE '%$searchQuery%' OR sifat LIKE '%$searchQuery%'";
                            }
                            $depo_result = mysqli_query($koneksi, $depo_query);
                            ?>
                            <table
                                id="cc206"
                                class="table table-striped table-bordered table-responsive"
                                cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokomotif</th>
                                        <th>Depo</th>
                                        <th>Sifat</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Action</th>
                                        <!-- <th width="100px">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $depo_query = "SELECT * FROM prwtan_cc206 NATURAL JOIN depo ";
                                    $depo_result = mysqli_query($koneksi, $depo_query);
                                    $no = 1;
                                    while ($depo = mysqli_fetch_assoc($depo_result)) {  ?>
                                        <tr>
                                            <td width='100' class='center'><?= $no ?></td>
                                            <td><?php echo $depo['lokomotif'] ?></td>
                                            <td><?php echo $depo['depo'] ?></td>
                                            <td><?php echo $depo['sifat'] ?></td>
                                            <td><?php echo $depo['tgl_selesai'] ?></td>
                                            <td>
                                                <!-- Tombol untuk membuka modal detail -->
                                                <button
                                                    class="btn btn-warning"
                                                    data-toggle="modal"
                                                    data-target="#cutomerDetailsModal"
                                                    data-id="<?php echo $depo['id_206']; ?>"
                                                    data-lokomotif="<?php echo $depo['lokomotif']; ?>"
                                                    data-depo="<?php echo $depo['depo']; ?>"
                                                    data-sifat="<?php echo $depo['sifat']; ?>"
                                                    data-tambah_baterai="<?php echo $depo['tambah_baterai']; ?>"
                                                    data-ganti_bearing="<?php echo $depo['ganti_bearing']; ?>"
                                                    data-kompressor_mo2="<?php echo $depo['kompressor_mo2']; ?>"
                                                    data-pindah_posisi="<?php echo $depo['pindah_posisi']; ?>"
                                                    data-pasang_ac="<?php echo $depo['pasang_ac']; ?>"
                                                    data-tgl_selesai="<?php echo $depo['tgl_selesai']; ?>"
                                                    style="border-radius:60px;">
                                                    <i class="fa fa-info-circle"></i>
                                                    View Details
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
        <a href="functionmis.php?menu=prog&id=<?php echo $depo['id_206']; ?>" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

                                            </td>

                                        </tr>

                                    <?php $no++;
                                    } ?>
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
    <div id="cutomerDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">
                        <b>Details</b>
                    </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>id</b>
                                </td>
                                <td id="id"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>LOKOMOTIF</b>
                                </td>
                                <td id="lokomotif"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>DEPO</b>
                                </td>
                                <td id="depo"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>SIFAT</b>
                                </td>
                                <td id="sifat"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>PENAMBAHAN PENDINGIN BATERAI</b>
                                </td>
                                <td id="tambah_baterai"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>PENGGANTIAN BEARING TM</b>
                                </td>
                                <td id="ganti_bearing"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>KOMPRESSOR MO 2</b>
                                </td>
                                <td id="kompressor_mo2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>PEMINDAHAN POSISI SULING</b>
                                </td>
                                <td id="pindah_posisi"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>PEMASANGAN AC</b>
                                </td>
                                <td id="pasang_ac"></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>SELESAI</b>
                                </td>
                                <td id="tgl_selesai"></td>
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
                            window.location.href = "export_pdf.php?id=" + id;
                        }
                    </script>

                    <!-- Tombol Edit -->
                    <button
                        type="button"
                        class="btn btn-info"
                        data-toggle="modal"
                        data-target="#editModal"
                        id="editButtonFromDetails">
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
                    <h4 class="modal-title text-center">
                        <b>Add Data</b>
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" method="POST" action="add_206.php">
                        <div class="form-group">
                            <label for="lokomotif">Lokomotif:</label>
                            <input type="text" class="form-control" name="lokomotif" required="required">
                        </div>
                        <div class="form-group">
                            <label for="depo">Depo:</label>
                            <input type="text" class="form-control" name="depo" required="required">
                        </div>
                        <div class="form-group">
                            <label for="sifat">Sifat:</label>
                            <input type="text" class="form-control" name="sifat" required="required">
                        </div>
                        <div class="form-group">
                            <label for="tambah_baterai">Penambahan Pendingin Baterai:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="tambah_baterai"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="ganti_beraing">Penggantian Bearing:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="ganti_bearing"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="kompressor_mo2">Kompressor MO 2:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="kompressor_mo2"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="pindah_posisi">Pemindahan Posisi Suling:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="pindah_posisi"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="pasang_ac">Pemasangan AC:</label>
                            <input type="text" class="form-control" name="pasang_ac" required="required">
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Selesai:</label>
                            <input type="date" class="form-control" name="tgl_selesai" required="required">
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
                    <h4 class="modal-title text-center">
                        <b>Edit Data</b>
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="edit_206.php">

                        <input type="hidden" id="edit_id" name="id_206">
                        <input type="hidden" id="edit_id_depo" name="id_depo">
                        <div class="form-group">
                            <label for="edit_lokomotif">Lokomotif:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_lokomotif"
                                name="lokomotif"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_depo">Depo:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_depo"
                                name="depo"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_sifat">Sifat:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_sifat"
                                name="sifat"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_tambah_baterai">Penambahan Pendingin Baterai:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_tambah_baterai"
                                name="tambah_baterai"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_ganti_bearing">Penggantian Bearing:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_ganti_bearing"
                                name="ganti_bearing"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_kompressor_mo2">Kompressor MO 2:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_kompressor_mo2"
                                name="kompressor_mo2"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_pindah_posisi">Pemindahan Posisi Suling:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_pindah_posisi"
                                name="pindah_posisi"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_pasang_ac">Pemasangan AC:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="edit_pasang_ac"
                                name="pasang_ac"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="edit_tgl_selesai">Selesai:</label>
                            <input
                                type="date"
                                class="form-control"
                                id="edit_tgl_selesai"
                                name="tgl_selesai"
                                required="required">
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
        new DataTable('#table1', {});
    </script>

    <!-- JavaScript untuk modal -->
    <script>
        $(document).ready(function() {
            $('#cutomerDetailsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang men-trigger modal

                // Ambil data dari tombol
                var id = button.data('id');
                var lokomotif = button.data('lokomotif');
                var depo = button.data('depo');
                var sifat = button.data('sifat');
                var tambah_baterai = button.data('tambah_baterai');
                var ganti_bearing = button.data('ganti_bearing');
                var kompressor_mo2 = button.data('kompressor_mo2');
                var pindah_posisi = button.data('pindah_posisi');
                var pasang_ac = button.data('pasang_ac');
                var tgl_selesai = button.data('tgl_selesai');

                // Masukkan data ke modal
                var modal = $(this);
                modal
                    .find('#id')
                    .text(id || 'Tidak Ada Data');
                modal
                    .find('#lokomotif')
                    .text(lokomotif || 'Tidak Ada Data');
                modal
                    .find('#depo')
                    .text(depo || 'Tidak Ada Data');
                modal
                    .find('#sifat')
                    .text(sifat || 'Tidak Ada Data');
                modal
                    .find('#tambah_baterai')
                    .text(tambah_baterai || 'Tidak Ada Data');
                modal
                    .find('#ganti_bearing')
                    .text(ganti_bearing || 'Tidak Ada Data');
                modal
                    .find('#kompressor_mo2')
                    .text(kompressor_mo2 || 'Tidak Ada Data');
                modal
                    .find('#pindah_posisi')
                    .text(pindah_posisi || 'Tidak Ada Data');
                modal
                    .find('#pasang_ac')
                    .text(pasang_ac || 'Tidak Ada Data');
                modal
                    .find('#tgl_selesai')
                    .text(tgl_selesai || 'Tidak Ada Data');

                $(document).ready(function() {
                    // Ketika tombol Edit di modal Detail diklik
                    $('#editButtonFromDetails').on('click', function() {
                        // Ambil data dari modal Detail
                        var id = $('#id').text();
                        var lokomotif = $('#lokomotif').text();
                        var depo = $('#depo').text();
                        var sifat = $('#sifat').text();
                        var tambah_baterai = $('#tambah_baterai').text();
                        var ganti_bearing = $('#ganti_bearing').text();
                        var kompressor_mo2 = $('#kompressor_mo2').text();
                        var pindah_posisi = $('#pindah_posisi').text();
                        var pasang_ac = $('#pasang_ac').text();
                        var tgl_selesai = $('#tgl_selesai').text();

                        // Isi modal Edit dengan data yang sudah ada
                        $('#editModal')
                            .find('#edit_id')
                            .val(id);
                        $('#editModal')
                            .find('#edit_lokomotif')
                            .val(lokomotif);
                        $('#editModal')
                            .find('#edit_depo')
                            .val(depo);
                        $('#editModal')
                            .find('#edit_sifat')
                            .val(sifat);
                        $('#editModal')
                            .find('#edit_tambah_baterai')
                            .val(tambah_baterai);
                        $('#editModal')
                            .find('#edit_ganti_bearing')
                            .val(ganti_bearing);
                        $('#editModal')
                            .find('#edit_kompressor_mo2')
                            .val(kompressor_mo2);
                        $('#editModal')
                            .find('#edit_pindah_posisi')
                            .val(pindah_posisi);
                        $('#editModal')
                            .find('#edit_pasang_ac')
                            .val(pasang_ac);
                        $('#editModal')
                            .find('#edit_tgl_selesai')
                            .val(tgl_selesai);
                    });
                });

            });
        });
    </script>

    <!-- Tambahkan juga jQuery dan Bootstrap JS di sini -->

    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
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

</html>