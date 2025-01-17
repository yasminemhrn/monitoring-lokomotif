<?php

include "config.php";

$title = "Dashboard Monitoring";
include "template/header.php";
include "template/navbar.php";
include "template/sidebar.php";
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
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

                    $depo_query = "SELECT * FROM engine NATURAL JOIN sifat";
                    if ($searchQuery) {
                        $depo_query .= " WHERE lokomotif LIKE '%$searchQuery%' OR depo LIKE '%$searchQuery%' OR sifat LIKE '%$searchQuery%'";
                    }
                    $depo_result = mysqli_query($koneksi, $depo_query);
                    ?>
                    <table id="table1" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="engine">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokomotif</th>
                                <!-- <th>Depo</th> -->
                                <th>Sifat</th>
                                <!-- <th>Tanggal Selesai</th> -->
                                <th>Action</th> 
                                <!-- <th width="100px">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $depo_query = "SELECT engine.*, sifat.sifat AS sifat_description FROM engine 
                            LEFT JOIN sifat ON engine.id_sifat = sifat.id_sifat";            
                            $depo_result = mysqli_query($koneksi, $depo_query);
                            $no = 1;
                            while ($depo = mysqli_fetch_assoc($depo_result)) {  ?>
                                <tr>
                                    <td width='100' class='center'><?= $no ?></td>
                                    <td><?php echo $depo['no_sarana'] ?></td>
                                    <!-- <td><?php echo $depo['depo'] ?></td> -->
                                    <td><?php echo $depo['sifat_description'] ?></td>

                                    <!-- <td><?php echo $depo['tgl_selesai'] ?></td> -->
                                    <td>
                                        <!-- Tombol untuk membuka modal detail -->
                                        <button class="btn btn-warning" data-toggle="modal" 
                                            data-target="#cutomerDetailsModal"
                                            data-id="<?php echo $depo['id_engine']; ?>"
                                            data-lokomotif="<?php echo $depo['no_sarana']; ?>"
                                            data-sifat="<?php echo $depo['sifat_description']; ?>"
                                            data-work_order="<?php echo $depo['work_order']; ?>"
                                            data-no_engine="<?php echo $depo['no_engine']; ?>"
                                            style="border-radius:60px;">
                                            <i class="fa fa-info-circle"></i> View Details
                                        </button>
                                        <a href='functionmis.php?depo=<?php echo $depo['id_engine']; ?>'
                                            class="btn btn-danger mt-2" onclick="return confirm('Are you sure?')" style="border-radius:60px;">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
                            <td><b>LOKOMOTIF</b></td>
                            <td id="no_sarana"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><b>SIFAT</b></td>
                            <td id="id_sifat"></td>
                        </tr>
                        <tr>
                            <td><b>WORK ORDER</b></td>
                            <td id="work_order"></td>
                        </tr>
                        <tr>
                            <td><b>ENGINE</b></td>
                            <td id="no_engine"></td>
                        </tr>
                    </tbody>
                </table>
<!-- Kode untuk Tombol Export PDF di modal detail -->
<button type="button" class="btn btn-primary" onclick="exportToPDF()">Export to PDF</button>

<!-- <script>
function exportToPDF() {
    // Ambil ID dari detail modal
    var id = $('#id').text();
    
    // Arahkan ke export_pdf.php dengan ID yang sesuai
    window.location.href = "export_pdf.php?id=" + id;
}
</script> -->

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
                <form id="addEmployeeForm" method="POST" action="add_engine.php">
                    <div class="form-group">
                        <label for="no_sarana">Lokomotif:</label>
                        <input type="text" class="form-control" name="no_sarana" required>
                    </div>
                    <div class="form-group">
                        <label for="id_sifat">Sifat:</label>
                        <input type="text" class="form-control" name="id_sifat" required>
                    </div>
                    <div class="form-group">
                        <label for="work_order">Work Order:</label>
                        <input type="text" class="form-control" name="work_order" required>
                    </div>
                    <div class="form-group">
                        <label for="no_engine">Engine:</label>
                        <input type="text" class="form-control" name="no_engine" required>
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
                <form id="editForm" method="POST" action="edit_data.php">

                <input type="hidden" id="edit_id" name="id_engine" >
                <input type="hidden" id="edit_id_sifat" name="id_sifat">
                    <div class="form-group">
                        <label for="edit_no_sarana">Lokomotif:</label>
                        <input type="text" class="form-control" id="edit_no_sarana" name="no_sarana" required>
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
                        <label for="edit_no_engine">Engine:</label>
                        <input type="text" class="form-control" id="edit_no_engine" name="no_engine" required>
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
    new DataTable('#table1', {

});
</script>

<!-- JavaScript untuk modal -->
<script>
$(document).ready(function(){
    $('#cutomerDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang men-trigger modal
        
        // Ambil data dari tombol
        var id = button.data('id');
        var lokomotif = button.data('lokomotif');
        var sifat = button.data('sifat');
        var work_order = button.data('work_order');
        var no_engine = button.data('no_engine');


        // Masukkan data ke modal
        var modal = $(this);
        modal.find('#id').text(id || 'Tidak Ada Data');
        modal.find('#no_sarana').text(lokomotif || 'Tidak Ada Data');
        modal.find('#id_sifat').text(sifat || 'Tidak Ada Data');
        modal.find('#work_order').text(work_order || 'Tidak Ada Data');
        modal.find('#no_engine').text(no_engine || 'Tidak Ada Data');

       $(document).ready(function(){
    // Ketika tombol Edit di modal Detail diklik
    $('#editButtonFromDetails').on('click', function() {
        // Ambil data dari modal Detail
        var id = $('#id').text();
        var lokomotif = $('#no_sarana').text();
        var sifat = $('#sifat').text(); 
        var work_order = $('#work_order').text();
        var no_engine = $('#no_engine').text();

        // Isi modal Edit dengan data yang sudah ada
        $('#editModal').find('#edit_id').val(id);
        $('#editModal').find('#edit_no_sarana').val(lokomotif);
        $('#editModal').find('#edit_id_sifat').val(sifat);
        $('#editModal').find('#edit_work_order').val(work_order);
        $('#editModal').find('#edit_no_engine').val(no_engine);
       
    });
});

});
    });

</script>

<!-- Tambahkan juga jQuery dan Bootstrap JS di sini -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php include "template/footer.php"; ?>
    </body>
</html>
