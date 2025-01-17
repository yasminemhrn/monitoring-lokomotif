<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Mengambil data dari form edit
        $id = $_POST['id_md'];
        $lokomotif = $_POST['no_sarana'];
        $depo = $_POST['depo'];
        $asistensi = $_POST['asistensi'];
        $komponen = $_POST['komponen'];
        $no_seri = $_POST['no_seri'];
        $ket = $_POST['ket'];
        $tgl_pasang = $_POST['tgl_pasang'];

        // Memulai transaksi
        mysqli_begin_transaction($koneksi);
        try {
            // Query update data
            $query1 = "UPDATE mon_depo SET
                no_sarana = '$lokomotif',
                depo = '$depo',
                asistensi = '$asistensi',
                komponen = '$komponen',
                no_seri = '$no_seri',
                ket = '$ket',
                tgl_pasang = '$tgl_pasang'
                WHERE id_mondp = '$id'";

            // Menjalankan query dan cek error
            if (!mysqli_query($koneksi, $query1)) {
                throw new Exception("Update failed: " . mysqli_error($koneksi));
            }

            // Commit transaksi jika tidak ada error
            mysqli_commit($koneksi);

            // Redirect dengan status success
            header("Location: mon_depo.php?success=1");
            exit();
        } catch (Exception $e) {
            // Rollback jika ada error
            mysqli_rollback($koneksi);
            echo "Update gagal: " . $e->getMessage();
        }
    } else {
        echo "ID tidak ditemukan.";
    }
}
