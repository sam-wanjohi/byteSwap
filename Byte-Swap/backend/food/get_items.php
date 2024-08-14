<?php
include '../../db.php'; // Adjust the path as needed

header('Content-Type: application/json');

$sql = "SELECT id, user_id, name, description, condition, value, image_url FROM food_items";
$result = $conn->query($sql);

$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

echo json_encode($items);

$conn->close();
?>
