<?php
include '../../db.php';

$search_term = $_POST['search_term'];
$result = $conn->prepare("SELECT * FROM food_items WHERE name LIKE ?");
$like_term = "%".$search_term."%";
$result->bind_param("s", $like_term);
$result->execute();
$result->store_result();
$result->bind_result($id, $name, $owner_id, $condition, $physical_condition, $byte_value);

$food_items = [];
while ($result->fetch()) {
    $food_items[] = [
        "id" => $id,
        "name" => $name,
        "owner_id" => $owner_id,
        "condition" => $condition,
        "physical_condition" => $physical_condition,
        "byte_value" => $byte_value
    ];
}

echo json_encode($food_items);

$result->close();
$conn->close();
?>
