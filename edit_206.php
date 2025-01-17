<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Mengambil data dari form edit
        $id = $_POST['id_206'];
        $lokomotif = $_POST['lokomotif'];
        $depo = $_POST['depo'];
        $sifat = $_POST['sifat'];
        $tambah_baterai = $_POST['tambah_baterai'];
        $ganti_bearing = $_POST['ganti_bearing'];
        $kompressor_mo2 = $_POST['kompressor_mo2'];
        $pindah_posisi = $_POST['pindah_posisi'];
        $pasang_ac = $_POST['pasang_ac'];
        $tgl_selesai = $_POST['tgl_selesai'];

        // Memulai transaksi
        mysqli_begin_transaction($koneksi);
        try {
            // Query update data
            $query1 = "UPDATE prwtan_cc206 SET
                id_206 = '$id',
                lokomotif = '$lokomotif',
                depo = '$depo',
                sifat = '$sifat',
                tambah_baterai = '$tambah_baterai',
                ganti_bearing = '$ganti_bearing',
                kompressor_mo2 = '$kompressor_mo2',
                pindah_posisi = '$pindah_posisi',
                pasang_ac = '$pasang_ac',
                tgl_selesai = '$tgl_selesai'
                WHERE id_206 = '$id'";

            // Menjalankan query dan cek error
            if (!mysqli_query($koneksi, $query1)) {
                throw new Exception("Update failed: " . mysqli_error($koneksi));
            }

            // Commit transaksi jika tidak ada error
            mysqli_commit($koneksi);

            // Redirect dengan status success
            header("Location: CC_206.php?success=1");
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
