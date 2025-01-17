<?php
// Pastikan session dimulai di awal file sebelum output apapun
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Ambil data dari session
$username = $_SESSION['username'];
$nip = $_SESSION['nip'];

// Include file konfigurasi dan template
include "config.php";
$title = "Dashboard Monitoring";
include "template/header.php";
include "template/sidebar.php";
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4"></ol>

                <div class="row">
                    <!-- Row untuk Hello dan Profil -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card shadow-sm" style="background: linear-gradient(135deg, #0055d4, #0033a0); color: white; border-radius: 15px;">
                                <div class="card-body d-flex align-items-center">
                                    <div>
                                        <h4 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif;">
                                            Hallo <?= htmlspecialchars($username); ?>!
                                        </h4>
                                        <p class="mb-3" style="font-family: 'Roboto', sans-serif; font-size: 1rem;">
                                            Selamat datang kembali di Dashboard Monitoring Lokomotif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trivia Section - Right Side (Moved to the right) -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm" style="background: #f9f9f9; border-radius: 15px;">
                            <div class="card-header" style="background-color: #0055d4; color: white;">
                                <h4 class="mb-0">Tentang Balai Yasa</h4>
                            </div>
                            <div class="card-body">
                                <div class="trivia-item mb-3">
                                    <img src="img/balai yasa.jpg" alt="Trivia Image 1" class="img-fluid mb-2" style="border-radius: 8px;">
                                    <p>Balai Yasa Yogyakarta memiliki sejarah panjang dalam perawatan lokomotif dan kereta api.</p>
                                    <a href="https://id.wikipedia.org/wiki/Balai_Yasa_Yogyakarta" target="_blank" class="btn btn-info btn-sm">Baca Selengkapnya</a>
                                </div>
                                <div class="trivia-item mb-3">
                                    <img src="img/byyk.jpg" alt="Trivia Image 2" class="img-fluid mb-2" style="border-radius: 8px;">
                                    <p>Lokomotif yang diperbaiki di Balai Yasa Yogyakarta digunakan di berbagai wilayah di Indonesia.</p>
                                    <a href="https://id.wikipedia.org/wiki/Balai_Yasa_Yogyakarta" target="_blank" class="btn btn-info btn-sm">Baca Selengkapnya</a>
                                </div>
                                <div class="trivia-item mb-3">
                                    <img src="img/gedung.jpg" alt="Trivia Image 3" class="img-fluid mb-2" style="border-radius: 8px;">
                                    <p>Balai Yasa ini merupakan salah satu pusat perawatan lokomotif terbesar di Indonesia.</p>
                                    <a href="https://id.wikipedia.org/wiki/Balai_Yasa_Yogyakarta" target="_blank" class="btn btn-info btn-sm">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar Section -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Calendar</h4>
                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- FullCalendar Styles and Scripts -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true,
            selectable: true,
            events: 'get_events.php',
            select: function(info) {
                var title = prompt("Enter event title:");
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: info.startStr,
                        end: info.endStr
                    });
                    fetch('add_event.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            title: title,
                            start: info.startStr,
                            end: info.endStr
                        })
                    });
                }
                calendar.unselect();
            },
            eventClick: function(info) {
                if (confirm("Do you want to delete this event?")) {
                    info.event.remove();
                    fetch('delete_event.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: info.event.id })
                    });
                } else {
                    var newTitle = prompt("Edit event title:", info.event.title);
                    if (newTitle !== null) {
                        info.event.setProp('title', newTitle);
                        fetch('update_event.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: info.event.id,
                                title: newTitle,
                                start: info.event.start.toISOString(),
                                end: info.event.end ? info.event.end.toISOString() : null
                            })
                        });
                    }
                }
            }
        });
        calendar.render();
    });
</script>

<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Poppins', sans-serif;
    }

    .bg-primary {
        background-color: #0055d4 !important;
    }

    .text-white {
        color: #ffffff !important;
    }

    .card {
        border-radius: 15px;
    }

    #calendar {
        max-width: 80%;
        margin: 0 auto;
        font-size: 0.9rem;
    }

    .trivia-item img {
        width: 100%;
        border-radius: 8px;
    }

    .trivia-item a {
        text-decoration: none;
    }

    .card-header {
        background-color: #0055d4;
        color: white;
    }

    .btn-info {
        background-color: #0055d4; /* Warna biru BUMN KAI */
        border-color: #0055d4; /* Warna border biru */
        color: white; /* Warna teks putih */
    }

    .btn-info:hover {
        background-color: #0033a0; /* Biru lebih gelap saat hover */
        border-color: #0033a0; /* Border lebih gelap saat hover */
    }

    .btn-info:focus, .btn-info.focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 85, 212, 0.5); /* Efek fokus pada tombol */
    }
</style>

<?php
include "template/footer.php";
?>
