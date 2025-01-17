<?php
session_start();
if (!isset($_SESSION['nip'])) {
    header('location: index.php');
    exit;
}

include 'koneksi.php';

$_GET['nip'] = $_SESSION['nip'];
$user = $_GET['nip'];

// Query untuk mengambil riwayat print berdasarkan id user
$sql = $conn->query("SELECT * FROM user WHERE nip = '$user'");
$row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="asset/sb-admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Poppins', sans-serif; /* Use Poppins font here */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #003b77;
            color: white;
            font-size: 20px;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .btn-primary {
            background-color: #003b77;
            border: none;
        }

        .btn-primary:hover {
            background-color: #002c5a;
        }

        .btn-warning {
            background-color: #ffcc00;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e6b800;
        }

        img {
            border-radius: 50%;
            max-width: 150px;
            max-height: 150px;
        }

        .card-body {
            padding: 20px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #555;
        }

        .footer a {
            text-decoration: none;
            color: #003b77;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <div class="container">
        <div class="card">
            <div class="card-header">
                Profile Pegawai
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 text-center">
                    <img src="<?= $row['profile_pegawai']; ?>" alt="Profile">
                    </div>
                    <div class="col-lg-8">
                        <h5><strong>Nama Pegawai:</strong> <?= $row['nama']; ?></h5>
                        <p><strong>Jabatan:</strong> <?= $row['jabatan']; ?></p>
                        <p><strong>Username:</strong> <?= $row['username']; ?></p>
                        <p><strong>NIP:</strong> <?= $row['nip']; ?></p>
                        <p><strong>Email:</strong> <?= $row['email']; ?></p>
                        <p><strong>No HP:</strong> <?= $row['hp']; ?></p>
                        <div class="mt-4">
                            <a href="edit_profile_pegawai.php?nip=<?= $row['nip']; ?>" class="btn btn-warning btn-icon-split">
                                <span class="text">Update Profile</span>
                            </a>
                            <a href="dashboard.php" class="btn btn-primary btn-icon-split">
                                <span class="text">Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            &copy; <?= date('Y'); ?> Unit Perangkat Tukar UPT Balai Yasa Yogyakarta. All Rights Reserved.
            <br>
            <a href="https://id.wikipedia.org/wiki/Balai_Yasa_Yogyakarta" target="_blank">Visit our website</a>
        </div>
    </div>

</body>

</html>
