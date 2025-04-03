<?php
include_once("db.php");
session_start();

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

// Clear data from the energyusage table
$sql_energy = "DELETE FROM energyusage WHERE UserID = ?";
$stmt_energy = $conn->prepare($sql_energy);
$stmt_energy->bind_param("i", $_SESSION["UserID"]);
$stmt_energy->execute();

// Clear data from the carbonfootprint table
$sql_carbon = "DELETE FROM carbonfootprint WHERE UserID = ?";
$stmt_carbon = $conn->prepare($sql_carbon);
$stmt_carbon->bind_param("i", $_SESSION["UserID"]);
$stmt_carbon->execute();

// Close prepared statements
$stmt_energy->close();
$stmt_carbon->close();

echo "<script>
    localStorage.clear();
    alert('Data cleared successfully.');
</script>";

// Redirect back to the account page
header("Location: ../pages/account.php");
exit;
?>
