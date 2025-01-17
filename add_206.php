<?php
include 'config.php'; // Koneksi ke database

// Cek jika form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $lokomotif = $_POST['lokomotif'];
    $depo = $_POST['depo'];
    $sifat = $_POST['sifat'];
    $tambah_baterai = isset($_POST['tambah_baterai']) ? $_POST['tambah_baterai'] : ''; 
    $ganti_bearing = isset($_POST['ganti_bearing']) ? $_POST['ganti_bearing'] : '';
    $kompressor_mo2 = isset($_POST['kompressor_mo2']) ? $_POST['kompressor_mo2'] : '';
    $pindah_posisi = isset($_POST['pindah_posisi']) ? $_POST['pindah_posisi'] : '';
    $pasang_ac = isset($_POST['pasang_ac']) ? $_POST['pasang_ac'] : '';
    $tgl_selesai = isset($_POST['tgl_selesai']) ? $_POST['tgl_selesai'] : '';

    // Query untuk menambahkan data ke dalam database, gunakan ON DUPLICATE KEY UPDATE
    // Query tanpa ON DUPLICATE KEY UPDATE
$query = "INSERT INTO prwtan_cc206 (lokomotif, depo, sifat, tambah_baterai, ganti_bearing, kompressor_mo2, pindah_posisi, pasang_ac, tgl_selesai) 
VALUES ('$lokomotif', '$depo', '$sifat', '$tambah_baterai', '$ganti_bearing', '$kompressor_mo2', '$pindah_posisi', '$pasang_ac', '$tgl_selesai')";


    // Eksekusi query dan cek apakah berhasil
    if (mysqli_query($koneksi, $query)) {
        header('Location: CC_206.php?success=1'); // Redirect jika sukses
        exit();
    } else {
        header('Location: 404.php?error=1'); // Redirect jika gagal
        exit();
    }
}
