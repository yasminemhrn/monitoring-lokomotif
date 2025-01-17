<?php
include "config.php";

$query = "SELECT * FROM events";
$result = $conn->query($query);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'],
        'end' => $row['end']
    ];
}

echo json_encode($events);
?>
