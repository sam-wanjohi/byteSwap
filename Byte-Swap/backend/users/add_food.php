<?php
include '../../db.php';

$name = $_POST['name'];
$owner_id = $_POST['owner_id'];
$condition = $_POST['condition'];
$physical_condition = $_POST['physical_condition'];
$byte_value = $_POST['byte_value'];

$stmt = $conn->prepare("INSERT INTO food_items (name, owner_id, condition, physical_condition, byte_value) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sissi", $name, $owner_id, $condition, $physical_condition, $byte_value);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
