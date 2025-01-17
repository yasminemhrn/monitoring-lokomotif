<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 10/21/17
 * Time: 4:16 PM
 */
include_once 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;
    $query = "select * from login where username = '$username' and password='$password'";
    $result = mysqli_query($koneksi, $query);

    $userdetails = mysqli_fetch_assoc($result);

    if($userdetails['username']=='manager')
    {
        header('Location: index.php?room_mang');
    }
    else{

        header('Location: login.php');
    }


}

//update data
// if (isset($_POST['submit'])) {

//     $id_md = $_POST['id_md'];
//     $no_sarana = $_POST['no_sarana'];
//     $depo = $_POST['depo'];
//     $nama_komponen = $_POST['nama_komponen'];
//     $no_seri = $_POST['no_seri'];
//     $tanggal_pasang = $_POST['tanggal_pasang'];

//     $query="UPDATE monitoring_depo
// SET no_sarana='$no_sarana', depo='$depo', nama_komponen='$nama_komponen',
// no_seri='$no_seri', tanggal_pasang='$tanggal_pasang' WHERE id_md=$id_md";
// //echo $query;
//     if (mysqli_query($koneksi, $query)) {
//         header('Location: index.php?depo_mang');
//     } else {
//         echo "Error updating record: " . mysqli_error($koneksi);
//     }
// }


// Memastikan parameter `menu` dan `id` ada
if (isset($_GET['menu']) && isset($_GET['id'])) {
    $menuType = $_GET['menu'];
    $id = intval($_GET['id']); // Menggunakan intval untuk menghindari SQL injection

    // Tentukan tabel dan kolom ID berdasarkan menu
    if ($menuType === 'cc206') {
        $table = 'prwtan_cc206';
        $column = 'id_206';
        $redirectPage = 'CC_206.php';
    } elseif ($menuType === 'depo') {
        $table = 'mon_depo';
        $column = 'id_mondp';
        $redirectPage = 'mon_depo.php';
    } elseif ($menuType === 'pb') {
        $table = 'mon_pb';
        $column = 'id_pb';
        $redirectPage = 'mon_pb.php';
    }elseif ($menuType === 'prog') {
            $table = 'mon_prog';
            $column = 'id_prog';
            $redirectPage = 'mon_prog.php';
    } else {
        echo "Menu tidak valid.";
        exit();
    }

    // Query untuk menghapus data
    $deleteQuery = "DELETE FROM $table WHERE $column = $id";

    if (mysqli_query($koneksi, $deleteQuery)) {
        // Jika berhasil, arahkan kembali ke halaman yang sesuai
        header("Location: $redirectPage");
        exit(); // Hentikan eksekusi setelah pengalihan
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "Parameter menu atau ID tidak ditemukan.";
}
?>