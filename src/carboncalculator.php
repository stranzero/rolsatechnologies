<?php
include_once("db.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

// Get form details
$electricityEmissions = $_POST['electricityEmissions'] ?? 0;
$transportEmissions = $_POST['transportEmissions'] ?? 0;
$foodEmissions = $_POST['foodEmissions'] ?? 0;
$wasteEmissions = $_POST['wasteEmissions'] ?? 0;

$totalEmissions = $electricityEmissions + $transportEmissions + $foodEmissions + $wasteEmissions;

// Validate input
if ($totalEmissions <= 0) {
    die("Total emissions must be greater than zero.");
}

// Get the user ID from the session
$userID = $_SESSION["UserID"];

// Check if there is a record for the user in the carbon table
$sql = "SELECT * FROM carbonfootprint WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $row = $result->fetch_assoc();
    $totalCarbonFootprint = $row['TotalEmissions'] + $totalEmissions;

    // we are going to decode the existing AllRecords JSON so we can add the new record to it
    $allRecords = json_decode($row['AllRecords'], true);
    if (!is_array($allRecords)) {
        $allRecords = [];
    }

    // Add new record to AllRecords
    $allRecords[] = [
        'date' => date('Y-m-d'),
        'emissions' => $totalEmissions
    ];

    // Encode AllRecords back to JSON for the database
    $allRecordsJson = json_encode($allRecords);

    // Update the database 
    $updateSql = "UPDATE carbonfootprint SET TotalEmissions = ?, AllRecords = ? WHERE UserID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("isi", $totalCarbonFootprint, $allRecordsJson, $userID);
    if ($updateStmt->execute()) {
        $updateStmt->close();
        $stmt->close();
        $conn->close();
        header("Location: ../pages/carboncalculator.php");
        exit;
    } else {
        $stmt->close();
        $conn->close();
        die("Error updating record: " . $updateStmt->error);
    }
} else {
    // Insert new record if no record exists
    $allRecords = [
        [
            'date' => date('Y-m-d'),
            'emissions' => $totalEmissions
        ]
    ];
    $allRecordsJson = json_encode($allRecords);

    $insertSql = "INSERT INTO carbonfootprint (UserID, TotalEmissions, AllRecords) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iis", $userID, $totalEmissions, $allRecordsJson);
    if ($insertStmt->execute()) {
        $insertStmt->close();
        $stmt->close();
        $conn->close();
        header("Location: ../pages/carboncalculator.php");
        exit;
    } else {
        $stmt->close();
        $conn->close();
        die("Error inserting record: " . $insertStmt->error);
    }
}
?>

