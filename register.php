<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $user_type = 'customer'; // Default value for user type

    // Check if email already exists
    $checkEmailQuery = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists
        echo "email_exists";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $username, $email, $password, $user_type);

        if ($stmt->execute()) {
            // Registration successful
            echo "success";
        } else {
            // Registration failed
            echo "failure";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
