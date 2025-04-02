<?php
include_once("db.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

$userID = $_SESSION["UserID"];

$sql = "DELETE FROM users WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->close();
$conn->close();


// clear local storage
echo "<script>
    localStorage.clear();
    window.location.href = '../pages/register.php?message=Account deleted successfully.';";
echo "</script>";
?>

