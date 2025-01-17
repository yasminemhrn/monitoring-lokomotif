<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Penggunaan Dashboard</title>
    
    <!-- Add Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <style>
        /* Background with Gradient and subtle Train Icon */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(45deg, #0055d4, #00aaff);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/ed/Kereta_api.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 15%;
        }

        /* Card Styles */
        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 2rem;
            color: #0055d4;
        }

        h1 {
            color: #0055d4;
            font-weight: 600;
        }

        .card-title {
            font-weight: 600;
        }

        /* Gradient Animation */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Panduan Penggunaan Dashboard Monitoring</h1>
        <div class="row">
            <!-- Langkah 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-sign-in-alt icon"></i>
                        <h5 class="card-title mt-3">1. Login ke Dashboard</h5>
                        <p class="card-text">Gunakan username dan password yang telah terdaftar untuk mengakses dashboard.</p>
                    </div>
                </div>
            </div>
            <!-- Langkah 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-tachometer-alt icon"></i>
                        <h5 class="card-title mt-3">2. Navigasi Menu</h5>
                        <p class="card-text">Gunakan menu di bagian samping kiri (sidebar) untuk mengakses fitur seperti monitoring program, depo, perbaikan, perawatan CC 206, profile, logout.</p>
                    </div>
                </div>
            </div>
            <!-- Langkah 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-database icon"></i>
                        <h5 class="card-title mt-3">3. Monitoring Lokomotif</h5>
                        <p class="card-text">Pantau lokomotif yang melakukan pergantian komponen perbaikan/perawatan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Langkah 4 -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-cog icon"></i>
                        <h5 class="card-title mt-3">4. Edit Profil</h5>
                        <p class="card-text">Perbarui informasi profil Anda di menu pengaturan untuk keamanan dan personalisasi.</p>
                    </div>
                </div>
            </div>
            <!-- Langkah 5 -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-sign-out-alt icon"></i>
                        <h5 class="card-title mt-3">5. Logout</h5>
                        <p class="card-text">Keluar dari dashboard setelah selesai untuk menjaga keamanan data.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol Ke Dashboard -->
        <div class="text-center mt-5">
            <a href="dashboard.php" class="btn btn-primary btn-lg">
                <i class="fas fa-arrow-right"></i> Kembali
            </a>
        </div>
    </div>
</body>

</html>
