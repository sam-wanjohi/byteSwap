<?php
include('../../db.php');
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->transaction_id) || !isset($data->status)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit();
}

$transaction_id = $data->transaction_id;
$status = $data->status;

$query = "UPDATE transactions SET status = ? WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("si", $status, $transaction_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Transaction updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update failed']);
}

$stmt->close();
$mysqli->close();
?>
