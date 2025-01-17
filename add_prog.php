<?php
include 'config.php'; // Koneksi ke database

// Cek jika form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lokomotif = $_POST['lokomotif'];
    $depo = $_POST['depo'];
    $sifat = $_POST['sifat'];
    $work_order = isset($_POST['work_order']) ? $_POST['work_order'] : ''; 
    $engine = isset($_POST['engine']) ? $_POST['engine'] : '';
    $cj_1l = isset($_POST['cj_1l']) ? $_POST['cj_1l'] : '';
    $cj_2l = isset($_POST['cj_2l']) ? $_POST['cj_2l'] : '';
    $cj_3l = isset($_POST['cj_3l']) ? $_POST['cj_3l'] : '';
    $cj_4l = isset($_POST['cj_4l']) ? $_POST['cj_4l'] : '';
    $cj_1r = isset($_POST['cj_1r']) ? $_POST['cj_1r'] : '';
    $cj_2r = isset($_POST['cj_2r']) ? $_POST['cj_2r'] : '';
    $cj_3r = isset($_POST['cj_3r']) ? $_POST['cj_3r'] : '';
    $cj_4r = isset($_POST['cj_4r']) ? $_POST['cj_4r'] : '';
    $cl_1l = isset($_POST['cl_1l']) ? $_POST['cl_1l'] : '';
    $cl_2l = isset($_POST['cl_2l']) ? $_POST['cl_2l'] : '';
    $cl_3l = isset($_POST['cl_3l']) ? $_POST['cl_3l'] : '';
    $cl_4l = isset($_POST['cl_4l']) ? $_POST['cl_4l'] : '';
    $cl_1r = isset($_POST['cl_1r']) ? $_POST['cl_1r'] : '';
    $cl_2r = isset($_POST['cl_2r']) ? $_POST['cl_2r'] : '';
    $cl_3r = isset($_POST['cl_3r']) ? $_POST['cl_3r'] : '';
    $cl_4r = isset($_POST['cl_4r']) ? $_POST['cl_4r'] : '';
    $ip_1l = isset($_POST['ip_1l']) ? $_POST['ip_1l'] : '';
    $ip_2l = isset($_POST['ip_2l']) ? $_POST['ip_2l'] : '';
    $ip_3l = isset($_POST['ip_3l']) ? $_POST['ip_3l'] : '';
    $ip_4l = isset($_POST['ip_4l']) ? $_POST['ip_4l'] : '';
    $ip_1r = isset($_POST['ip_1r']) ? $_POST['ip_1r'] : '';
    $ip_2r = isset($_POST['ip_2r']) ? $_POST['ip_2r'] : '';
    $ip_3r = isset($_POST['ip_3r']) ? $_POST['ip_3r'] : '';
    $ip_4r = isset($_POST['ip_4r']) ? $_POST['ip_4r'] : '';
    $in_1l = isset($_POST['in_1l']) ? $_POST['in_1l'] : '';
    $in_2l = isset($_POST['in_2l']) ? $_POST['in_2l'] : '';
    $in_3l = isset($_POST['in_3l']) ? $_POST['in_3l'] : '';
    $in_4l = isset($_POST['in_4l']) ? $_POST['in_4l'] : '';
    $in_1r = isset($_POST['in_1r']) ? $_POST['in_1r'] : '';
    $in_2r = isset($_POST['in_2r']) ? $_POST['in_2r'] : '';
    $in_3r = isset($_POST['in_3r']) ? $_POST['in_3r'] : '';
    $in_4r = isset($_POST['in_4r']) ? $_POST['in_4r'] : '';
    $intercooler_r = isset($_POST['intercooler_r']) ? $_POST['intercooler_r'] : '';
    $intercooler_l = isset($_POST['intercooler_l']) ? $_POST['intercooler_l'] : '';
    $oil_pump = isset($_POST['oil_pump']) ? $_POST['oil_pump'] : '';
    $water_pump = isset($_POST['water_pump']) ? $_POST['water_pump'] : '';
    $turbocharger = isset($_POST['turbocharger']) ? $_POST['turbocharger'] : '';
    $governor_md = isset($_POST['governor_md']) ? $_POST['governor_md'] : '';
    $overspeed_md = isset($_POST['overspeed_md']) ? $_POST['overspeed_md'] : '';
    $air_compressor = isset($_POST['air_compressor']) ? $_POST['air_compressor'] : '';
    $fan_radiator = isset($_POST['fan_radiator']) ? $_POST['fan_radiator'] : '';
    $lube_oil = isset($_POST['lube_oil']) ? $_POST['lube_oil'] : '';
    $radiator = isset($_POST['radiator']) ? $_POST['radiator'] : '';
    $automaticbrake_1 = isset($_POST['automaticbrake_1']) ? $_POST['automaticbrake_1'] : '';
    $automaticbrake_2 = isset($_POST['automaticbrake_2']) ? $_POST['automaticbrake_1'] : '';
    $independentbrake_1 = isset($_POST['independentbrake_1']) ? $_POST['independentbrake_1'] : '';
    $independentbrake_2 = isset($_POST['independentbrake_2']) ? $_POST['independentbrake_2'] : '';
    $blower_tm = isset($_POST['blower_tm']) ? $_POST['blower_tm'] : '';
    $exhauster = isset($_POST['exhauster']) ? $_POST['exhauster'] : '';
    $auxilary_gen = isset($_POST['auxilary_gen']) ? $_POST['auxilary_gen'] : '';
    $exciter_gen = isset($_POST['exciter_gen']) ? $_POST['exciter_gen'] : '';
    $main_gen = isset($_POST['main_gen']) ? $_POST['main_gen'] : '';
    $tl_1 = isset($_POST['tl_1']) ? $_POST['tl_1'] : '';
    $tl_2 = isset($_POST['tl_2']) ? $_POST['tl_2'] : '';
    $tl_3 = isset($_POST['tl_3']) ? $_POST['tl_3'] : '';
    $tl_4 = isset($_POST['tl_4']) ? $_POST['tl_4'] : '';
    $tl_5 = isset($_POST['tl_5']) ? $_POST['tl_5'] : '';
    $tl_6 = isset($_POST['tl_6']) ? $_POST['tl_6'] : '';
    $battery = isset($_POST['battery']) ? $_POST['battery'] : '';
    $full_pump = isset($_POST['full_pump']) ? $_POST['full_pump'] : '';
    $dyn_brake = isset($_POST['dyn_brake']) ? $_POST['dyn_brake'] : '';
    $volt_regulator = isset($_POST['volt_regulator']) ? $_POST['volt_regulator'] : '';
    $br_1 = isset($_POST['br_1']) ? $_POST['br_1'] : '';
    $br_2 = isset($_POST['br_2']) ? $_POST['br_2'] : '';
    $be_1 = isset($_POST['be_1']) ? $_POST['be_1'] : '';
    $be_2 = isset($_POST['be_2']) ? $_POST['be_2'] : '';
    $sdis_1 = isset($_POST['sdis_1']) ? $_POST['sdis_1'] : '';
    $sdis_2 = isset($_POST['sdis_2']) ? $_POST['sdis_2'] : '';
    $bs_1 = isset($_POST['bs_1']) ? $_POST['bs_1'] : '';
    $bs_2 = isset($_POST['bs_2']) ? $_POST['bs_2'] : '';
    $ws_1 = isset($_POST['ws_1']) ? $_POST['ws_1'] : '';
    $ws_2 = isset($_POST['ws_2']) ? $_POST['ws_2'] : '';
    $ws_3 = isset($_POST['ws_3']) ? $_POST['ws_3'] : '';
    $ws_4 = isset($_POST['ws_4']) ? $_POST['ws_4'] : '';
    $ws_5 = isset($_POST['ws_5']) ? $_POST['ws_5'] : '';
    $ws_6 = isset($_POST['ws_6']) ? $_POST['ws_6'] : '';
    $km = isset($_POST['km']) ? $_POST['km'] : '';
    $sap = isset($_POST['sap']) ? $_POST['sap'] : '';
    $dt = isset($_POST['dt']) ? $_POST['dt'] : '';
    $input_roda = isset($_POST['input_roda']) ? $_POST['input_roda'] : '';
    $pic = isset($_POST['pic']) ? $_POST['pic'] : '';
    $buku_prwtn = isset($_POST['buku_prwtn']) ? $_POST['buku_prwtn'] : '';
    $sertikasi_dirjen = isset($_POST['sertikasi_dirjen']) ? $_POST['sertikasi_dirjen'] : '';
    $softcopy = isset($_POST['softcopy']) ? $_POST['softcopy'] : '';
    $checksheet = isset($_POST['checksheet']) ? $_POST['checksheet'] : '';
    $f7 = isset($_POST['f7']) ? $_POST['f7'] : '';
    $tgl_msk = isset($_POST['tgl_msk']) ? $_POST['tgl_msk'] : '';
    $tgl_klr = isset($_POST['tgl_klr']) ? $_POST['tgl_klr'] : '';
    

    // Query untuk menambahkan data ke dalam database, gunakan ON DUPLICATE KEY UPDATE
    // Query tanpa ON DUPLICATE KEY UPDATE
