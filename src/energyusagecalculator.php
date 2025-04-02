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
$energyUsage = $_POST['energyUsage'];

// Validate input
if (empty($energyUsage)) {
    die("Energy usage is required.");
}
if (!is_numeric($energyUsage)) {
    die("Energy usage must be a number.");
}
if ($energyUsage < 0) {
    die("Energy usage cannot be negative.");
}

// Get the user ID from the session
$userID = $_SESSION["UserID"];

// Check if there is a record for the user in the energyusage table
$sql = "SELECT * FROM energyusage WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $row = $result->fetch_assoc();
    $totalUsage = $row['TotalUsage'] + $energyUsage;

    // Decode existing AllRecords JSON
    $allRecords = json_decode($row['AllRecords'], true);
    if (!is_array($allRecords)) {
        $allRecords = [];
    }

    // Add new record to AllRecords
    $allRecords[] = [
        'date' => date('Y-m-d'),
        'energyUsage' => $energyUsage
    ];

    // Make the AllRecords JSON string
    $allRecordsJson = json_encode($allRecords);

    // Update the database
    $updateSql = "UPDATE energyusage SET TotalUsage = ?, AllRecords = ? WHERE UserID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("isi", $totalUsage, $allRecordsJson, $userID);
    if ($updateStmt->execute()) {
        $updateStmt->close();
        $stmt->close();
        header("Location: ../pages/energyusagecalculator.php");
        exit;
    } else {
        die("Error updating record: " . $updateStmt->error);
    }
} else {
    // Insert the new record
    $allRecords = [
        [
            'date' => date('Y-m-d'),
            'energyUsage' => $energyUsage
        ]
    ];
    $allRecordsJson = json_encode($allRecords);

    $insertSql = "INSERT INTO energyusage (UserID, TotalUsage, AllRecords) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iis", $userID, $energyUsage, $allRecordsJson);
    if ($insertStmt->execute()) {
        $insertStmt->close();
        $stmt->close();
        $conn->close();
        header("Location: ../pages/energyusagecalculator.php");
        exit;
    } else {
        die("Error inserting record: " . $insertStmt->error);
    }
}
?>