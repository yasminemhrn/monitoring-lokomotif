<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - KAI</title>
    <!-- Link Font Poppins -->
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
            max-width: 500px;
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
    </style>
</head>

<body>
    <!-- Aksen Background -->
    <div class="accent-shape accent-shape-1"></div>
    <div class="accent-shape accent-shape-2"></div>

    <!-- Form Registrasi -->
    <div class="card">
        <div class="card-header">
            <h1>Registrasi</h1>
            <p>Silakan isi data diri Anda untuk membuat akun</p>
        </div>
        <div class="card-body">
            <form action="process_register.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukkan NIP" required>
                </div>
                <div class="mb-3">
                    <label for="profile_pegawai" class="form-label">Foto Profil</label>
                    <input type="file" id="profile_pegawai" name="profile_pegawai" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Masukkan jabatan" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">Nomor HP</label>
                    <input type="tel" id="hp" name="hp" class="form-control" placeholder="Masukkan nomor HP" required>
                </div>
                <button class="btn btn-primary btn-lg w-100" type="submit">Daftar</button>
            </form>
        </div>
        <div class="footer">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>

</html>
