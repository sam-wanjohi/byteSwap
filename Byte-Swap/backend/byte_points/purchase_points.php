<?php
include '../../db.php';

$user_id = $_POST['user_id'];
$points = $_POST['points'];

$stmt = $conn->prepare("UPDATE byte_points SET points = points + ? WHERE user_id = ?");
$stmt->bind_param("ii", $points, $user_id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
