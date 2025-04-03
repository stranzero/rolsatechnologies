<?php
include_once("db.php");
session_start();

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

session_unset();
session_destroy();

header("Location: ../pages/login.php?message=You have been logged out successfully.");
exit;
?>