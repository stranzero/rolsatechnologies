<?php
include_once("../includes/header.php");

$totalCarbonFootprint = 0;
$carbonTrajectory = +0;

// carbonFootprintHistory = [
    //     {
    //         date: '2021-09-01',
    //         emissions: 65
    //     },
    //     {
    //         date: '2021-09-02',
    //         emissions: 59
    //     },
    //     ...
    // ]
class CarbonFootprintData
{
    public $date;
    public $emissions;

    public function __construct($date, $emissions)
    {
        $this->date = $date;
        $this->emissions = $emissions;
    }
}
// Temporary Data for Carbon Footprint - This will be replaced by data from mysql database when we implement it
$Data1 = new CarbonFootprintData('2021-09-01', 65);
$Data2 = new CarbonFootprintData('2021-09-02', 59);
$Data3 = new CarbonFootprintData('2021-09-03',20);

$carbonFootprintData = array($Data1, $Data2, $Data3);
// send data to local storage
echo "<script>localStorage.setItem('carbonFootprintData', JSON.stringify(" . json_encode($carbonFootprintData) . "))</script>";
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
            <p id="trajectory"><?php echo $carbonTrajectory; ?>%</p>
        </div>
        <div class="grid-item small">
            <div class="scrollcontainer-wrapper">
                <h2>Input Emissions</h2>
                <div class="scrollcontainer">
                    <form action="<?php echo $base_path; ?>src/carboncalculator.php" method="post">
                        <h3>Electricity</h3>
                        <input type="number" id="electricity-emissions" placeholder="Enter Electricity Emissions (kg CO2e)">
                        <h3>Transport</h3>
                        <input type="number" id="transport-emissions" placeholder="Enter Transport Emissions (kg CO2e)">
                        <h3>Food</h3>
                        <input type="number" id="food-emissions" placeholder="Enter Food Emissions (kg CO2e)">
                        <h3>Waste</h3>
                        <input type="number" id="waste-emissions" placeholder="Enter Waste Emissions (kg CO2e)">
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
</main>
<?php
include_once("../includes/footer.php"); ?>