// Perbaiki query dengan memastikan tidak ada kolom yang duplikat dan sesuai jumlah
$query = "INSERT INTO mon_prog (lokomotif, depo, sifat, work_order, engine, cj_1l, cj_2l, cj_3l, cj_4l, cj_1r, cj_2r, cj_3r, cj_4r, 
cl_1l, cl_2l, cl_3l, cl_4l, cl_1r, cl_2r, cl_3r, cl_4r, ip_1l, ip_2l, ip_3l, ip_4l, ip_1r, ip_2r, ip_3r, ip_4r, in_1l, in_2l, in_3l, in_4l, 
in_1r, in_2r, in_3r, in_4r, intercooler_r, intercooler_l, oil_pump, water_pump, turbocharger, governor_md, overspeed_md, air_compressor, 
fan_radiator, lube_oil, radiator, automaticbrake_1, automaticbrake_2, independentbrake_1, independentbrake_2, blower_tm, exhauster, auxilary_gen, 
exciter_gen, main_gen, tl_1, tl_2, tl_3, tl_4, tl_5, tl_6, battery, full_pump, dyn_brake, volt_regulator, br_1, br_2, be_1, be_2, sdis_1, sdis_2,
bs_1, bs_2, ws_1, ws_2, ws_3, ws_4, ws_5, ws_6, km, sap, dt, input_roda, pic, buku_prwtn, sertikasi_dirjen, softcopy, checksheet, f7, tgl_msk, tgl_klr) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Inisialisasi prepared statement
if ($stmt = mysqli_prepare($koneksi, $query)) {
    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", 
    $lokomotif,$depo, $sifat, $work_order, $engine, $cj_1l, $cj_2l, $cj_3l, $cj_4l, $cj_1r, $cj_2r, $cj_3r, $cj_4r,
    $cl_1l, $cl_2l, $cl_3l, $cl_4l, $cl_1r, $cl_2r, $cl_3r, $cl_4r, $ip_1l, $ip_2l, $ip_3l, $ip_4l, $ip_1r, $ip_2r, $ip_3r, $ip_4r, $in_1l, $in_2l, $in_3l, $in_4l,
    $in_1r, $in_2r, $in_3r, $in_4r, $intercooler_r, $intercooler_l, $oil_pump, $water_pump, $turbocharger, $governor_md, $overspeed_md, $air_compressor,
    $fan_radiator, $lube_oil, $radiator, $automaticbrake_1, $automaticbrake_2, $independentbrake_1, $independentbrake_2, $blower_tm, $exhauster, $auxilary_gen,
    $exciter_gen, $main_gen, $tl_1,  $tl_2,  $tl_3,  $tl_4,  $tl_5,  $tl_6, $battery, $full_pump, $dyn_brake, $volt_regulator, $br_1, $br_2, $be_1, $be_2, $sdis_1, $sdis_2, 
    $bs_1, $bs_2, $ws_1, $ws_2, $ws_3, $ws_4, $ws_5, $ws_6, $km, $sap, $dt, $input_roda, $pic, $buku_prwtn, $sertikasi_dirjen, $softcopy, $checksheet, $f7, $tgl_msk, $tgl_klr);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: mon_prog.php?success=1'); // Redirect jika sukses
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
header('Location: mon_prog.php'); // Redirect jika form tidak diakses dengan POST
exit();
}



