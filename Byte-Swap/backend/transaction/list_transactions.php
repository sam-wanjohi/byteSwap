<?php
include('../../db.php');
header('Content-Type: application/json');

$query = "SELECT * FROM transactions";
$result = $mysqli->query($query);

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

echo json_encode($transactions);

$mysqli->close();
?>
