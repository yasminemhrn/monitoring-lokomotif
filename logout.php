<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hapus semua session
    session_unset();
    session_destroy();

    // Redirect ke halaman login
    header("Location: index.php");
    exit();
}
?>
