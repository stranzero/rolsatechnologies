<?php
include_once("db.php");
session_start();

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    header("Location: ../pages/login.php");
    exit;
}

$userID = $_SESSION["UserID"];

// Get the details from the form
$type = $_POST['appointment-type'];
$date = $_POST['appointment-date'];

$address = trim($_POST['address']);
$city = trim($_POST['city']);
$postcode = trim($_POST['postcode']);

// check whether an adress and city have been provided
if (empty($address) || empty($city)) {
    header('Location: ../pages/schedule.php?error=Address and city are required.');
    exit;
}

// Format the address for the database
$formatted_address = $address . ", " . $city;

if (empty($type)) {
    header('Location: ../pages/schedule.php?error=Please select an appointment type.');
    exit;
}

if ($type === 'installation') {
    $details = $_POST['installation-details'];

    // Add new record to the installation table
    $sql = "INSERT INTO installation (UserID, InstallationDate, InstallationAddress, Postcode, InstallationDetails, Completed) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $userID, $date, $formatted_address, $postcode, $details);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../pages/schedule.php?success=Installation scheduled successfully.");
        exit;
    } else {
        $stmt->close();
        die("Error inserting record: " . $stmt->error);
    }
} elseif ($type === 'consultation') {
    $details = $_POST['consultation-details'];

    // Add new record to the consultation table
    $sql = "INSERT INTO consultation (UserID, ConsultationDate, ConsultationAddress, Postcode, ConsultationDetails, Completed) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $userID, $date, $formatted_address, $postcode, $details);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../pages/schedule.php?success=Consultation scheduled successfully.");
        exit;
    } else {
        $stmt->close();
        die("Error inserting record: " . $stmt->error);
    }
} else {
    // Invalid appointment type
    header('Location: ../pages/schedule.php?error=Invalid appointment type selected.');
    exit;
}
?>