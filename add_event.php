<?php
include "config.php";

// Mengambil data JSON dari request
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $title = $data['title'];
    $start = $data['start'];
    $end = $data['end'];

    // Menambahkan event ke database
    $query = "INSERT INTO events (title, start, end) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $title, $start, $end);

    if ($stmt->execute()) {
        // Mengembalikan ID event yang baru ditambahkan
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
