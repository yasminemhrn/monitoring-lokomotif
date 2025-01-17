<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "monitoring");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna
$nip = 1; // NIP pengguna yang sedang login (hardcoded untuk demo)
$query = "SELECT * FROM user WHERE nip = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $nip);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Periksa apakah data pengguna ditemukan
if (!$user) {
    die("Pengguna tidak ditemukan.");
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);

    // Periksa apakah ada file yang diunggah
    $profile_pegawai = $user['profile_pegawai']; // Default: file lama
    if (isset($_FILES['profile_pegawai']) && $_FILES['profile_pegawai']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Direktori penyimpanan file
        $target_file = $target_dir . basename($_FILES["profile_pegawai"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file
        $check = getimagesize($_FILES["profile_pegawai"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["profile_pegawai"]["tmp_name"], $target_file)) {
                $profile_pegawai = basename($_FILES["profile_pegawai"]["name"]);
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "File yang diunggah bukan gambar.";
        }
    }

    // Update data menggunakan prepared statement
    $update_query = "UPDATE user SET nama = ?, profile_pegawai = ? WHERE nip = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $nama, $profile_pegawai, $nip);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #004a8b; color: #ffffff;">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color: #ffffff;">Perangkat Tukar UPT BYYK</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php" style="color: #ffffff;">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#" style="color: #ff7f32;">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="color: #ffffff;">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="background-color: #004a8b; color: #ffffff;">
                        <h5>Edit Profil Penginput Data</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3 text-center">
                                <img src="uploads/<?= htmlspecialchars($user['profile_pegawai'], ENT_QUOTES); ?>" alt="Profil" class="img-thumbnail" style="width: 150px; height: 150px;">
                            </div>
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama'], ENT_QUOTES); ?>" required>
                            </div>
                            <!-- Profil Picture -->
                            <div class="mb-3">
                                <label for="profile_pegawai" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="profile_pegawai" name="profile_pegawai" accept="image/*">
                            </div>
                            <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #ff7f32; border: none;">Simpan</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
