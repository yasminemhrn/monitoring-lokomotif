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
                <h1 class="mt-4">Monitoring Program</h1>
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

                    $depo_query = "SELECT * FROM mon_prog NATURAL JOIN depo";
                    if ($searchQuery) {
                        $depo_query .= " WHERE lokomotif LIKE '%$searchQuery%' OR depo LIKE '%$searchQuery%' OR sifat LIKE '%$searchQuery%'";
                    }
                    $depo_result = mysqli_query($koneksi, $depo_query);
                    ?>
                    <table id="table3" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="monpb">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Lokomotif</th>
                            <th>Depo</th>
                            <th>Sifat</th>
                            <th>Work Order</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $depo_query= "SELECT * FROM mon_prog NATURAL JOIN depo ";
                            $depo_result = mysqli_query($koneksi, $depo_query);
                            $no = 1;
                            while ($depo = mysqli_fetch_assoc($depo_result)) {  ?>
                                <tr>
                                <td width='100' class='center'><?= $no ?></td>
                                    <td><?php echo $depo['lokomotif'] ?></td>
                                    <td><?php echo $depo['depo'] ?></td>
                                    <td><?php echo $depo['sifat'] ?></td>
                                    <td><?php echo $depo['work_order'] ?></td>
                                    <td>
                                        <!-- Tombol untuk membuka modal detail -->
                                        <button class="btn btn-warning" data-toggle="modal" 
                        data-target="#customerDetailsModal"
                        data-id="<?php echo isset($depo['id_prog']) ? $depo['id_prog'] : ''; ?>"
                        data-lokomotif="<?php echo isset($depo['lokomotif']) ? $depo['lokomotif'] : ''; ?>"
                        data-depo="<?php echo isset($depo['depo']) ? $depo['depo'] : ''; ?>"
                        data-sifat="<?php echo isset($depo['sifat']) ? $depo['sifat'] : ''; ?>"
                        data-work_order="<?php echo isset($depo['work_order']) ? $depo['work_order'] : ''; ?>"
                        data-engine="<?php echo isset($depo['engine']) ? $depo['engine'] : ''; ?>"
                        data-cj_1l="<?php echo isset($depo['cj_1l']) ? $depo['cj_1l'] : ''; ?>"
                        data-cj_2l="<?php echo isset($depo['cj_2l']) ? $depo['cj_2l'] : ''; ?>"
                        data-cj_3l="<?php echo isset($depo['cj_3l']) ? $depo['cj_3l'] : ''; ?>"
                        data-cj_4l="<?php echo isset($depo['cj_4l']) ? $depo['cj_4l'] : ''; ?>"
                        data-cj_1r="<?php echo isset($depo['cj_1r']) ? $depo['cj_1r'] : ''; ?>"
                        data-cj_2r="<?php echo isset($depo['cj_2r']) ? $depo['cj_2r'] : ''; ?>"
                        data-cj_3r="<?php echo isset($depo['cj_3r']) ? $depo['cj_3r'] : ''; ?>"
                        data-cj_4r="<?php echo isset($depo['cj_4r']) ? $depo['cj_4r'] : ''; ?>"
                        data-cl_1l="<?php echo isset($depo['cl_1l']) ? $depo['cl_1l'] : ''; ?>"
                        data-cl_2l="<?php echo isset($depo['cl_2l']) ? $depo['cl_2l'] : ''; ?>"
                        data-cl_3l="<?php echo isset($depo['cl_3l']) ? $depo['cl_3l'] : ''; ?>"
                        data-cl_4l="<?php echo isset($depo['cl_4l']) ? $depo['cl_4l'] : ''; ?>"
                        data-cl_1r="<?php echo isset($depo['cl_1r']) ? $depo['cl_1r'] : ''; ?>"
                        data-cl_2r="<?php echo isset($depo['cl_2r']) ? $depo['cl_2r'] : ''; ?>"
                        data-cl_3r="<?php echo isset($depo['cl_3r']) ? $depo['cl_3r'] : ''; ?>"
                        data-cl_4r="<?php echo isset($depo['cl_4r']) ? $depo['cl_4r'] : ''; ?>"
                        data-ip_1l="<?php echo isset($depo['ip_1l']) ? $depo['ip_1l'] : ''; ?>"
                        data-ip_2l="<?php echo isset($depo['ip_2l']) ? $depo['ip_2l'] : ''; ?>"
                        data-ip_3l="<?php echo isset($depo['ip_3l']) ? $depo['ip_3l'] : ''; ?>"
                        data-ip_4l="<?php echo isset($depo['ip_4l']) ? $depo['ip_4l'] : ''; ?>"
                        data-ip_1r="<?php echo isset($depo['ip_1r']) ? $depo['ip_1r'] : ''; ?>"
                        data-ip_2r="<?php echo isset($depo['ip_2r']) ? $depo['ip_2r'] : ''; ?>"
                        data-ip_3r="<?php echo isset($depo['ip_3r']) ? $depo['ip_3r'] : ''; ?>"
                        data-ip_4r="<?php echo isset($depo['ip_4r']) ? $depo['ip_4r'] : ''; ?>"
                        data-in_1l="<?php echo isset($depo['in_1l']) ? $depo['in_1l'] : ''; ?>"
                        data-in_2l="<?php echo isset($depo['in_2l']) ? $depo['in_2l'] : ''; ?>"
                        data-in_3l="<?php echo isset($depo['in_3l']) ? $depo['in_3l'] : ''; ?>"
                        data-in_4l="<?php echo isset($depo['in_4l']) ? $depo['in_4l'] : ''; ?>"
                        data-in_1r="<?php echo isset($depo['in_1r']) ? $depo['in_1r'] : ''; ?>"
                        data-in_2r="<?php echo isset($depo['in_2r']) ? $depo['in_2r'] : ''; ?>"
                        data-in_3r="<?php echo isset($depo['in_3r']) ? $depo['in_3r'] : ''; ?>"
                        data-in_4r="<?php echo isset($depo['in_4r']) ? $depo['in_4r'] : ''; ?>"
                        data-intercooler_r="<?php echo isset($depo['intercooler_r']) ? $depo['intercooler_r'] : ''; ?>"
                        data-intercooler_l="<?php echo isset($depo['intercooler_l']) ? $depo['intercooler_l'] : ''; ?>"
                        data-oil_pump="<?php echo isset($depo['oil_pump']) ? $depo['oil_pump'] : ''; ?>"
                        data-water_pump="<?php echo isset($depo['water_pump']) ? $depo['water_pump'] : ''; ?>"
                        data-turbocharger="<?php echo isset($depo['turbocharger']) ? $depo['turbocharger'] : ''; ?>"
                        data-governor_md="<?php echo isset($depo['governor_md']) ? $depo['governor_md'] : ''; ?>"
                        data-overspeed_md="<?php echo isset($depo['overspeed_md']) ? $depo['overspeed_md'] : ''; ?>"
                        data-air_compressor="<?php echo isset($depo['air_compressor']) ? $depo['air_compressor'] : ''; ?>"
                        data-fan_radiator="<?php echo isset($depo['fan_radiator']) ? $depo['fan_radiator'] : ''; ?>"
                        data-lube_oil="<?php echo isset($depo['lube_oil']) ? $depo['lube_oil'] : ''; ?>"
                        data-radiator="<?php echo isset($depo['radiator']) ? $depo['radiator'] : ''; ?>"
                        data-automaticbrake_1="<?php echo isset($depo['automaticbrake_1']) ? $depo['automaticbrake_1'] : ''; ?>"
                        data-automaticbrake_2="<?php echo isset($depo['automaticbrake_2']) ? $depo['automaticbrake_2'] : ''; ?>"
                        data-independentbrake_1="<?php echo isset($depo['independentbrake_1']) ? $depo['independentbrake_1'] : ''; ?>"
                        data-independentbrake_2="<?php echo isset($depo['independentbrake_2']) ? $depo['independentbrake_2'] : ''; ?>"
                        data-blower_tm="<?php echo isset($depo['blower_tm']) ? $depo['blower_tm'] : ''; ?>"
                        data-exhauster="<?php echo isset($depo['exhauster']) ? $depo['exhauster'] : ''; ?>"
                        data-auxilary_gen="<?php echo isset($depo['auxilary_gen']) ? $depo['auxilary_gen'] : ''; ?>"
                        data-exciter_gen="<?php echo isset($depo['exciter_gen']) ? $depo['exciter_gen'] : ''; ?>"
                        data-main_gen="<?php echo isset($depo['main_gen']) ? $depo['main_gen'] : ''; ?>"
                        data-tl_1="<?php echo isset($depo['tl_1']) ? $depo['tl_1'] : ''; ?>"
                        data-tl_2="<?php echo isset($depo['tl_2']) ? $depo['tl_2'] : ''; ?>"
                        data-tl_3="<?php echo isset($depo['tl_3']) ? $depo['tl_3'] : ''; ?>"
                        data-tl_4="<?php echo isset($depo['tl_4']) ? $depo['tl_4'] : ''; ?>"
                        data-tl_5="<?php echo isset($depo['tl_5']) ? $depo['tl_5'] : ''; ?>"
                        data-tl_6="<?php echo isset($depo['tl_6']) ? $depo['tl_6'] : ''; ?>"
                        data-battery="<?php echo isset($depo['battery']) ? $depo['battery'] : ''; ?>"
                        data-full_pump="<?php echo isset($depo['full_pump']) ? $depo['full_pump'] : ''; ?>"
                        data-dyn_brake="<?php echo isset($depo['dyn_brake']) ? $depo['dyn_brake'] : ''; ?>"
                        data-volt_regulator="<?php echo isset($depo['volt_regulator']) ? $depo['volt_regulator'] : ''; ?>"
                        data-br_1="<?php echo isset($depo['br_1']) ? $depo['br_1'] : ''; ?>"
                        data-br_2="<?php echo isset($depo['br_2']) ? $depo['br_2'] : ''; ?>"
                        data-be_1="<?php echo isset($depo['be_1']) ? $depo['be_1'] : ''; ?>"
                        data-be_2="<?php echo isset($depo['be_2']) ? $depo['be_2'] : ''; ?>"
                        data-sdis_1="<?php echo isset($depo['sdis_1']) ? $depo['sdis_1'] : ''; ?>"
                        data-sdis_2="<?php echo isset($depo['sdis_2']) ? $depo['sdis_2'] : ''; ?>"
                        data-bs_1="<?php echo isset($depo['bs_1']) ? $depo['bs_1'] : ''; ?>"
                        data-bs_2="<?php echo isset($depo['bs_2']) ? $depo['bs_2'] : ''; ?>"
                        data-ws_1="<?php echo isset($depo['ws_1']) ? $depo['ws_1'] : ''; ?>"
                        data-ws_2="<?php echo isset($depo['ws_2']) ? $depo['ws_2'] : ''; ?>"
                        data-ws_3="<?php echo isset($depo['ws_3']) ? $depo['ws_3'] : ''; ?>"
                        data-ws_4="<?php echo isset($depo['ws_4']) ? $depo['ws_4'] : ''; ?>"
                        data-ws_5="<?php echo isset($depo['ws_5']) ? $depo['ws_5'] : ''; ?>"
                        data-ws_6="<?php echo isset($depo['ws_6']) ? $depo['ws_6'] : ''; ?>"
                        data-km="<?php echo isset($depo['km']) ? $depo['km'] : ''; ?>"
                        data-sap="<?php echo isset($depo['sap']) ? $depo['sap'] : ''; ?>"
                        data-dt="<?php echo isset($depo['dt']) ? $depo['dt'] : ''; ?>"
                        data-input_roda="<?php echo isset($depo['input_roda']) ? $depo['input_roda'] : ''; ?>"
                        data-pic="<?php echo isset($depo['pic']) ? $depo['pic'] : ''; ?>"
                        data-buku_prwtn="<?php echo isset($depo['buku_prwtn']) ? $depo['buku_prwtn'] : ''; ?>"
                        data-sertikasi_dirjen="<?php echo isset($depo['sertikasi_dirjen']) ? $depo['sertikasi_dirjen'] : ''; ?>"
                        data-softcopy="<?php echo isset($depo['softcopy']) ? $depo['softcopy'] : ''; ?>"
                        data-checksheet="<?php echo isset($depo['checksheet']) ? $depo['checksheet'] : ''; ?>"
                        data-f7="<?php echo isset($depo['f7']) ? $depo['f7'] : ''; ?>"
                        data-tgl_msk="<?php echo isset($depo['tgl_msk']) ? $depo['tgl_msk'] : ''; ?>"
                        data-tgl_klr="<?php echo isset($depo['tgl_klr']) ? $depo['tgl_klr'] : ''; ?>"
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
        <a href="functionmis.php?menu=prog&id=<?php echo $depo['id_prog']; ?>" class="btn btn-danger">Hapus</a>
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
                        <td><b>ID</b></td>
                        <td id="id"></td>
                    </tr>
                    <tr>
                        <td><b>Lokomotif</b></td>
                        <td id="lokomotif"></td>
                    </tr>
                    <tr>
                        <td><b>Depo</b></td>
                        <td id="depo"></td>
                    </tr>
                    <tr>
                        <td><b>Sifat</b></td>
                        <td id="sifat"></td>
                    </tr>
                    <tr>
                        <td><b>Work Order</b></td>
                        <td id="work_order"></td>
                    </tr>
                    <tr>
                        <td><b>Masuk</b></td>
                        <td id="tgl_msk"></td>
                    </tr>
                    <tr>
                        <td><b>Selesai</b></td>
                        <td id="tgl_klr"></td>
                    </tr>
                    <tr>
                        <td><b>Engine</b></td>
                        <td id="engine"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 1L</b></td>
                        <td id="cj_1l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 2L</b></td>
                        <td id="cj_2l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder JacketT 3L</b></td>
                        <td id="cj_3l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 4L</b></td>
                        <td id="cj_4l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 1R</b></td>
                        <td id="cj_1r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 2R</b></td>
                        <td id="cj_2r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 3R</b></td>
                        <td id="cj_3r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Jacket 4R</b></td>
                        <td id="cj_4r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 1L</b></td>
                        <td id="cl_1l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 2L</b></td>
                        <td id="cl_2l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 3L</b></td>
                        <td id="cl_3l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 4L</b></td>
                        <td id="cl_4l"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 1R</b></td>
                        <td id="cl_1r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 2R</b></td>
                        <td id="cl_2r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 3R</b></td>
                        <td id="cl_3r"></td>
                    </tr>
                    <tr>
                        <td><b>Cylinder Linier 4R</b></td>
                        <td id="cl_4r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 1L</b></td>
                        <td id="ip_1l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 2L</b></td>
                        <td id="ip_2l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 3L</b></td>
                        <td id="ip_3l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 4L</b></td>
                        <td id="ip_4l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 1R</b></td>
                        <td id="ip_1r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 2R</b></td>
                        <td id="ip_2r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 3R</b></td>
                        <td id="ip_3r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Pump 4R</b></td>
                        <td id="ip_4r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 1L</b></td>
                        <td id="in_1l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 2L</b></td>
                        <td id="in_2l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 3L</b></td>
                        <td id="in_3l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 4L</b></td>
                        <td id="in_4l"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 1R</b></td>
                        <td id="in_1r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 2R</b></td>
                        <td id="in_2r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 3R</b></td>
                        <td id="in_3r"></td>
                    </tr>
                    <tr>
                        <td><b>Injection Nozzle 4R</b></td>
                        <td id="in_4r"></td>
                    </tr>
                    <tr>
                        <td><b>Intercooler R</b></td>
                        <td id="intercooler_r"></td>
                    </tr>
                    <tr>
                        <td><b>Intercooler L</b></td>
                        <td id="intercooler_l"></td>
                    </tr>
                    <tr>
                        <td><b>Oil Pump</b></td>
                        <td id="oil_pump"></td>
                    </tr>
                    <tr>
                        <td><b>Water Pump</b></td>
                        <td id="water_pump"></td>
                    </tr>
                    <tr>
                        <td><b>Turbocharger</b></td>
                        <td id="turbocharger"></td>
                    </tr>
                    <tr>
                        <td><b>Governor MD</b></td>
                        <td id="governor_md"></td>
                    </tr>
                    <tr>
                        <td><b>Overspeed MD</b></td>
                        <td id="overspeed_md"></td>
                    </tr>
                    <tr>
                        <td><b>Air Compressor</b></td>
                        <td id="air_compressor"></td>
                    </tr>
                    <tr>
                        <td><b>Fan Radiator</b></td>
                        <td id="fan_radiator"></td>
                    </tr>
                    <tr>
                        <td><b>Lube Oil</b></td>
                        <td id="lube_oil"></td>
                    </tr>
                    <tr>
                        <td><b>Radiator</b></td>
                        <td id="radiator"></td>
                    </tr>
                    <tr>
                        <td><b>Automatic Brake 1</b></td>
                        <td id="automaticbrake_1"></td>
                    </tr>
                    <tr>
                        <td><b>Automatic Brake 2</b></td>
                        <td id="automaticbrake_2"></td>
                    </tr>
                    <tr>
                        <td><b>Independent Brake 1</b></td>
                        <td id="independentbrake_1"></td>
                    </tr>
                    <tr>
                        <td><b>Independent Brake 2</b></td>
                        <td id="independentbrake_2"></td>
                    </tr>
                    <tr>
                        <td><b>Blower TM</b></td>
                        <td id="blower_tm"></td>
                    </tr>
                    <tr>
                        <td><b>Exhauster</b></td>
                        <td id="exhauster"></td>
                    </tr>
                    <tr>
                        <td><b>Auxilary Generator</b></td>
                        <td id="auxilary_gen"></td>
                    </tr>
                    <tr>
                        <td><b>Exciter Generator</b></td>
                        <td id="exciter_gen"></td>
                    </tr>
                    <tr>
                        <td><b>Main Generator</b></td>
                        <td id="main_gen"></td>
                    </tr>
                    <tr>
                        <td><b>Traksi  Motor 1</b></td>
                        <td id="tl_1"></td>
                    </tr>
                    <tr>
                        <td><b>Traksi  Motor 2</b></td>
                        <td id="tl_2"></td>
                    </tr>
                    <tr>
                        <td><b>Traksi  Motor 3</b></td>
                        <td id="tl_3"></td>
                    </tr>
                    <tr>
                        <td><b>Traksi  Motor 4</b></td>
                        <td id="tl_4"></td>
                    </tr><tr>
                        <td><b>Traksi  Motor 5</b></td>
                        <td id="tl_5"></td>
                    </tr>
                    <tr>
                        <td><b>Traksi  Motor 6</b></td>
                        <td id="tl_6"></td>
                    </tr>
                    <tr>
                        <td><b>Battery</b></td>
                        <td id="battery"></td>
                    </tr>
                    <tr>
                        <td><b>Full Pump</b></td>
                        <td id="full_pump"></td>
                    </tr>
                    <tr>
                        <td><b>Dyn. Brake Blower</b></td>
                        <td id="dyn_brake"></td>
                    </tr>
                    </tr><tr>
                        <td><b>Voltage Regulator</b></td>
                        <td id="volt_regulator"></td>
                    </tr>
                    <tr>
                        <td><b>Blower Rectifier 1</b></td>
                        <td id="br_1"></td>
                    </tr>
                    <tr>
                        <td><b>Blower Rectifier 2</b></td>
                        <td id="br_2"></td>
                    </tr>
                    <tr>
                        <td><b>Blower Exhauster 1</b></td>
                        <td id="be_1"></td>
                    </tr>
                    <tr>
                        <td><b>Blower Exhauster 2</b></td>
                        <td id="be_2"></td>
                    </tr>
                    <tr>
                        <td><b>SDIS 1</b></td>
                        <td id="sdis_1"></td>
                    </tr>
                    </tr><tr>
                        <td><b>SDIS 2</b></td>
                        <td id="sdis_2"></td>
                    </tr>
                    <tr>
                        <td><b>Boogie Sets 1</b></td>
                        <td id="bs_1"></td>
                    </tr>
                    <tr>
                        <td><b>Boogie Sets 2</b></td>
                        <td id="bs_2"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 1</b></td>
                        <td id="ws_1"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 2</b></td>
                        <td id="ws_2"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 3</b></td>
                        <td id="ws_3"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 4</b></td>
                        <td id="ws_4"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 5</b></td>
                        <td id="ws_5"></td>
                    </tr>
                    <tr>
                        <td><b>Wheel Sets 6</b></td>
                        <td id="ws_6"></td>
                    </tr>
                    <tr>
                        <td><b>Kilometer Tempuh</b></td>
                        <td id="km"></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Data SAP</b></td>
                        <td id="sap"></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Database</b></td>
                        <td id="dt"></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Input Roda</b></td>
                        <td id="input_roda"></td>
                    </tr>
                    <tr>
                        <td><b>PIC</b></td>
                        <td id="pic"></td>
                    </tr>
                    <tr>
                        <td><b>Buku Perawatan</b></td>
                        <td id="buku_prwtn"></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Kirim Sertikasi Dirjen</b></td>
                        <td id="sertikasi_dirjen"></td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Kirim Softcopy Buku Perawatan Ke Depo</b></td>
                        <td id="softcopy"></td>
                    </tr>
                    <tr>
                        <td><b>Kelengkapan Checksheet</b></td>
                        <td id="checksheet"></td>
                    </tr>
                    <tr>
                        <td><b>F7 Pdf</b></td>
                        <td id="f7"></td>
                    </tr>

                    </tbody>
                </table>

                
    
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
                <form id="addEmployeeForm" method="POST" action="add_prog.php">
                    <div class="form-group">
                        <label for="lokomotif">Lokomotif:</label>
                        <input type="text" class="form-control" name="lokomotif">
                    </div>
                    <div class="form-group">
                        <label for="depo">Depo:</label>
                        <input type="text" class="form-control" name="depo">
                    </div>
                    <div class="form-group">
                        <label for="work_order">Work Order:</label>
                        <input type="text" class="form-control" name="work_order">
                    </div>
                    <div class="form-group">
                        <label for="sifat">Sifat:</label>
                        <input type="text" class="form-control" name="sifat">
                    </div>
                    <div class="form-group">
                        <label for="tgl_msk">Tanggal Masuk:</label>
                        <input type="date" class="form-control" name="tgl_msk">
                    </div>
                    <div class="form-group">
                        <label for="tgl_klr">Tanggal Keluar:</label>
                        <input type="date" class="form-control" name="tgl_klr">
                    </div>
                    <div class="form-group">
                        <label for="engine">Engine:</label>
                        <input type="text" class="form-control" name="engine">
                    </div>
                    <div class="form-group">
                        <label for="cj_1l">Cylinder Jacket 1L:</label>
                        <input type="text" class="form-control" name="cj_1l">
                    </div>
                    <div class="form-group">
                        <label for="cj_2l">Cylinder Jacket 2L:</label>
                        <input type="text" class="form-control" name="cj_2l">
                    </div>
                    <div class="form-group">
                        <label for="cj_3l">Cylinder Jacket 3L:</label>
                        <input type="text" class="form-control" name="cj_3l">
                    </div>
                    <div class="form-group">
                        <label for="cj_4l">Cylinder Jacket 4L:</label>
                        <input type="text" class="form-control" name="cj_4l">
                    </div>
                    <div class="form-group">
                        <label for="cj_1r">Cylinder Jacket 1R:</label>
                        <input type="text" class="form-control" name="cj_1r">
                    </div>
                    <div class="form-group">
                        <label for="cj_2r">Cylinder Jacket 2R:</label>
                        <input type="text" class="form-control" name="cj_2r">
                    </div>
                    <div class="form-group">
                        <label for="cj_3r">Cylinder Jacket 3R:</label>
                        <input type="text" class="form-control" name="cj_3r">
                    </div>
                    <div class="form-group">
                        <label for="cj_4r">Cylinder Jacket 4R:</label>
                        <input type="text" class="form-control" name="cj_4r">
                    </div>
                    <div class="form-group">
                        <label for="cl_1l">Cylinder Linier 1L:</label>
                        <input type="text" class="form-control" name="cl_1l">
                    </div>
                    <div class="form-group">
                        <label for="cl_2l">Cylinder Linier 2L:</label>
                        <input type="text" class="form-control" name="cl_2l">
                    </div>
                    <div class="form-group">
                        <label for="cl_3l">Cylinder Linier 3L:</label>
                        <input type="text" class="form-control" name="cl_3l">
                    </div>
                    <div class="form-group">
                        <label for="cl_4l">Cylinder Linier 4L:</label>
                        <input type="text" class="form-control" name="cl_4l">
                    </div>
                    <div class="form-group">
                        <label for="cl_1r">Cylinder Linier 1R:</label>
                        <input type="text" class="form-control" name="cl_1r">
                    </div>
                    <div class="form-group">
                        <label for="cl_2r">Cylinder Linier 2R:</label>
                        <input type="text" class="form-control" name="cl_2r">
                    </div>
                    <div class="form-group">
                        <label for="cl_3r">Cylinder Linier 3R:</label>
                        <input type="text" class="form-control" name="cl_3r">
                    </div>
                    <div class="form-group">
                        <label for="cl_4r">Cylinder Linier 4R:</label>
                        <input type="text" class="form-control" name="cl_4r">
                    </div>
                    <div class="form-group">
                        <label for="ip_1l">Injection Pump 1L:</label>
                        <input type="text" class="form-control" name="ip_1l">
                    </div>
                    <div class="form-group">
                        <label for="ip_2l">Injection Pump 2L:</label>
                        <input type="text" class="form-control" name="ip_2l">
                    </div>
                    <div class="form-group">
                        <label for="ip_3l">Injection Pump 3L:</label>
                        <input type="text" class="form-control" name="ip_3l">
                    </div>
                    <div class="form-group">
                        <label for="ip_4l">Injection Pump 4L:</label>
                        <input type="text" class="form-control" name="ip_4l">
                    </div>
                    <div class="form-group">
                        <label for="ip_1r">Injection Pump 1R:</label>
                        <input type="text" class="form-control" name="ip_1r">
                    </div>
                    <div class="form-group">
                        <label for="ip_2r">Injection Pump 2R:</label>
                        <input type="text" class="form-control" name="ip_2r">
                    </div>
                    <div class="form-group">
                        <label for="ip_3r">Injection Pump 3R:</label>
                        <input type="text" class="form-control" name="ip_3r">
                    </div>
                    <div class="form-group">
                        <label for="ip_4r">Injection Pump 4R:</label>
                        <input type="text" class="form-control" name="ip_4r">
                    </div>
                    <div class="form-group">
                        <label for="in_1l">Injection Nozzle 1L:</label>
                        <input type="text" class="form-control" name="in_1l">
                    </div>
                    <div class="form-group">
                        <label for="in_2l">Injection Nozzle 2L:</label>
                        <input type="text" class="form-control" name="in_2l">
                    </div>
                    <div class="form-group">
                        <label for="in_3l">Injection Nozzle 3L:</label>
                        <input type="text" class="form-control" name="in_3l">
                    </div>
                    <div class="form-group">
                        <label for="in_4l">Injection Nozzle 4L:</label>
                        <input type="text" class="form-control" name="in_4l">
                    </div>
                    <div class="form-group">
                        <label for="in_1r">Injection Nozzle 1R:</label>
                        <input type="text" class="form-control" name="in_1r">
                    </div>
                    <div class="form-group">
                        <label for="in_2r">Injection Nozzle 2R:</label>
                        <input type="text" class="form-control" name="in_2r">
                    </div>
                    <div class="form-group">
                        <label for="in_3r">Injection Nozzle 3R:</label>
                        <input type="text" class="form-control" name="in_3r">
                    </div>
                    <div class="form-group">
                        <label for="in_4r">Injection Nozzle 4R:</label>
                        <input type="text" class="form-control" name="in_4r">
                    </div>
                    <div class="form-group">
                        <label for="intercooler_r">Intercooler R:</label>
                        <input type="text" class="form-control" name="intercooler_r">
                    </div>
                    <div class="form-group">
                        <label for="intercooler_l">Intercooler L:</label>
                        <input type="text" class="form-control" name="intercooler_l">
                    </div>
                    <div class="form-group">
                        <label for="oil_pump">Oil Pump:</label>
                        <input type="text" class="form-control" name="oil_pump">
                    </div>
                    <div class="form-group">
                        <label for="water_pump">Water Pump:</label>
                        <input type="text" class="form-control" name="water_pump">
                    </div>
                    <div class="form-group">
                        <label for="turbocharger">Turbocharger:</label>
                        <input type="text" class="form-control" name="turbocharger">
                    </div>
                    <div class="form-group">
                        <label for="governor_md">Governor MD:</label>
                        <input type="text" class="form-control" name="governor_md">
                    </div>
                    <div class="form-group">
                        <label for="overspeed_md">Overspeed MD:</label>
                        <input type="text" class="form-control" name="overspeed_md">
                    </div>
                    <div class="form-group">
                        <label for="air_compressor">Air Compressor:</label>
                        <input type="text" class="form-control" name="air_compressor">
                    </div>
                    <div class="form-group">
                        <label for="fan_radiator">Fan Radiator:</label>
                        <input type="text" class="form-control" name="fan_radiator">
                    </div>
                    <div class="form-group">
                        <label for="lube_oil">Lube Oil:</label>
                        <input type="text" class="form-control" name="lube_oil">
                    </div>
                    <div class="form-group">
                        <label for="radiator">Radiator:</label>
                        <input type="text" class="form-control" name="radiator">
                    </div>
                    <div class="form-group">
                        <label for="automaticbrake_1">Automatic Brake 1:</label>
                        <input type="text" class="form-control" name="automaticbrake_1">
                    </div>
                    <div class="form-group">
                        <label for="automaticbrake_2">Automatic Brake 2:</label>
                        <input type="text" class="form-control" name="automaticbrake_2">
                    </div>
                    <div class="form-group">
                        <label for="independentbrake_1">Independent Brake 1:</label>
                        <input type="text" class="form-control" name="independentbrake_1">
                    </div>
                    <div class="form-group">
                        <label for="independentbrake_2">Independent Brake 2:</label>
                        <input type="text" class="form-control" name="independentbrake_2">
                    </div>
                    <div class="form-group">
                        <label for="blower_tm">Blower TM:</label>
                        <input type="text" class="form-control" name="blower_tm">
                    </div>
                    <div class="form-group">
                        <label for="exhauster">Exhauster:</label>
                        <input type="text" class="form-control" name="exhauster">
                    </div>
                    <div class="form-group">
                        <label for="auxilary_gen">Auxilary Generator:</label>
                        <input type="text" class="form-control" name="auxilary_gen">
                    </div>
                    <div class="form-group">
                        <label for="exciter_gen">Exciter Generator:</label>
                        <input type="text" class="form-control" name="exciter_gen">
                    </div>
                    <div class="form-group">
                        <label for="exhauster">Exhauster:</label>
                        <input type="text" class="form-control" name="exhauster">
                    </div>
                    <div class="form-group">
                        <label for="main_gen">Main Generator:</label>
                        <input type="text" class="form-control" name="main_gen">
                    </div>
                    <div class="form-group">
                        <label for="tl_1">Traksi Motor 1:</label>
                        <input type="text" class="form-control" name="tl_1">
                    </div>
                    <div class="form-group">
                        <label for="tl_2">Traksi Motor 2:</label>
                        <input type="text" class="form-control" name="tl_2">
                    </div>
                    <div class="form-group">
                        <label for="tl_3">Traksi Motor 3:</label>
                        <input type="text" class="form-control" name="tl_3">
                    </div>
                    <div class="form-group">
                        <label for="tl_4">Traksi Motor 4:</label>
                        <input type="text" class="form-control" name="tl_4">
                    </div>
                    <div class="form-group">
                        <label for="tl_5">Traksi Motor 5:</label>
                        <input type="text" class="form-control" name="tl_5">
                    </div>
                    <div class="form-group">
                        <label for="tl_6">Traksi Motor 6:</label>
                        <input type="text" class="form-control" name="tl_6">
                    </div>
                    <div class="form-group">
                        <label for="battery">Battery:</label>
                        <input type="text" class="form-control" name="battery">
                    </div>
                    <div class="form-group">
                        <label for="full_pump">Full Pump:</label>
                        <input type="text" class="form-control" name="full_pump">
                    </div>
                    <div class="form-group">
                        <label for="dyn_brake">Dyn. Brake Blower:</label>
                        <input type="text" class="form-control" name="dyn_brake">
                    </div>
                    <div class="form-group">
                        <label for="volt_regulator">Voltage Regulator:</label>
                        <input type="text" class="form-control" name="volt_regulator">
                    </div>
                    <div class="form-group">
                        <label for="br_1">Blower Rectifier 1:</label>
                        <input type="text" class="form-control" name="br_1">
                    </div>
                    <div class="form-group">
                        <label for="br_2">Blower Rectifier 2:</label>
                        <input type="text" class="form-control" name="br_2">
                    </div>
                    <div class="form-group">
                        <label for="be_1">Blower Exhauster 1:</label>
                        <input type="text" class="form-control" name="be_1">
                    </div>
                    <div class="form-group">
                        <label for="be_2">Blower Exhauster 2:</label>
                        <input type="text" class="form-control" name="be_2">
                    </div>
                    <div class="form-group">
                        <label for="sdis_1">SDIS 1:</label>
                        <input type="text" class="form-control" name="sdis_1">
                    </div>
                    <div class="form-group">
                        <label for="sdis_2">SDIS 2:</label>
                        <input type="text" class="form-control" name="sdis_2">
                    </div>
                    <div class="form-group">
                        <label for="bs_1">Boogie Sets 1:</label>
                        <input type="text" class="form-control" name="bs_1">
                    </div>
                    <div class="form-group">
                        <label for="bs_2">Boogie Sets 2:</label>
                        <input type="text" class="form-control" name="bs_2">
                    </div>
                    <div class="form-group">
                        <label for="ws_1">Wheel Sets 1:</label>
                        <input type="text" class="form-control" name="ws_1">
                    </div>
                    <div class="form-group">
                        <label for="ws_2">Wheel Sets 2:</label>
                        <input type="text" class="form-control" name="ws_2">
                    </div>
                    <div class="form-group">
                        <label for="ws_3">Wheel Sets 3:</label>
                        <input type="text" class="form-control" name="ws_3">
                    </div>
                    <div class="form-group">
                        <label for="ws_4">Wheel Sets 4:</label>
                        <input type="text" class="form-control" name="ws_4">
                    </div>
                    <div class="form-group">
                        <label for="ws_5">Wheel Sets 5:</label>
                        <input type="text" class="form-control" name="ws_5">
                    </div>
                    <div class="form-group">
                        <label for="ws_6">Wheel Sets 6:</label>
                        <input type="text" class="form-control" name="ws_6">
                    </div>
                    <div class="form-group">
                        <label for="km">Kilometer Tempuh:</label>
                        <input type="text" class="form-control" name="km">
                    </div>
                    <div class="form-group">
                        <label for="sap">Tanggal Data SAP:</label>
                        <input type="date" class="form-control" name="sap">
                    </div>
                    <div class="form-group">
                        <label for="dt">Tanggal Database:</label>
                        <input type="date" class="form-control" name="dt">
                    </div>
                    <div class="form-group">
                        <label for="input_roda">Tanggal Input Data Roda:</label>
                        <input type="date" class="form-control" name="input_roda">
                    </div>
                    <div class="form-group">
                        <label for="pic">PIC:</label>
                        <input type="text" class="form-control" name="pic">
                    </div>
                    <div class="form-group">
                        <label for="buku_prwtn">Buku Perawatan:</label>
                        <input type="date" class="form-control" name="buku_prwtn">
                    </div>
                    <div class="form-group">
                        <label for="sertikasi_dirjen">Tanggal Kirim Sertikasi  Dirjen:</label>
                        <input type="date" class="form-control" name="sertikasi_dirjen">
                    </div>
                    <div class="form-group">
                        <label for="softcopy">Tanggal Kirim Softcopy Buku Riwayat Ke Depo:</label>
                        <input type="date" class="form-control" name="softcopy">
                    </div>
                    <div class="form-group">
                        <label for="checksheet">Checksheet:</label>
                        <input type="text" class="form-control" name="checksheet">
                    </div>
                    <div class="form-group">
                        <label for="f7">F7 Pdf:</label>
                        <input type="date" class="form-control" name="f7">
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
                 <form id="editForm" method="POST" action="edit_prog.php"> 

                 <input type="hidden" id="edit_id" name="id_prog" > 
                 <input type="hidden" id="edit_id_depo" name="id_depo"> 
                     <div class="form-group"> 
                         <label for="edit_lokomotif">Lokomotif:</label> 
                         <input type="text" class="form-control" id="edit_lokomotif" name="lokomotif" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_depo">Depo:</label>
                        <input type="text" class="form-control" id="edit_depo" name="depo" required>
                    </div> 
                     <div class="form-group">
                        <label for="edit_sifat">Sifat:</label>
                        <input type="text" class="form-control" id="edit_sifat" name="sifat" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_work_order">Work Order:</label>
                        <input type="text" class="form-control" id="edit_work_order" name="work_order" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_tgl_msk">Masuk:</label>
                        <input type="date" class="form-control" id="edit_tgl_msk" name="tgl_msk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tgl_klr">Keluar:</label>
                        <input type="date" class="form-control" id="edit_tgl_klr" name="tgl_klr" required>
                    </div>
                     <div class="form-group">
                        <label for="edit_engine">Engine:</label>
                        <input type="text" class="form-control" id="edit_engine" name="engine" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cj_1l">Cylinder Jacket 1L:</label>
                        <input type="text" class="form-control" id="edit_cj_1l" name="cj_1l" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cj_2l">Cylinder Jacket 2L:</label>
                        <input type="text" class="form-control" id="edit_cj_2l" name="cj_2l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_cj_3l">Cylinder Jacket 3L:</label>
                        <input type="text" class="form-control" id="edit_cj_3l" name="cj_3l" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cj_4l">Cylinder Jacket 4L:</label>
                        <input type="text" class="form-control" id="edit_cj_4l" name="cj_4l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_cj_1r">Cylinder Jacket 1R:</label>
                        <input type="text" class="form-control" id="edit_cj_1r" name="cj_1r" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cj_2r">Cylinder Jacket 2R:</label>
                        <input type="text" class="form-control" id="edit_cj_2r" name="cj_2r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_cj_3r">Cylinder Jacket 3R:</label>
                        <input type="text" class="form-control" id="edit_cj_3r" name="cj_3r" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cj_4r">Cylinder Jacket 4R:</label>
                        <input type="text" class="form-control" id="edit_cj_4r" name="cj_4r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_1l">Injection Pump 1L:</label>
                        <input type="text" class="form-control" id="edit_ip_1l" name="ip_1l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_2l">Injection Pump 2L:</label>
                        <input type="text" class="form-control" id="edit_ip_2l" name="ip_2l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_3l">Injection Pump 3L:</label>
                        <input type="text" class="form-control" id="edit_ip_3l" name="ip_3l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_4l">Injection Pump 4L:</label>
                        <input type="text" class="form-control" id="edit_ip_4l" name="ip_4l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_1r">Injection Pump 1R:</label>
                        <input type="text" class="form-control" id="edit_ip_1r" name="ip_1r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_2r">Injection Pump 2R:</label>
                        <input type="text" class="form-control" id="edit_ip_2r" name="ip_2r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_3r">Injection Pump 3R:</label>
                        <input type="text" class="form-control" id="edit_ip_3r" name="ip_3r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_ip_4r">Injection Pump 4R:</label>
                        <input type="text" class="form-control" id="edit_ip_4r" name="ip_4r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_1l">Injection Nozzle 1L:</label>
                        <input type="text" class="form-control" id="edit_in_1l" name="in_1l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_2l">Injection Nozzle 2L:</label>
                        <input type="text" class="form-control" id="edit_in_2l" name="in_2l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_3l">Injection Nozzle 3L:</label>
                        <input type="text" class="form-control" id="edit_in_3l" name="in_3l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_4l">Injection Nozzle 4L:</label>
                        <input type="text" class="form-control" id="edit_in_4l" name="in_4l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_1r">Injection Nozzle 1R:</label>
                        <input type="text" class="form-control" id="edit_in_1r" name="in_1r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_2r">Injection Nozzle 2R:</label>
                        <input type="text" class="form-control" id="edit_in_2r" name="in_2r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_3r">Injection Nozzle 3R:</label>
                        <input type="text" class="form-control" id="edit_in_3r" name="in_3r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_in_4r">Injection Nozzle 4R:</label>
                        <input type="text" class="form-control" id="edit_in_4r" name="in_4r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_intercooler_r">Intercooler R:</label>
                        <input type="text" class="form-control" id="edit_intercooler_r" name="intercooler_r" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_intercooler_l">Intercooler L:</label>
                        <input type="text" class="form-control" id="edit_intercooler_l" name="intercooler_l" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_oil_pump">Oil Pump:</label>
                        <input type="text" class="form-control" id="edit_oil_pump" name="oil_pump" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_water_pump">Water Pump:</label>
                        <input type="text" class="form-control" id="edit_water_pump" name="water_pump" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_turbocharger">Turbocharger:</label>
                        <input type="text" class="form-control" id="edit_turbocharger" name="turbocharger" required>
                    </div>  
                    <div class="form-group">
                        <label for="edit_governor_md">Governor MD:</label>
                        <input type="text" class="form-control" id="edit_governor_md" name="governor_md" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_overspeed_md">Overspeed MD:</label>
                        <input type="text" class="form-control" id="edit_overspeed_md" name="overspeed_md" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_fan_radiator">Fan Radiator:</label>
                        <input type="text" class="form-control" id="edit_fan_radiator" name="fan_radiator" required>
                    </div>   
                    <div class="form-group">
                        <label for="edit_lube_oil">Lube Oil:</label>
                        <input type="text" class="form-control" id="edit_lube_oil" name="lube_oil" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_radiator">Radiator:</label>
                        <input type="text" class="form-control" id="edit_radiator" name="radiator" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_automaticbrake_1">Automatic Brake 1:</label>
                        <input type="text" class="form-control" id="edit_automaticbrake_1" name="automaticbrake_1" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_automaticbrake_2">Automatic Brake 2:</label>
                        <input type="text" class="form-control" id="edit_automaticbrake_2" name="automaticbrake_2" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_independentbrake_1">Independent Brake 1:</label>
                        <input type="text" class="form-control" id="edit_independentbrake_1" name="independentbrake_1" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_independentbrake_2">Independent Brake 2:</label>
                        <input type="text" class="form-control" id="edit_independentbrake_2" name="independentbrake_1" required>
                    </div> 
                    <div class="form-group">
                        <label for="edit_blower_tm">Blower TM:</label>
                        <input type="text" class="form-control" id="edit_blower_tm" name="blower_tm" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_exhauster">Exhauster:</label>
                        <input type="text" class="form-control" id="edit_exhauster" name="exhauster" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_auxilary_gen">Auxilary Generator:</label>
                        <input type="text" class="form-control" id="edit_auxilary_gen" name="auxilary_gen" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_exciter_gen">Exciter Generator:</label>
                        <input type="text" class="form-control" id="edit_exciter_gen" name="exciter_gen" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_main_gen">Main Generator:</label>
                        <input type="text" class="form-control" id="edit_main_gen" name="main_gen" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tl_1">Traksi Motor 1:</label>
                        <input type="text" class="form-control" id="edit_tl_1" name="tl_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tl_2">Traksi Motor 2:</label>
                        <input type="text" class="form-control" id="edit_tl_2" name="tl_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tl_3">Traksi Motor 3:</label>
                        <input type="text" class="form-control" id="edit_tl_3" name="tl_3" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tl_4">Traksi Motor 4:</label>
                        <input type="text" class="form-control" id="edit_tl_4" name="tl_4" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tl_5">Traksi Motor 5:</label>
                        <input type="text" class="form-control" id="edit_tl_5" name="tl_5" required>
                    </div>
                    <div class="form-group">
                        <label for="tl_6">Traksi Motor 6:</label>
                        <input type="text" class="form-control" id="edit_tl_6" name="tl_6" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_battery">Battery:</label>
                        <input type="text" class="form-control" id="edit_battery" name="battery" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_full_pump">Full Pump:</label>
                        <input type="text" class="form-control" id="edit_full_pump" name="full_pump" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_dyn_brake">Dyn. Brake Blower:</label>
                        <input type="text" class="form-control" id="edit_dyn_brake" name="dyn_brake" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_volt_regulator">Voltage Regulator:</label>
                        <input type="text" class="form-control" id="edit_volt_regulator" name="volt_regulator" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_br_1">Blower Rectifier 1:</label>
                        <input type="text" class="form-control" id="edit_br_1" name="br_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_br_2">Blower Rectifier 2:</label>
                        <input type="text" class="form-control" id="edit_br_2" name="br_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_be_1">Blower Exhauster 1:</label>
                        <input type="text" class="form-control" id="edit_be_1" name="be_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_be_2">Blower Exhauster 2:</label>
                        <input type="text" class="form-control" id="edit_be_2" name="be_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sdis_1">SDIS 1:</label>
                        <input type="text" class="form-control" id="edit_sdis_1" name="sdis_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sdis_2">SDIS 2:</label>
                        <input type="text" class="form-control" id="edit_sdis_2" name="sdis_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bs_1">Boogie Sets 1:</label>
                        <input type="text" class="form-control" id="edit_bs_1" name="bs_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bs_2">Boogie Sets 2:</label>
                        <input type="text" class="form-control" id="edit_bs_2" name="bs_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_1">Wheel Sets 1:</label>
                        <input type="text" class="form-control" id="edit_ws_1" name="ws_1" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_2">Wheel Sets 2:</label>
                        <input type="text" class="form-control" id="edit_ws_2" name="ws_2" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_3">Wheel Sets 3:</label>
                        <input type="text" class="form-control" id="edit_ws_3" name="ws_3" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_4">Wheel Sets 4:</label>
                        <input type="text" class="form-control" id="edit_ws_4" name="ws_4" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_5">Wheel Sets 5:</label>
                        <input type="text" class="form-control" id="edit_ws_5" name="ws_5" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_ws_6">Wheel Sets 6:</label>
                        <input type="text" class="form-control" id="edit_ws_6" name="ws_6" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_km">Kilometer Tempuh:</label>
                        <input type="text" class="form-control" id="edit_km" name="km" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sap">Tanggal Data SAP:</label>
                        <input type="date" class="form-control" id="edit_sap" name="sap" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_dt">Tanggal Database:</label>
                        <input type="date" class="form-control" id="edit_dt" name="dt" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_input_roda">Tanggal Input Data Roda:</label>
                        <input type="date" class="form-control" id="edit_input_roda" name="input_roda" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_pic">PIC:</label>
                        <input type="text" class="form-control" id="edit_pic" name="pic" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_buku_prwtn">Buku Perawatan:</label>
                        <input type="date" class="form-control" id="edit_buku_prwtn" name="buku_prwtn" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_sertikasi_dirjen">Tanggal Kirim Sertikasi  Dirjen:</label>
                        <input type="date" class="form-control" id="edit_sertikasi_dirjen" name="sertikasi_dirjen" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_softcopy">Tanggal Kirim Softcopy Buku Riwayat Ke Depo:</label>
                        <input type="date" class="form-control" id="edit_softcopy" name="softcopy" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_checksheet">Checksheet:</label>
                        <input type="text" class="form-control" id="edit_checksheet" name="checksheet" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_f7">F7 Pdf:</label>
                        <input type="date" class="form-control" id="edit_f7" name="f7" required>
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
<!-- JavaScript untuk modal -->
<script>
$(document).ready(function(){
    $('#customerDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang men-trigger modal
        
        var id = button.data('id');
        var lokomotif = button.data('lokomotif');
        var depo = button.data('depo');
        var sifat = button.data('sifat');
        var work_order = button.data('work_order');
        var engine = button.data('engine');
        var cj_1l = button.data('cj_1l');
        var cj_2l = button.data('cj_2l');
        var cj_3l = button.data('cj_3l');
        var cj_4l = button.data('cj_4l');
        var cj_1r = button.data('cj_1r');
        var cj_2r = button.data('cj_2r');
        var cj_3r = button.data('cj_3r');
        var cj_4r = button.data('cj_4r');
        var cl_1l = button.data('cl_1l');
        var cl_2l = button.data('cl_2l');
        var cl_3l = button.data('cl_3l');
        var cl_4l = button.data('cl_4l');
        var cl_1r = button.data('cl_1r');
        var cl_2r = button.data('cl_2r');
        var cl_3r = button.data('cl_3r');
        var cl_4r = button.data('cl_4r');
        var ip_1l = button.data('ip_1l');
        var ip_2l = button.data('ip_2l');
        var ip_3l = button.data('ip_3l');
        var ip_4l = button.data('ip_4l');
        var ip_1r = button.data('ip_1r');
        var ip_2r = button.data('ip_2r');
        var ip_3r = button.data('ip_3r');
        var ip_4r = button.data('ip_4r');
        var in_1l = button.data('in_1l');
        var in_2l = button.data('in_2l');
        var in_3l = button.data('in_3l');
        var in_4l = button.data('in_4l');
        var in_1r = button.data('in_1r');
        var in_2r = button.data('in_2r');
        var in_3r = button.data('in_3r');
        var in_4r = button.data('in_4r');
        var intercooler_r = button.data('intercooler_r');
        var intercooler_l = button.data('intercooler_l');
        var oil_pump = button.data('oil_pump');
        var water_pump = button.data('water_pump');
        var turbocharger = button.data('turbocharger');
        var governor_md = button.data('governor_md');
        var overspeed_md = button.data('overspeed_md');
        var air_compressor = button.data('air_compressor');
        var fan_radiator = button.data('fan_radiator');
        var lube_oil = button.data('lube_oil');
        var radiator = button.data('radiator');
        var automaticbrake_1 = button.data('automaticbrake_1');
        var automaticbrake_2 = button.data('automaticbrake_2');
        var independentbrake_1 = button.data('independentbrake_1');
        var independentbrake_2 = button.data('independentbrake_2');
        var blower_tm = button.data('blower_tm');
        var exhauster = button.data('exhauster');
        var auxilary_gen = button.data('auxilary_gen');
        var exciter_gen = button.data('exciter_gen');
        var main_gen = button.data('main_gen');
        var tl_1 = button.data('tl_1');
        var tl_2 = button.data('tl_2');
        var tl_3 = button.data('tl_3');
        var tl_4 = button.data('tl_4');
        var tl_5 = button.data('tl_5');
        var tl_6 = button.data('tl_6');
        var battery = button.data('battery');
        var full_pump = button.data('full_pump');
        var dyn_brake = button.data('dyn_brake');
        var volt_regulator = button.data('volt_regulator');
        var br_1 = button.data('br_1');
        var br_2 = button.data('br_2');
        var be_1 = button.data('be_1');
        var be_2 = button.data('be_2');
        var sdis_1 = button.data('sdis_1');
        var sdis_2 = button.data('sdis_2');
        var bs_1 = button.data('bs_1');
        var bs_2 = button.data('bs_2');
        var ws_1 = button.data('ws_1');
        var ws_2 = button.data('ws_2');
        var ws_3 = button.data('ws_3');
        var ws_4 = button.data('ws_4');
        var ws_5 = button.data('ws_5');
        var ws_6 = button.data('ws_6');
        var km = button.data('km');
        var sap = button.data('sap');
        var dt = button.data('dt');
        var input_roda = button.data('input_roda');
        var pic = button.data('pic');
        var buku_prwtn = button.data('buku_prwtn');
        var sertikasi_dirjen = button.data('sertikasi_dirjen');
        var softcopy = button.data('softcopy');
        var checksheet = button.data('checksheet');
        var f7 = button.data('f7');
        var tgl_msk = button.data('tgl_msk');
        var tgl_klr = button.data('tgl_klr');

        // Masukkan data ke modal
        var modal = $(this);

        modal
            .find('#id')
            .text(id || 'Tidak Ada Data');
        modal.find('#lokomotif').text(lokomotif || 'Tidak Ada Data');
        modal.find('#depo').text(depo || 'Tidak Ada Data');
        modal.find('#sifat').text(sifat || 'Tidak Ada Data');
        modal.find('#work_order').text(work_order || 'Tidak Ada Data');
        modal.find('#engine').text(engine || 'Tidak Ada Data');
        modal.find('#cj_1l').text(cj_1l || 'Tidak Ada Data');
        modal.find('#cj_2l').text(cj_2l || 'Tidak Ada Data');
        modal.find('#cj_3l').text(cj_3l || 'Tidak Ada Data');
        modal.find('#cj_4l').text(cj_4l || 'Tidak Ada Data');
        modal.find('#cj_1r').text(cj_1r || 'Tidak Ada Data');
        modal.find('#cj_2r').text(cj_2r || 'Tidak Ada Data');
        modal.find('#cj_3r').text(cj_3r || 'Tidak Ada Data');
        modal.find('#cj_4r').text(cj_4r|| 'Tidak Ada Data');
        modal.find('#cl_1l').text(cl_1l || 'Tidak Ada Data');
        modal.find('#cl_2l').text(cl_2l || 'Tidak Ada Data');
        modal.find('#cl_3l').text(cl_3l || 'Tidak Ada Data');
        modal.find('#cl_4l').text(cl_4l || 'Tidak Ada Data');
        modal.find('#cl_1r').text(cl_1r || 'Tidak Ada Data');
        modal.find('#cl_2r').text(cl_2r || 'Tidak Ada Data');
        modal.find('#cl_3r').text(cl_3r || 'Tidak Ada Data');
        modal.find('#cl_4r').text(cl_4r|| 'Tidak Ada Data');
        modal.find('#ip_1l').text(ip_1l || 'Tidak Ada Data');
        modal.find('#ip_2l').text(ip_2l || 'Tidak Ada Data');
        modal.find('#ip_3l').text(ip_3l || 'Tidak Ada Data');
        modal.find('#ip_4l').text(ip_4l || 'Tidak Ada Data');
        modal.find('#ip_1r').text(ip_1r || 'Tidak Ada Data');
        modal.find('#ip_2r').text(ip_2r || 'Tidak Ada Data');
        modal.find('#ip_3r').text(ip_3r || 'Tidak Ada Data');
        modal.find('#ip_4r').text(ip_4r || 'Tidak Ada Data');
        modal.find('#in_1l').text(in_1l || 'Tidak Ada Data');
        modal.find('#in_2l').text(in_2l || 'Tidak Ada Data');
        modal.find('#in_3l').text(in_3l || 'Tidak Ada Data');
        modal.find('#in_4l').text(in_4l || 'Tidak Ada Data');
        modal.find('#in_1r').text(in_1r || 'Tidak Ada Data');
        modal.find('#in_2r').text(in_2r || 'Tidak Ada Data');
        modal.find('#in_3r').text(in_3r || 'Tidak Ada Data');
        modal.find('#in_4r').text(in_4r || 'Tidak Ada Data');
        modal.find('#intercooler_r').text(intercooler_r || 'Tidak Ada Data');
        modal.find('#intercooler_l').text(intercooler_l || 'Tidak Ada Data');
        modal.find('#oil_pump').text(oil_pump || 'Tidak Ada Data');
        modal.find('#water_pump').text(water_pump || 'Tidak Ada Data');
        modal.find('#turbocharger').text(turbocharger || 'Tidak Ada Data');
        modal.find('#governor_md').text(governor_md || 'Tidak Ada Data');
        modal.find('#overspeed_md').text(overspeed_md || 'Tidak Ada Data');
        modal.find('#air_compressor').text(air_compressor || 'Tidak Ada Data');
        modal.find('#fan_radiator').text(fan_radiator || 'Tidak Ada Data');
        modal.find('#lube_oil').text(lube_oil || 'Tidak Ada Data');
        modal.find('#radiator').text(radiator || 'Tidak Ada Data');
        modal.find('#automaticbrake_1').text(automaticbrake_1 || 'Tidak Ada Data');
        modal.find('#automaticbrake_2').text(automaticbrake_2 || 'Tidak Ada Data');
        modal.find('#independentbrake_1').text(independentbrake_1 || 'Tidak Ada Data');
        modal.find('#independentbrake_2').text(independentbrake_2 || 'Tidak Ada Data');
        modal.find('#blower_tm').text(blower_tm || 'Tidak Ada Data');
        modal.find('#exhauster').text(exhauster || 'Tidak Ada Data');
        modal.find('#auxilary_gen').text(auxilary_gen || 'Tidak Ada Data');
        modal.find('#exciter_gen').text(exciter_gen || 'Tidak Ada Data');
        modal.find('#main_gen').text(main_gen || 'Tidak Ada Data');
        modal.find('#tl_1').text(tl_1 || 'Tidak Ada Data');
        modal.find('#tl_2').text(tl_2 || 'Tidak Ada Data');
        modal.find('#tl_3').text(tl_3 || 'Tidak Ada Data');
        modal.find('#tl_4').text(tl_4 || 'Tidak Ada Data');
        modal.find('#tl_5').text(tl_5 || 'Tidak Ada Data');
        modal.find('#tl_6').text(tl_6 || 'Tidak Ada Data');
        modal.find('#battery').text(battery || 'Tidak Ada Data');
        modal.find('#full_pump').text(full_pump || 'Tidak Ada Data');
        modal.find('#dyn_brake').text(dyn_brake || 'Tidak Ada Data');
        modal.find('#volt_regulator').text(volt_regulator || 'Tidak Ada Data');
        modal.find('#br_1').text(br_1 || 'Tidak Ada Data');
        modal.find('#br_2').text(br_2 || 'Tidak Ada Data');
        modal.find('#be_1').text(be_1 || 'Tidak Ada Data');
        modal.find('#be_2').text(be_2 || 'Tidak Ada Data');
        modal.find('#sdis_1').text(sdis_1 || 'Tidak Ada Data');
        modal.find('#sdis_2').text(sdis_2 || 'Tidak Ada Data');
        modal.find('#bs_1').text(bs_1 || 'Tidak Ada Data');
        modal.find('#bs_2').text(bs_2 || 'Tidak Ada Data');
        modal.find('#ws_1').text(ws_1 || 'Tidak Ada Data');
        modal.find('#ws_2').text(ws_2 || 'Tidak Ada Data');
        modal.find('#ws_3').text(ws_3 || 'Tidak Ada Data');
        modal.find('#ws_4').text(ws_4 || 'Tidak Ada Data');
        modal.find('#ws_5').text(ws_5 || 'Tidak Ada Data');
        modal.find('#ws_6').text(ws_6 || 'Tidak Ada Data');
        modal.find('#km').text(km || 'Tidak Ada Data');
        modal.find('#sap').text(sap || 'Tidak Ada Data');
        modal.find('#dt').text(dt || 'Tidak Ada Data');
        modal.find('#input_roda').text(input_roda || 'Tidak Ada Data');
        modal.find('#pic').text(pic || 'Tidak Ada Data');
        modal.find('#buku_prwtn').text(buku_prwtn || 'Tidak Ada Data');
        modal.find('#sertikasi_dirjen').text(sertikasi_dirjen || 'Tidak Ada Data');
        modal.find('#softcopy').text(softcopy || 'Tidak Ada Data');
        modal.find('#checksheet').text(checksheet || 'Tidak Ada Data');
        modal.find('#f7').text(f7 || 'Tidak Ada Data');
        modal.find('#tgl_msk').text(tgl_msk || 'Tidak Ada Data');
        modal.find('#tgl_klr').text(tgl_klr || 'Tidak Ada Data');


  // Ketika tombol Edit di modal Detail diklik
  $('#editButtonFromDetails').on('click', function() {
        var modal = $('#customerDetailsModal');
        
        // Ambil data dari modal Detail
        var id = modal.find('#id').text();
        var lokomotif = modal.find('#lokomotif').text();
        var depo = modal.find('#depo').text();
        var sifat = modal.find('#sifat').text();
        var work_order = modal.find('#work_order').text();
        var engine = modal.find('#engine').text();
        var cj_1l = modal.find('#cj_1l').text();
        var cj_2l = modal.find('#cj_2l').text();
        var cj_3l = modal.find('#cj_3l').text();
        var cj_4l = modal.find('#cj_4l').text();
        var cj_1r = modal.find('#cj_1r').text();
        var cj_2r = modal.find('#cj_2r').text();
        var cj_3r = modal.find('#cj_3r').text();
        var cj_4r = modal.find('#cj_4r').text();
        var cl_1l = modal.find('#cl_1l').text();
        var cl_2l = modal.find('#cl_2l').text();
        var cl_3l = modal.find('#cl_3l').text();
        var cl_4l = modal.find('#cl_4l').text();
        var cl_1r = modal.find('#cl_1r').text();
        var cl_2r = modal.find('#cl_2r').text();
        var cl_3r = modal.find('#cl_3r').text();
        var cl_4r = modal.find('#cl_4r').text();
        var ip_1l = modal.find('#ip_1l').text();
        var ip_2l = modal.find('#ip_2l').text();
        var ip_3l = modal.find('#ip_3l').text();
        var ip_4l = modal.find('#ip_4l').text();
        var ip_1r = modal.find('#ip_1r').text();
        var ip_2r = modal.find('#ip_2r').text();
        var ip_3r = modal.find('#ip_3r').text();
        var ip_4r = modal.find('#ip_4r').text();
        var in_1l = modal.find('#in_1l').text();
        var in_2l = modal.find('#in_2l').text();
        var in_3l = modal.find('#in_3l').text();
        var in_4l = modal.find('#in_4l').text();
        var in_1r = modal.find('#in_1r').text();
        var in_2r = modal.find('#in_2r').text();
        var in_3r = modal.find('#in_3r').text();
        var in_4r = modal.find('#in_4r').text();
        var intetrcooler_r = modal.find('#intercooler_r').text();
        var intercooler_l = modal.find('#intercooler_l').text();
        var oil_pump = modal.find('#oil_pump').text();
        var water_pump = modal.find('#water_pump').text();
        var turbocharger = modal.find('#turbocharger').text();
        var governor_md = modal.find('#governor_md').text();
        var overspeed_md = modal.find('#overspeed_md').text();
        var air_compressor = modal.find('#air_compressor').text();
        var fan_radiator = modal.find('#fan_radiator').text();
        var lube_oil = modal.find('#lube_oil').text();
        var radiator = modal.find('#radiator').text();
        var automaticbrake_1 = modal.find('#automaticbrake_1').text();
        var automaticbrake_2 = modal.find('#automaticbrake_2').text();
        var independentbrake_1 = modal.find('#independentbrake_1').text();
        var independentbrake_2 = modal.find('#independentbrake_2').text();
        var blower_tm = modal.find('#blower_tm').text();
        var exhauster = modal.find('#exhauster').text();
        var auxilary_gen = modal.find('#auxilary_gen').text();
        var exciter_gen = modal.find('#exciter_gen').text();
        var main_gen = modal.find('#main_gen').text();
        var tl_1 = modal.find('#tl_1').text();
        var tl_2 = modal.find('#tl_2').text();
        var tl_3 = modal.find('#tl_3').text();
        var tl_4 = modal.find('#tl_4').text();
        var tl_5 = modal.find('#tl_5').text();
        var tl_6 = modal.find('#tl_6').text();
        var battery = modal.find('#battery').text();
        var full_pump = modal.find('#full_pump').text();
        var volt_regulator = modal.find('#volt_regulator').text();
        var br_1 = modal.find('#br_1').text();
        var br_2 = modal.find('#br_2').text();
        var be_1 = modal.find('#be_1').text();
        var be_2 = modal.find('#be_2').text();
        var sdis_1 = modal.find('#sdis_1').text();
        var sdis_2 = modal.find('#sdis_2').text();
        var bs_1 = modal.find('#bs_1').text();
        var bs_2 = modal.find('#bs_2').text();
        var ws_1 = modal.find('#ws_1').text();
        var ws_2 = modal.find('#ws_2').text();
        var ws_3 = modal.find('#ws_3').text();
        var ws_4 = modal.find('#ws_4').text();
        var ws_5 = modal.find('#ws_5').text();
        var ws_6 = modal.find('#ws_6').text();
        var km = modal.find('#km').text();
        var sap = modal.find('#sap').text();
        var dt = modal.find('#dt').text();
        var input_roda = modal.find('#input_roda').text();
        var pic = modal.find('#pic').text();
        var buku_prwtn = modal.find('#buku_prwtn').text();
        var sertikasi_dirjen = modal.find('#sertikasi_dirjen').text();
        var softcopy = modal.find('#softcopy').text();
        var checksheet = modal.find('#checksheet').text();
        var f7 = modal.find('#f7').text();
        var tgl_msk = modal.find('#tgl_msk').text();
        var tgl_klr = modal.find('#tgl_klr').text();

        // Isi modal Edit dengan data yang sudah ada
        $('#editModal').find('#edit_id').val(id);
        $('#editModal').find('#edit_lokomotif').val(lokomotif);
        $('#editModal').find('#edit_depo').val(depo);
        $('#editModal').find('#edit_sifat').val(sifat);
        $('#editModal').find('#edit_work_order').val(work_order);
        $('#editModal').find('#edit_engine').val(engine);
        $('#editModal').find('#edit_cj_1l').val(cj_1l);
        $('#editModal').find('#edit_cj_2l').val(cj_2l);
        $('#editModal').find('#edit_cj_3l').val(cj_3l);
        $('#editModal').find('#edit_cj_4l').val(cj_4l);
        $('#editModal').find('#edit_cj_1r').val(cj_1r);
        $('#editModal').find('#edit_cj_2r').val(cj_2r);
        $('#editModal').find('#edit_cj_3r').val(cj_3r);
        $('#editModal').find('#edit_cj_4r').val(cj_4r);
        $('#editModal').find('#edit_cl_1l').val(cl_1l);
        $('#editModal').find('#edit_cl_2l').val(cl_2l);
        $('#editModal').find('#edit_cl_3l').val(cl_3l);
        $('#editModal').find('#edit_cl_4l').val(cl_4l);
        $('#editModal').find('#edit_cl_1r').val(cl_1r);
        $('#editModal').find('#edit_cl_2r').val(cl_2r);
        $('#editModal').find('#edit_cl_3r').val(cl_3r);
        $('#editModal').find('#edit_cl_4r').val(cl_4r);
        $('#editModal').find('#edit_ip_1l').val(ip_1l);
        $('#editModal').find('#edit_ip_2l').val(ip_2l);
        $('#editModal').find('#edit_ip_3l').val(ip_3l);
        $('#editModal').find('#edit_ip_4l').val(ip_4l);
        $('#editModal').find('#edit_ip_1r').val(ip_1r);
        $('#editModal').find('#edit_ip_2r').val(ip_2r);
        $('#editModal').find('#edit_ip_3r').val(ip_3r);
        $('#editModal').find('#edit_ip_4r').val(ip_4r);
        $('#editModal').find('#edit_in_1l').val(in_1l);
        $('#editModal').find('#edit_in_2l').val(in_2l);
        $('#editModal').find('#edit_in_3l').val(in_3l);
        $('#editModal').find('#edit_in_4l').val(in_4l);
        $('#editModal').find('#edit_in_1r').val(in_1r);
        $('#editModal').find('#edit_in_2r').val(in_2r);
        $('#editModal').find('#edit_in_3r').val(in_3r);
        $('#editModal').find('#edit_in_4r').val(in_4r);
        $('#editModal').find('#edit_intercooler_r').val(intercooler_r);
        $('#editModal').find('#edit_intercooler_l').val(intercooler_l);
        $('#editModal').find('#edit_oil_pump').val(oil_pump);
        $('#editModal').find('#edit_water_pump').val(water_pump);
        $('#editModal').find('#edit_turbocharger').val(turbocharger);
        $('#editModal').find('#edit_governor_md').val(governor_md);
        $('#editModal').find('#edit_overspeed_md').val(overspeed_md);
        $('#editModal').find('#edit_air_compressor').val(air_compressor);
        $('#editModal').find('#edit_fan_radiator').val(fan_radiator);
        $('#editModal').find('#edit_lube_oil').val(lube_oil);
        $('#editModal').find('#edit_radiator').val(radiator);
        $('#editModal').find('#edit_automaticbrake_1').val(automaticbrake_1);
        $('#editModal').find('#edit_automaticbrake_2').val(automaticbrake_2);
        $('#editModal').find('#edit_automaticbrake_1').val(automaticbrake_1);
        $('#editModal').find('#edit_independentbrake_1').val(independentbrake_1);
        $('#editModal').find('#edit_independentbrake_2').val(independentbrake_2);
        $('#editModal').find('#edit_blower_tm').val(blower_tm);
        $('#editModal').find('#edit_exhauster').val(exhauster);
        $('#editModal').find('#edit_auxilary_gen').val(auxilary_gen);
        $('#editModal').find('#edit_exciter_gen').val(exciter_gen);
        $('#editModal').find('#edit_main_gen').val(main_gen);
        $('#editModal').find('#edit_tl_1').val(tl_1);
        $('#editModal').find('#edit_tl_2').val(tl_2);
        $('#editModal').find('#edit_tl_3').val(tl_3);
        $('#editModal').find('#edit_tl_4').val(tl_4);
        $('#editModal').find('#edit_tl_5').val(tl_5);
        $('#editModal').find('#edit_tl_6').val(tl_6);
        $('#editModal').find('#edit_battery').val(battery);
        $('#editModal').find('#edit_full_pump').val(full_pump);
        $('#editModal').find('#edit_dyn_brake').val(dyn_brake);
        $('#editModal').find('#edit_volt_regulator').val(volt_regulator);
        $('#editModal').find('#edit_br_1').val(br_1);
        $('#editModal').find('#edit_br_2').val(br_2);
        $('#editModal').find('#edit_be_1').val(be_1);
        $('#editModal').find('#edit_be_2').val(be_2);
        $('#editModal').find('#edit_sdis_1').val(sdis_1);
        $('#editModal').find('#edit_sdis_2').val(sdis_2);
        $('#editModal').find('#edit_bs_1').val(bs_1);
        $('#editModal').find('#edit_bs_2').val(bs_2);
        $('#editModal').find('#edit_ws_1').val(ws_1);
        $('#editModal').find('#edit_ws_2').val(ws_2);
        $('#editModal').find('#edit_ws_3').val(ws_3);
        $('#editModal').find('#edit_ws_4').val(ws_4);
        $('#editModal').find('#edit_ws_5').val(ws_5);
        $('#editModal').find('#edit_ws_6').val(ws_6);
        $('#editModal').find('#edit_km').val(km);
        $('#editModal').find('#edit_sap').val(sap);
        $('#editModal').find('#edit_dt').val(dt);
        $('#editModal').find('#edit_input_roda').val(input_roda);
        $('#editModal').find('#edit_pic').val(pic);
        $('#editModal').find('#edit_buku_prwtn').val(buku_prwtn);
        $('#editModal').find('#edit_sertikasi_dirjen').val(sertikasi_dirjen);
        $('#editModal').find('#edit_softcopy').val(softcopy);
        $('#editModal').find('#edit_checksheet').val(checksheet);
        $('#editModal').find('#edit_f7').val(f7);
        $('#editModal').find('#edit_tgl_msk').val(tgl_msk);
        $('#editModal').find('#edit_tgl_klr').val(tgl_klr);
    });
    });
})

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