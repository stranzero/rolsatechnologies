<?php
include_once("../includes/header.php");


// energyUsageData = [
    //     {
    //         date: '2021-09-01',
    //         energyUsage: 65
    //     },
    //     {
    //         date: '2021-09-02',
    //         energyUsage: 59
    //     },
    //     ...
    // ]
class EnergyUsageData
{
    public $date;
    public $energyUsage;

    public function __construct($date, $energyUsage)
    {
        $this->date = $date;
        $this->energyUsage = $energyUsage;
    }
}
// Temporary Data for Energy Usage - This will be replaced by data from mysql database when we implement it
$Data1 = new EnergyUsageData('2021-09-01', 65);
$Data2 = new EnergyUsageData('2021-09-02', 59);
$Data3 = new EnergyUsageData('2021-09-03',20);

$energyUsageData = array($Data1, $Data2, $Data3);
// send data to local storage
echo "<script>localStorage.setItem('energyUsageData', JSON.stringify(" . json_encode($energyUsageData) . "))</script>";


?>

<main class="container">
    <section class="page-header">
        <h1>Energy Usage Calculator</h1>
        <p>Track and Calculate your Energy Usage.</p>
    </section>

    <div class="grid-container">
        <div class="grid-item small">
            <h2>Total Energy Usage</h2>
            <p id="total-energy-usage">0kWh</p>
        </div>

        <div class="grid-item small">
            <h2>Total Money Saved</h2>
            <p id="total-money-saved">£0.00</p>
        </div>

       <div class="grid-item small">
            <form action="<?php echo $base_path; ?>src/energyusagecalculator.php" method="post">
                <h2>Input Energy Usage</h2>
                <input type="number" id="energy-usage" placeholder="Enter Energy Usage (kWh)">
                <button id="add-energy-usage" class="btn btn-primary" type="submit">Add</button>
            </form>
        </div>

        <div class="grid-item small">
            <h2>Energy Usage History</h2>
            <!-- Chart will be added here -->
            <canvas id="energy-usage-chart"></canvas>
        </div>
    </div>
</main>
<?php
include_once("../includes/footer.php"); ?>