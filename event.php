<?php
include "config.php";

$query = "SELECT id, title, start, end FROM events";
$result = $conn->query($query);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

header('Content-Type: application/json');
echo json_encode($events);
?>
