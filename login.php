<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user info from the database using email
    $sql = "SELECT user_id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session and respond with success
            $_SESSION['user_id'] = $user['user_id'];
            echo "success";
        } else {
            // Incorrect password
            echo "invalid_password";
        }
    } else {
        // Email not found
        echo "invalid_email";
    }
    $stmt->close();
}
$conn->close();
?>
