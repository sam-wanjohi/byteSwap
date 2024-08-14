<?php
include '../../db.php';

$from_user_id = $_POST['from_user_id'];
$to_user_id = $_POST['to_user_id'];
$from_food_item_id = $_POST['from_food_item_id'];
$to_food_item_id = $_POST['to_food_item_id'];
$byte_value = $_POST['byte_value'];

$stmt = $conn->prepare("INSERT INTO transactions (from_user_id, to_user_id, from_food_item_id, to_food_item_id, byte_value, status) VALUES (?, ?, ?, ?, ?, 'pending')");
$stmt->bind_param("iiiii", $from_user_id, $to_user_id, $from_food_item_id, $to_food_item_id, $byte_value);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
