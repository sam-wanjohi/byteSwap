<?php
include('../../db.php');
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->user_id) || !isset($data->food_id) || !isset($data->points)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit();
}

$user_id = $data->user_id;
$food_id = $data->food_id;
$points = $data->points;

$query = "INSERT INTO transactions (user_id, food_id, points) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("iii", $user_id, $food_id, $points);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Transaction created']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Transaction failed']);
}

$stmt->close();
$mysqli->close();
?>
