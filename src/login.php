<?php

// Get data from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Include the database connection file
include_once("db.php");
 
$sql = "SELECT * FROM users WHERE EmailAddress = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
if ($row) {
    // we need to unhash the password here as we hashed it when the user registered
    if (password_verify($password, $row['Password'])) {
        // Start session and set session variables
        session_start();
        $_SESSION['UserID'] = $row['UserID'];
        header("Location: ../pages/account.php");
        exit;
    } else {
        die("Invalid password.");
    }
} else {
    header("Location: ../pages/login.php?error=User not found.");
    exit;
}

?>