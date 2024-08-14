<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ? AND phone = ? AND password = ?");
    if ($stmt) {
        $stmt->bind_param("ssss", $username, $email, $phone, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
             session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            // Redirect to user profile page
            header("Location: ../../frontend/profile.html");
            exit();
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}
?>