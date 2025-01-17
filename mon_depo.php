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
                <h1 class="mt-4">Monitoring Depo</h1>
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
                        <!-- Search Form -->
                        <!-- <form method="GET" action="">
                        <input class="datatable-input" name="search" placeholder="Search..." type="search" value="<?= htmlspecialchars($searchQuery); ?>" title="Search within table">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form> -->
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

                            $depo_query = "SELECT * FROM mon_depo NATURAL JOIN depo";
                            if ($searchQuery) {
                                $depo_query .= " WHERE lokomotif LIKE '%$searchQuery%' OR depo LIKE '%$searchQuery%' OR sifat LIKE '%$searchQuery%'";
                            }
                            $depo_result = mysqli_query($koneksi, $depo_query);
                            ?>
                            <table id="table2" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="mondepo">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Sarana</th>
                                        <th>Depo</th>
                                        <th>Nama Komponen</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Action</th>
                                        <!-- <th width="100px">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $depo_query = "SELECT * FROM mon_depo NATURAL JOIN depo ";
                                    $depo_result = mysqli_query($koneksi, $depo_query);
                                    $no = 1;
                                    while ($depo = mysqli_fetch_assoc($depo_result)) {  ?>
                                        <tr>
                                            <td width='100' class='center'><?= $no ?></td>
                                            <td><?php echo $depo['no_sarana'] ?></td>
                                            <td><?php echo $depo['depo'] ?></td>
                                            <td><?php echo $depo['komponen'] ?></td>
                                            <td><?php echo $depo['tgl_pasang'] ?></td>

                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#cutomerDetailsModal"
                                                    data-id="<?php echo $depo['id_mondp']; ?>"
                                                    data-lokomotif="<?php echo $depo['no_sarana']; ?>"
                                                    data-depo="<?php echo $depo['depo']; ?>"
                                                    data-asistensi="<?php echo $depo['asistensi']; ?>"
                                                    data-komponen="<?php echo $depo['komponen']; ?>"
                                                    data-no_seri="<?php echo $depo['no_seri']; ?>"
                                                    data-ket="<?php echo $depo['ket']; ?>"
                                                    data-tgl_pasang="<?php echo $depo['tgl_pasang']; ?>"
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
        <a href="functionmis.php?menu=prog&id=<?php echo $depo['id_mondp']; ?>" class="btn btn-danger">Hapus</a>
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
                    <h4 class="modal-title text-center"><b>Details</b></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>id</b></td>
                                <td id="id"></td>
                            </tr>
                            <tr>
                                <td><b>NO. SARANA</b></td>
                                <td id="no_sarana"></td>
                            </tr>
                            <tr>
                                <td><b>DEPO</b></td>
                                <td id="depo"></td>
                            </tr>
                            <tr>
                                <td><b>ASISTENSI DEPO</b></td>
                                <td id="asistensi"></td>
                            </tr>
                            <tr>
                                <td><b>KOMPONEN</b></td>
                                <td id="komponen"></td>
                            </tr>
                            <tr>
                                <td><b>NO KOMPONEN</b></td>
                                <td id="no_seri"></td>
                            </tr>
                            <tr>
                                <td><b>KETERANGAN KOMPONEN</b></td>
                                <td id="ket"></td>
                            </tr>
                            <tr>
                                <td><b>TANGGAL PASANG</b></td>
                                <td id="tgl_pasang"></td>
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
                            window.location.href = "export_depo.php?id=" + id;
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
                    <form id="addEmployeeForm" method="POST" action="add_depo.php">
                        <div class="form-group">
                            <label for="no_sarana">No. Sarana:</label>
                            <input type="text" class="form-control" name="no_sarana" required>
                        </div>
                        <div class="form-group">
                            <label for="depo">Depo:</label>
                            <input type="text" class="form-control" name="depo" required>
                        </div>
                        <div class="form-group">
                            <label for="asistensi">Asistensi Depo:</label>
                            <input type="text" class="form-control" name="asistensi" required>
                        </div>
                        <div class="form-group">
                            <label for="komponen">Komponen:</label>
                            <input type="text" class="form-control" name="komponen" required>
                        </div>
                        <div class="form-group">
                            <label for="no_seri">No. Komponen:</label>
                            <input type="text" class="form-control" name="no_seri" required>
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan Komponen:</label>
                            <input type="ket" class="form-control" name="ket" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pasang">Tanggal Pasang:</label>
                            <input type="date" class="form-control" name="tgl_pasang" required>
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
                    <form id="editForm" method="POST" action="edit_depo.php">

                        <input type="hidden" id="edit_id" name="id_md">
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
                            <label for="edit_asistensi">Asistensi Depo:</label>
                            <input type="text" class="form-control" id="edit_asistensi" name="asistensi" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_komponen">Komponen:</label>
                            <input type="text" class="form-control" id="edit_komponen" name="komponen" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_no_seri">No. Komponen:</label>
                            <input type="text" class="form-control" id="edit_no_seri" name="no_seri" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_keterangan_komponen">Keterangan Komponen:</label>
                            <input type="text" class="form-control" id="edit_keterangan_komponen" name="ket" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tgl_pasang">Tanggal_Pasang:</label>
                            <input type="date" class="form-control" id="edit_tgl_pasang" name="tgl_pasang" required>
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
        new DataTable('#table2', {

        });
    </script>

    <!-- JavaScript untuk modal -->
    <script>
        $(document).ready(function() {
            $('#cutomerDetailsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang men-trigger modal

                // Ambil data dari tombol
                var id = button.data('id');
                var no_sarana = button.data('lokomotif');
                var depo = button.data('depo');
                var asistensi = button.data('asistensi');
                var komponen = button.data('komponen');
                var no_seri = button.data('no_seri');
                var ket = button.data('ket');
                var tgl_pasang = button.data('tgl_pasang');

                var modal = $(this);
                modal.find('#id').text(id || 'Tidak Ada Data');
                modal.find('#no_sarana').text(no_sarana || 'Tidak Ada Data');
                modal.find('#depo').text(depo || 'Tidak Ada Data');
                modal.find('#asistensi').text(asistensi || 'Tidak Ada Data');
                modal.find('#komponen').text(komponen || 'Tidak Ada Data');
                modal.find('#no_seri').text(no_seri || 'Tidak Ada Data');
                modal.find('#ket').text(ket || 'Tidak Ada Data');
                modal.find('#tgl_pasang').text(tgl_pasang || 'Tidak Ada Data');
            });

            $('#editButtonFromDetails').on('click', function() {
                var id = $('#id').text();
                var no_sarana = $('#no_sarana').text();
                var depo = $('#depo').text();
                var asistensi = $('#asistensi').text();
                var komponen = $('#komponen').text();
                var no_seri = $('#no_seri').text();
                var ket = $('#ket').text();
                var tgl_pasang = $('#tgl_pasang').text();

                $('#editModal').find('#edit_id').val(id);
                $('#editModal').find('#edit_no_sarana').val(no_sarana);
                $('#editModal').find('#edit_depo').val(depo);
                $('#editModal').find('#edit_asistensi').val(asistensi);
                $('#editModal').find('#edit_komponen').val(komponen);
                $('#editModal').find('#edit_no_seri').val(no_seri);
                $('#editModal').find('#edit_keterangan_komponen').val(ket);
                $('#editModal').find('#edit_tgl_pasang').val(tgl_pasang);
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