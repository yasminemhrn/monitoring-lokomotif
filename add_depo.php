<?php
include 'config.php'; // Koneksi ke database

// Cek jika form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $no_sarana = $_POST['no_sarana'];
    $depo = $_POST['depo'];
    $asistensi = $_POST['asistensi'];
    $komponen = isset($_POST['komponen']) ? $_POST['komponen'] : ''; 
    $no_seri = isset($_POST['no_seri']) ? $_POST['no_seri'] : '';
    $ket = isset($_POST['ket']) ? $_POST['ket'] : '';
    $tgl_pasang = isset($_POST['tgl_pasang']) ? $_POST['tgl_pasang'] : '';

    // Query untuk menambahkan data ke dalam database menggunakan prepared statement
    $query = "INSERT INTO mon_depo (no_sarana, depo, asistensi, komponen, no_seri, ket, tgl_pasang) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Inisialisasi prepared statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "sssssss", $no_sarana, $depo, $asistensi, $komponen, $no_seri, $ket, $tgl_pasang);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: mon_depo.php?success=1'); // Redirect jika sukses
            exit();
        } else {
            // Tambahkan pesan kesalahan saat terjadi masalah
            echo "Error: " . mysqli_error($koneksi); // Hanya untuk debugging
            // header('Location: 404.php?error=1'); // Uncomment ini jika tidak perlu debugging
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare statement"; // Debug jika terjadi masalah dengan prepared statement
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
} else {
    header('Location: mon_depo.php'); // Redirect jika form tidak diakses dengan POST
    exit();
}
