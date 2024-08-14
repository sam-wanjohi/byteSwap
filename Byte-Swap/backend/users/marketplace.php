<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productValue = $_POST['productValue'];
    $productCondition = $_POST['productCondition'];
    $productImage = '';

    // Handle the image upload
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['productImage']['name']);
        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
            $productImage = $targetFile;
        }
    }

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (productName, productDescription, productValue, productCondition, productImage) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $productName, $productDescription, $productValue, $productCondition, $productImage);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Product listed successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}

// Fetch available products
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM products ORDER BY productName DESC");
    $products = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($products);
}
?>
