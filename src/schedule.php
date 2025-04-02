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

// get the deets from the form

$type = $_POST['appointment-type'];

if (empty($type)) {
    header('Location: ../pages/schedule.php?error=Please select an appointment type.');
    exit;
}