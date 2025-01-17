<?php 
// Include file koneksi
include 'koneksi.php';

// Mendapatkan NIP dari URL
$nip = $_GET['nip'];

// Query untuk mengambil data user berdasarkan NIP
$sql = $conn->query("SELECT * FROM user WHERE nip ='$nip'");
$row = $sql->fetch_assoc();

// Jika data tidak ditemukan
if (!$row) {
    echo "Data tidak ditemukan.";
    exit();
}

// Variabel untuk notifikasi
$notification = "";

// Proses update data ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $password = $_POST['password'];
    $profile_pegawai = null;

    // Jika ada file gambar yang diupload
    if (!empty($_FILES['profile_pegawai']['tmp_name'])) {
        $profile_pegawai = file_get_contents($_FILES['profile_pegawai']['tmp_name']);
    }

    // Validasi input
    if (!empty($nip) && !empty($nama) && !empty($username) && !empty($password) && !empty($email) && !empty($jabatan) && !empty($hp)) {
        // Query untuk update data
        if ($profile_pegawai) {
            $sql = "UPDATE user SET 
                        nama = ?, 
                        username = ?,
                        jabatan = ?,
                        email = ?, 
                        hp = ?, 
                        password = ?, 
                        profile_pegawai = ? 
                    WHERE nip = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $nama, $username, $jabatan, $email, $hp, $password, $profile_pegawai, $nip);
        } else {
            $sql = "UPDATE user SET 
                        nama = ?, 
                        username = ?, 
                        jabatan = ?, 
                        email = ?, 
                        hp = ?, 
                        password = ? 
                    WHERE nip = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nama, $username, $jabatan, $email, $hp, $password, $nip);
        }

        // Eksekusi query
        if ($stmt->execute()) {
            $notification = "success";
        } else {
            $notification = "error";
        }

        $stmt->close();
    } else {
        $notification = "empty";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    
    <!-- Add Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Apply Poppins font globally */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-weight: 600;
            color: #003b77;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            font-family: 'Poppins', sans-serif;
        }

        .btn {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-color: #003b77;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-primary:hover, .btn-secondary:hover {
            opacity: 0.8;
        }

        .mb-3 label {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Data Pegawai</h1>
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return handleFormSubmit(event)">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" readonly
                    value="<?= htmlspecialchars($row['nip']); ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required
                    value="<?= htmlspecialchars($row['nama']); ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required
                    value="<?= htmlspecialchars($row['username']); ?>">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required
                    value="<?= htmlspecialchars($row['jabatan']); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required
                    value="<?= htmlspecialchars($row['email']); ?>">
            </div>
            <div class="mb-3">
                <label for="hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="hp" name="hp" required
                    value="<?= htmlspecialchars($row['hp']); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    value="<?= htmlspecialchars($row['password']); ?>">
            </div>
            <div class="mb-3">
                <label for="profile_pegawai" class="form-label">Profile Pegawai (Gambar)</label>
                <input type="file" class="form-control" id="profile_pegawai" name="profile_pegawai">
                <?php if (!empty($row['profile_pegawai'])): ?>
                    <p class="mt-2">Photo saat ini: <img
                            src="data:image/jpeg;base64,<?= base64_encode($row['profile_pegawai']); ?>" alt="Profile"
                            style="max-width: 100px; max-height: 100px;"></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="profile.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        // Fungsi untuk menampilkan notifikasi menggunakan SweetAlert2
        function showNotification(type) {
            if (type === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Profil berhasil diupdate!',
                    confirmButtonText: 'OK',
                });
            } else if (type === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan profil.',
                    confirmButtonText: 'OK',
                });
            } else if (type === "empty") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Semua field wajib diisi!',
                    confirmButtonText: 'OK',
                });
            }
        }

        // Tampilkan notifikasi dari server jika ada
        <?php if (!empty($notification)): ?>
        showNotification("<?= $notification; ?>");
        <?php endif; ?>

        // Fungsi untuk menangani submit form
        function handleFormSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(() => {
                showNotification('success');
            })
            .catch(() => {
                showNotification('error');
            });
        }
    </script>
</body>

</html>
