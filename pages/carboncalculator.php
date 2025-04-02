<?php
require_once("../includes/header.php");
require_once("../src/db.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    header("Location: ../pages/login.php");
    exit;
}

$userID = $_SESSION["UserID"];

// fetch AllRecords and the emissions from the database
$sql = "SELECT AllRecords, TotalEmissions FROM carbonfootprint WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$carbonFootprintData = [];
$totalCarbonFootprint = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $carbonFootprintData = json_decode($row['AllRecords'], true); // Decode JSON to PHP array
    $totalCarbonFootprint = $row['TotalEmissions'];
}

$stmt->close();
$conn->close();

// Pass the data to JavaScript so that the graph can be created
echo "<script>const carbonFootprintData = " . json_encode($carbonFootprintData) . ";</script>";
?>

<main class="container">
    <section class="page-header">
        <h1>Carbon Footprint Calculator</h1>
        <p>Track and Calculate your Carbon Footprint.</p>
    </section>

    <div class="grid-container">
        <div class="grid-item small">
            <h2>Total Emissions</h2>
            <p id="total-emissions"><?php echo $totalCarbonFootprint; ?> kg CO2e</p>
        </div>
        <div class="grid-item small">
            <h2>Trajectory</h2>
            <p id="trajectory">0%</p>
        </div>
        <div class="grid-item small">
            <div class="scrollcontainer-wrapper">
                <h2>Input Emissions</h2>
                <div class="scrollcontainer">
                    <form action="../src/carboncalculator.php" method="post">
                        <h3>Electricity</h3>
                        <input type="number" id="electricity-emissions" name="electricityEmissions" placeholder="Enter Electricity Emissions (kg CO2e)">
                        <h3>Transport</h3>
                        <input type="number" id="transport-emissions" name="transportEmissions" placeholder="Enter Transport Emissions (kg CO2e)">
                        <h3>Food</h3>
                        <input type="number" id="food-emissions" name="foodEmissions" placeholder="Enter Food Emissions (kg CO2e)">
                        <h3>Waste</h3>
                        <input type="number" id="waste-emissions" name="wasteEmissions" placeholder="Enter Waste Emissions (kg CO2e)">
                </div>
                <div class="scrollcontainer-actions">
                    <button id="add-emissions" class="btn btn-primary" type="submit">Add</button>
                    <button id="reset-emissions" class="btn btn-secondary" type="reset">Reset</button>
                </div>
                </form>
            </div>
        </div>
        <div class="grid-item small">
            <h2>Emissions History</h2>
            <!-- Chart will be added here -->
            <canvas id="emissions-chart"></canvas>
        </div>
    </div>
</main>

<script>
    // Save carbonFootprintData to local storage
    if (carbonFootprintData) {
        localStorage.setItem('carbonFootprintData', JSON.stringify(carbonFootprintData));
    }

    console.log('Saved to localStorage:', JSON.parse(localStorage.getItem('carbonFootprintData')));
</script>

<?php
include_once("../includes/footer.php");
?>