<?php
include_once("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Validate input
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    $stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, EmailAddress, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

    if ($stmt->execute()) {
        // Get the inserted UserID
        $userID = $stmt->insert_id;

        // Sets the UserID as a session variable for the user so that they can be tracked
        $_SESSION["UserID"] = $userID;

        // we are going to clear local storage so that the user can start fresh just in case they have any data in there
        echo "<script>
        localStorage.clear();
        </script>";

        // Close the statement and connection before redirecting
        $stmt->close();
        $conn->close();

        // Redirect to account page
        header("Location: ../pages/account.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
} 
?>