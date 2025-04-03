<?php
include_once("db.php");
session_start();

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

$installationID = $_POST['installationID'] ?? null;
$consultationID = $_POST['consultationID'] ?? null;

$userID = $_SESSION["UserID"];

if ($installationID != null) {
    $sql = "SELECT * FROM installation WHERE InstallationID = ? AND UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $installationID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM installation WHERE InstallationID = ? AND UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $installationID, $userID);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../pages/schedule.php?success=Installation appointment cancelled successfully.");
            exit;
        } else {
            $stmt->close();
            die("Error deleting record: " . $stmt->error);
        }
    } else {
        $stmt->close();
        header("Location: ../pages/schedule.php?error=Invalid installation appointment.");
        exit;
    }
} elseif ($consultationID != null) {
    $sql = "SELECT * FROM consultation WHERE ConsultationID = ? AND UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $consultationID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM consultation WHERE ConsultationID = ? AND UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $consultationID, $userID);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../pages/schedule.php?success=Consultation appointment cancelled successfully.");
            exit;
        } else {
            $stmt->close();
            die("Error deleting record: " . $stmt->error);
        }
    } else {
        $stmt->close();
        header("Location: ../pages/schedule.php?error=Invalid consultation appointment.");
        exit;
    }
} else {
    header("Location: ../pages/schedule.php?error=No appointment ID provided.");
    exit;
}