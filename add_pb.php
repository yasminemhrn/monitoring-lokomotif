<?php
include 'config.php'; // Koneksi ke database

// Cek jika form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form, jika tidak ada isian maka beri nilai NULL
    $no_sarana = !empty($_POST['no_sarana']) ? $_POST['no_sarana'] : NULL;
    $depo = !empty($_POST['depo']) ? $_POST['depo'] : NULL;
    $sifat_pb = !empty($_POST['sifat_pb']) ? $_POST['sifat_pb'] : NULL;
    $work_order = !empty($_POST['work_order']) ? $_POST['work_order'] : NULL;
    $tgl_masuk = !empty($_POST['tgl_masuk']) ? $_POST['tgl_masuk'] : NULL;
    $tgl_keluar = !empty($_POST['tgl_keluar']) ? $_POST['tgl_keluar'] : NULL;
    $ganti_komp = !empty($_POST['ganti_komp']) ? $_POST['ganti_komp'] : NULL;
    $komponen_revisi = !empty($_POST['komponen_revisi']) ? $_POST['komponen_revisi'] : NULL;
    $komponen_pengganti = !empty($_POST['komponen_pengganti']) ? $_POST['komponen_pengganti'] : NULL;
    $asal_lok = !empty($_POST['asal_lok']) ? $_POST['asal_lok'] : NULL;
    $rwyt_buku = !empty($_POST['rwyt_buku']) ? $_POST['rwyt_buku'] : NULL;
    $sap = !empty($_POST['sap']) ? $_POST['sap'] : NULL;
    $softcopy_depo = !empty($_POST['softcopy_depo']) ? $_POST['softcopy_depo'] : NULL;
    $f7_pdf = !empty($_POST['f7_pdf']) ? $_POST['f7_pdf'] : NULL;
    $KM_masuk = !empty($_POST['KM_masuk']) ? $_POST['KM_masuk'] : NULL;
    $kelengkapan = !empty($_POST['kelengkapan']) ? $_POST['kelengkapan'] : NULL;

    // Query untuk menambahkan data ke dalam database menggunakan prepared statement
    $query = "INSERT INTO mon_pb (no_sarana, depo, sifat_pb, work_order, tgl_masuk, tgl_keluar, ganti_komp, komponen_revisi,
              komponen_pengganti, asal_lok, rwyt_buku, sap, softcopy_depo, f7_pdf, KM_masuk, kelengkapan)  
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Inisialisasi prepared statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $no_sarana, $depo, $sifat_pb, $work_order, $tgl_masuk, $tgl_keluar, $ganti_komp, $komponen_revisi, $komponen_pengganti, 
        $asal_lok, $rwyt_buku, $sap, $softcopy_depo, $f7_pdf, $KM_masuk, $kelengkapan);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: mon_pb.php?success=1'); // Redirect jika sukses
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
    header('Location: mon_pb.php'); // Redirect jika form tidak diakses dengan POST
    exit();
}
