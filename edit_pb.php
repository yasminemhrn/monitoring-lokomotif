<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Mengambil data dari form edit
        $id = $_POST['id_pb'];
        $no_sarana = $_POST['no_sarana'];
        $depo = $_POST['depo'];
        $sifat_pb = $_POST['sifat_pb'];
        $work_order = $_POST['work_order'];
        $tgl_masuk = $_POST['tgl_masuk'];
        $tgl_keluar = $_POST['tgl_keluar'];
        $ganti_komp = $_POST['ganti_komp'];
        $komponen_revisi = $_POST['komponen_revisi'];
        $komponen_pengganti = $_POST['komponen_pengganti'];
        $asal_lok = $_POST['asal_lok'];
        $rwyt_buku = $_POST['rwyt_buku'];
        $sap = $_POST['sap'];
        $softcopy_depo = $_POST['softcopy_depo'];
        $f7_pdf = $_POST['f7_pdf'];
        $KM_masuk = $_POST['KM_masuk'];
        $kelengkapan = $_POST['kelengkapan'];

        // Memulai transaksi
        mysqli_begin_transaction($koneksi);
        try {
            // Query update data
            $query1 = "UPDATE mon_pb SET
            no_sarana = '$no_sarana',
            depo = '$depo',
            sifat_pb = '$sifat_pb',
            work_order = '$work_order',
            tgl_masuk = '$tgl_masuk',
            tgl_keluar = '$tgl_keluar',
            ganti_komp = '$ganti_komp',
            komponen_revisi = '$komponen_revisi',
            komponen_pengganti = '$komponen_pengganti',
            asal_lok = '$asal_lok',
            rwyt_buku = '$rwyt_buku',
            sap = '$sap',
            softcopy_depo = '$softcopy_depo',
            f7_pdf = '$f7_pdf',
            KM_masuk = '$KM_masuk',
            kelengkapan = '$kelengkapan'
            WHERE id_pb = '$id'";
        

            // Menjalankan query dan cek error
            if (!mysqli_query($koneksi, $query1)) {
                throw new Exception("Update failed: " . mysqli_error($koneksi));
            }

            // Commit transaksi jika tidak ada error
            mysqli_commit($koneksi);

            // Redirect dengan status success
            header("Location: mon_pb.php?success=1");
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
