<?php
include_once("../includes/header.php");
require_once("../src/db.php");
session_start();

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    header("Location: ../pages/login.php");
    exit;
}

$userID = $_SESSION["UserID"];

// Fetch AllRecords from the database
$sql = "SELECT AllRecords, TotalUsage FROM energyusage WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$energyUsageData = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $energyUsageData = json_decode($row['AllRecords'], true); // Decode JSON to PHP array
    $totalUsage = $row['TotalUsage'];
}

$stmt->close();
$conn->close();

$totalUsage = $totalUsage ?? 0; // Default to 0 if not set
// Pass the data to JavaScript to update the table
echo "<script>const energyUsageData = " . json_encode($energyUsageData) . ";</script>";
?>

<main class="container">
    <section class="page-header">
        <h1>Energy Usage Calculator</h1>
        <p>Track and Calculate your Energy Usage.</p>
    </section>

    <div class="grid-container">
        <div class="grid-item small">
            <h2>Total Energy Usage</h2>
            <p id="total-energy-usage"><?php echo $totalUsage; ?> kWh</p>
        </div>

        <div class="grid-item small">
            <h2>Total Money Saved</h2>
            <p id="total-money-saved">£0.00</p>
        </div>

        <div class="grid-item small">
            <form action="../src/energyusagecalculator.php" method="post">
                <h2>Input Energy Usage</h2>
                <input type="number" id="energy-usage" name="energyUsage" placeholder="Enter Energy Usage (kWh)">
                <button id="add-energy-usage" class="btn btn-primary" type="submit">Add</button>
            </form>
        </div>

        <div class="grid-item small">
            <h2>Energy Usage History</h2>
            <!-- Chart will be added here in javascript cuz we gonna use chart.js -->
            <canvas id="energy-usage-chart"></canvas>
        </div>
    </div>
</main>

<script>
    // Save energyUsageData to local storage
    if (energyUsageData) {
        localStorage.setItem('energyUsageData', JSON.stringify(energyUsageData));
    }
    console.log('Saved to localStorage:', JSON.parse(localStorage.getItem('energyUsageData')));
</script>

<?php
include_once("../includes/footer.php");
?>