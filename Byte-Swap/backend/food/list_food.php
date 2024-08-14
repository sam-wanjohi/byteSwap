<?php
include '../db.php'; // Adjust the path as needed

if (isset($_POST['user_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['condition']) && isset($_POST['value'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $condition = $_POST['condition'];
    $value = $_POST['value'];
    $image_url = $_POST['image_url'] ?? null; // Optional field

    $stmt = $conn->prepare("INSERT INTO food_items (user_id, name, description, condition, value, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiis", $user_id, $name, $description, $condition, $value, $image_url);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Item listed successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}
?>
