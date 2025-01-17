<?php
include 'config.php'; // Koneksi ke database

// Cek jika form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $lokomotif = $_POST['no_sarana'];
    $sifat = $_POST['id_sifat'];
    $work_order = isset($_POST['work_order']) ? $_POST['work_order'] : ''; 
    $no_engine = isset($_POST['no_engine']) ? $_POST['no_engine'] : '';

    // Query untuk menambahkan data ke dalam database, gunakan ON DUPLICATE KEY UPDATE
    // Query tanpa ON DUPLICATE KEY UPDATE
$query = "INSERT INTO engine (no_sarana, id_sifat, work_order, no_engine)
VALUES ('$no_sarana', '$id_sifat', '$work_order', '$no_engine')";


    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($koneksi, $query)) {
        header('Location: engine.php?success=1'); // Redirect jika sukses
        exit();
    } else {
        header('Location: 404.php?error=1'); // Redirect jika gagal
        exit();
    }
}
