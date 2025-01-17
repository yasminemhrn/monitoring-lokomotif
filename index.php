<?php
session_start(); // Memulai session

include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username); // "s" berarti string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan data penting di session
            $_SESSION['username'] = $user['username'];
            $_SESSION['nip'] = $user['nip'];
            $_SESSION['profile_pegawai'] = $user['profile_pegawai']; // Tambahkan path foto

            // Redirect ke halaman dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            // Password salah
            $error = "Password salah.";
        }
    } else {
        // Username tidak ditemukan
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KAI</title>
    
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #004a8b, #0081c6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            overflow: hidden;
        }

        .accent-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.2;
        }

        .accent-shape-1 {
            width: 400px;
            height: 400px;
            background-color: #ffffff;
            top: -100px;
            left: -100px;
        }

        .accent-shape-2 {
            width: 300px;
            height: 300px;
            background-color: #ffa500;
            bottom: -80px;
            right: -80px;
        }

        .card {
            z-index: 2;
            background: #fff;
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            background-color: #004a8b;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .card-header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .card-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #004a8b;
            border: none;
            border-radius: 30px;
        }

        .btn-primary:hover {
            background-color: #003970;
        }

        .btn-primary:active {
            background-color: #002a55;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }

        .footer a {
            color: #004a8b;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .text-small {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="accent-shape accent-shape-1"></div>
    <div class="accent-shape accent-shape-2"></div>

    <div class="card">
        <div class="card-header">
            <h1>Login</h1>
            <p>Selamat datang di Sistem Monitoring Lokomotif</p>
        </div>
        <div class="card-body">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username atau email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <button class="btn btn-primary btn-lg w-100" type="submit" name="submit">LOGIN</button>
            </form>
            <div class="text-center mt-3 text-small">
                <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
            </div>
        </div>
        <div class="footer">
            <p>© 2025 UPT Balai Yasa Yogyakarta. <a href="#">Bantuan</a></p>
        </div>
    </div>
</body>

</html>
