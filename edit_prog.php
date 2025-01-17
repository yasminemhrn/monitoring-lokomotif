<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Mengambil data dari form edit
        $id = $_POST['id_prog'];
        $lokomotif = $_POST['lokomotif'];
        $depo = $_POST['depo'];
        $sifat = $_POST['sifat'];
        $work_order = $_POST['work_order'];
        $engine = $_POST['engine'];
        $cj_1l = $_POST['cj_1l'];
        $cj_2l = $_POST['cj_2l'];
        $cj_3l = $_POST['cj_3l'];
        $cj_4l = $_POST['cj_4l'];
        $cj_1r = $_POST['cj_1r'];
        $cj_2r = $_POST['cj_2r'];
        $cj_3r = $_POST['cj_3r'];
        $cj_4r = $_POST['cj_4r'];
        $cl_1l = $_POST['cl_1l'];
        $cl_2l = $_POST['cl_2l'];
        $cl_3l = $_POST['cl_3l'];
        $cl_4l = $_POST['cl_4l'];
        $cl_1r = $_POST['cl_1r'];
        $cl_2r = $_POST['cl_2r'];
        $cl_3r = $_POST['cl_3r'];
        $cl_4r = $_POST['cl_4r'];
        $ip_1l = $_POST['ip_1l'];
        $ip_2l = $_POST['ip_2l'];
        $ip_3l = $_POST['ip_3l'];
        $ip_4l = $_POST['ip_4l'];
        $ip_1r = $_POST['ip_1r'];
        $ip_2r = $_POST['ip_2r'];
        $ip_3r = $_POST['ip_3r'];
        $ip_4r = $_POST['ip_4r'];
        $in_1l = $_POST['in_1l'];
        $in_2l = $_POST['in_2l'];
        $in_3l = $_POST['in_3l'];
        $in_4l = $_POST['in_4l'];
        $in_1r = $_POST['in_1r'];
        $in_2r = $_POST['in_2r'];
        $in_3r = $_POST['in_3r'];
        $in_4r = $_POST['in_4r'];
        $intercooler_r = $_POST['intercooler_r'];
        $intercooler_l = $_POST['intercooler_l'];
        $oil_pump = $_POST['oil_pump'];
        $water_pump = $_POST['water_pump'];
        $turbocharger = $_POST['turbocharger'];
        $governor_md = $_POST['governor_md'];
        $overspeed_md = $_POST['overspeed_md'];
        $air_compressor = $_POST['air_compressor'];
        $fan_radiator = $_POST['fan_radiator'];
        $lube_oil = $_POST['lube_oil'];
        $radiator = $_POST['radiator'];
        $automaticbrake_1 = $_POST['automaticbrake_1'];
        $automaticbrake_2 = $_POST['automaticbrake_2'];
        $independentbrake_1 = $_POST['independentbrake_1'];
        $independentbrake_2 = $_POST['independentbrake_2'];
        $blower_tm = $_POST['blower_tm'];
        $exhauster = $_POST['exhauster'];
        $auxilary_gen = $_POST['auxilary_gen'];
        $exciter_gen = $_POST['exciter_gen'];
        $main_gen = $_POST['main_gen'];
        $tl_1 = $_POST['tl_1'];
        $tl_2 = $_POST['tl_2'];
        $tl_3 = $_POST['tl_3'];
        $tl_4 = $_POST['tl_4'];
        $tl_5 = $_POST['tl_5'];
        $tl_6 = $_POST['tl_6'];
        $battery = $_POST['battery'];
        $full_pump = $_POST['full_pump'];
        $dyn_brake = $_POST['dyn_brake'];
        $volt_regulator = $_POST['volt_regulator'];
        $br_1 = $_POST['br_1'];
        $br_2 = $_POST['br_2'];
        $be_1 = $_POST['be_1'];
        $be_2 = $_POST['be_2'];
        $sdis_1 = $_POST['sdis_1'];
        $sdis_2 = $_POST['sdis_2'];
        $bs_1 = $_POST['bs_1'];
        $bs_2 = $_POST['bs_2'];
        $ws_1 = $_POST['ws_1'];
        $ws_2 = $_POST['ws_2'];
        $ws_3 = $_POST['ws_3'];
        $ws_4 = $_POST['ws_4'];
        $ws_5 = $_POST['ws_5'];
        $ws_6 = $_POST['ws_6'];
        $km = $_POST['km'];
        $sap = $_POST['sap'];
        $dt = $_POST['dt'];
        $input_roda = $_POST['input_roda'];
        $pic = $_POST['pic'];
        $buku_prwtn = $_POST['buku_prwtn'];
        $sertikasi_dirjen = $_POST['sertikasi_dirjen'];
        $softcopy = $_POST['softcopy'];
        $checksheet = $_POST['checksheet'];
        $f7 = $_POST['f7'];
        $tgl_msk = $_POST['tgl_msk'];
        $tgl_klr = $_POST['tgl_klr'];

        // Memulai transaksi
        mysqli_begin_transaction($koneksi);
        try {
            // Query update data
            
            $query1 = "UPDATE mon_prog SET
                id_prog = '$id',
                lokomotif = '$lokomotif',
                depo = '$depo',
                sifat = '$sifat',
                work_order = '$work_order',
                engine = '$engine',
                cj_1l = '$cj_1l',
                cj_2l = '$cj_2l',
                cj_3l = '$cj_3l',
                cj_4l = '$cj_4l',
                cj_1r = '$cj_1r',
                cj_2r = '$cj_2r',
                cj_3r = '$cj_3r',
                cj_4r = '$cj_4r',
                cl_1l = '$cl_1l',
                cl_2l = '$cl_2l',
                cl_3l = '$cl_3l',
                cl_4l = '$cl_4l',
                cl_1r = '$cl_1r',
                cl_2r = '$cl_2r',
                cl_3r = '$cl_3r',
                cl_4r = '$cl_4r',
                ip_1l = '$ip_1l',
                ip_2l = '$ip_2l',
                ip_3l = '$ip_3l',
                ip_4l = '$ip_4l',
                ip_1r = '$ip_1r',
                ip_2r = '$ip_2r',
                ip_3r = '$ip_3r',
                ip_4r = '$ip_4r',
                in_1l = '$in_1l',
                in_2l = '$in_2l',
                in_3l = '$in_3l',
                in_4l = '$in_4l',
                in_1r = '$in_1r',
                in_2r = '$in_2r',
                in_3r = '$in_3r',
                in_4r = '$in_4r',
                intercooler_r = '$intercooler_r',
                intercooler_l = '$intercooler_l',
                oil_pump = '$oil_pump',
                water_pump = '$water_pump',
                turbocharger = '$turbocharger',
                governor_md = '$governor_md',
                overspeed_md = '$overspeed_md',
                air_compressor = '$air_compressor',
                fan_radiator = '$fan_radiator',
                lube_oil = '$lube_oil',
                radiator = '$radiator',
                automaticbrake_1 = '$automaticbrake_1',
                automaticbrake_2 = '$automaticbrake_2',
                independentbrake_1 = '$independentbrake_1',
                independentbrake_2 = '$independentbrake_2',
                blower_tm = '$blower_tm',
                exhauster = '$exhauster',
                auxilary_gen = '$auxilary_gen',
                exciter_gen = '$exciter_gen',
                main_gen = '$main_gen',
                tl_1 = '$tl_1',
                tl_2 = '$tl_2',
                tl_3 = '$tl_3',
                tl_4 = '$tl_4',
                tl_5 = '$tl_5',
                tl_6 = '$tl_6',
                battery = '$battery',
                full_pump = '$full_pump',
                dyn_brake = '$dyn_brake',
                volt_regulator = '$volt_regulator',
                br_1 = '$br_1',
                br_2 = '$br_2',
                be_1 = '$be_1',
                be_2 = '$be_2',
                sdis_1 = '$sdis_1',
                sdis_2 = '$sdis_2',
                bs_1 = '$bs_1',
                bs_2 = '$bs_2',
                ws_1 = '$ws_1',
                ws_2 = '$ws_2',
                ws_3 = '$ws_3',
                ws_4 = '$ws_4',
                ws_5 = '$ws_5',
                ws_6 = '$ws_6',
                km = '$km',
                sap = '$sap',
                dt = '$dt',
                input_roda = '$input_roda',
                pic = '$pic',
                buku_prwtn = '$buku_prwtn',
                sertikasi_dirjen = '$sertikasi_dirjen',
                softcopy = '$softcopy',
                checksheet = '$checksheet',
                f7 = '$f7',
                tgl_msk = '$tgl_msk',
                tgl_klr = '$tgl_klr'
                WHERE id_prog = '$id'";

            // Menjalankan query dan cek error
            if (!mysqli_query($koneksi, $query1)) {
                throw new Exception("Update failed: " . mysqli_error($koneksi));
            }

            // Commit transaksi jika tidak ada error
            mysqli_commit($koneksi);

            // Redirect dengan status success
            header("Location: mon_prog.php?success=1");
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