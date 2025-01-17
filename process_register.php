<?php 
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monitoring";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password
    $hp = $_POST['hp'];

    // Proses unggah foto profil
    $profile_pegawai = $_FILES['profile_pegawai'];
    $upload_dir = 'uploads/';
    $file_name = basename($profile_pegawai['name']);
    $target_file = $upload_dir . $file_name;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($profile_pegawai['tmp_name'], $target_file)) {
            $sql = "INSERT INTO user (nip, profile_pegawai, nama, jabatan, username, email, password, hp)
                    VALUES ('$nip', '$target_file', '$nama', '$jabatan', '$username', '$email', '$password', '$hp')";

            if ($conn->query($sql) === TRUE) {
                // Notifikasi sukses
                echo "
                <style>
                    @font-face {
                        font-family: 'Poppins';
                        src: url(data:font/woff2;charset=utf-8;base64,d09GMgABAAAAA...AA==) format('woff2');
                        font-weight: normal;
                        font-style: normal;
                    }

                    body {
                        margin: 0;
                        padding: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background-color: #f5f5f5;
                        font-family: 'Poppins', sans-serif;
                    }

                    .success-container {
                        background-color: white;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                        text-align: center;
                        width: 300px;
                    }

                    .success-icon {
                        width: 60px;
                        height: 60px;
                        margin: 0 auto;
                        border-radius: 50%;
                        background-color: #e6f0ff; /* Biru muda sebagai aksen */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin-bottom: 20px;
                    }

                    .success-title {
                        color: #004a8b; /* Biru KAI */
                        font-size: 18px;
                        margin-bottom: 10px;
                        font-weight: 600;
                    }

                    .success-message {
                        color: #555;
                        font-size: 14px;
                        margin-bottom: 20px;
                    }

                    .success-button {
                        text-decoration: none;
                        background-color: #004a8b; /* Biru KAI */
                        color: white;
                        padding: 10px 20px;
                        border-radius: 5px;
                        font-size: 14px;
                    }

                    .success-button:hover {
                        background-color: #003970; /* Biru lebih gelap */
                    }
                </style>
                <div class='success-container'>
                    <div class='success-icon'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='36px' viewBox='0 0 24 24' width='36px' fill='#004a8b'><path d='M0 0h24v24H0V0z' fill='none'/><path d='M9.29 16.29L5.7 12.7a1 1 0 10-1.4 1.42l4 4a1 1 0 001.4 0l8-8a1 1 0 10-1.4-1.42l-7.41 7.41z'/></svg>
                    </div>
                    <h2 class='success-title'>Sukses</h2>
                    <p class='success-message'>Profil berhasil ditambahkan! Silahkan Login..</p>
                    <a href='index.php' class='success-button'>OK</a>
                </div>
                ";
                exit;
            } else {
                echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
        }
    } else {
        echo "<script>alert('Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan.');</script>";
    }
}

// Tutup koneksi
$conn->close();
?>
