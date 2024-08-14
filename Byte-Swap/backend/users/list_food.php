<?php
include '../../db.php';

$result = $conn->query("SELECT * FROM food_items");

$food_items = [];
while ($row = $result->fetch_assoc()) {
    $food_items[] = $row;
}

echo json_encode($food_items);

$conn->close();
?>
