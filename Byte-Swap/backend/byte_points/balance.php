<?php
include '../../db.php';

$user_id = $_POST['user_id'];

$stmt = $conn->prepare("SELECT points FROM byte_points WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($points);
$stmt->fetch();

echo json_encode(["points" => $points]);

$stmt->close();
$conn->close();
?>
