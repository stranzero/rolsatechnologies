<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Energy Usage Calculator</h1>
        <p>Track and Calculate your Energy Usage.</p>
    </section>

    <div class="grid-container">
        <div class="grid-item small">
            <h2>Total Energy Usage</h2>
            <p id="total-energy-usage">0 kWh</p>
        </div>

        <div class="grid-item small">
            <h2>Total Money Saved</h2>
            <p id="total-money-saved">£0</p>
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