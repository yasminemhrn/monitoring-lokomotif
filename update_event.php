<?php
include "config.php";

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $id = $data['id'];
    $title = $data['title'];
    $start = $data['start'];
    $end = $data['end'];

    $query = "UPDATE events SET title = ?, start = ?, end = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $title, $start, $end, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
