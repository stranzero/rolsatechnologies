<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Calculate your impact/usage</h1>
        <p>Calculate your energy usage as well as your carbon footprint.</p>
    </section>

    <div class="grid-container">
        <div class="grid-item large">
            <h2>Calculate your Carbon Footprint</h2>
            <p>Calculate your carbon footprint based on your energy usage, transportation, and lifestyle choices.</p>
            <p>Find out how you can reduce your carbon footprint and live a more sustainable life.</p>
            <a href="<?php echo $base_path; ?>pages/carboncalculator.php" class="btn btn-primary">Calculate Now</a>
        </div>

        <div class="grid-item large">
            <h2>Calculate your Energy Usage</h2>
            <p>Calculate your energy usage based on your appliances, heating, cooling, and lighting.</p>
            <p>You can also track this usage over time to see how you can reduce your energy consumption.</p>
            <a href="<?php echo $base_path; ?>pages/energyusagecalculator.php" class="btn btn-primary">Track Now</a>
        </div>
    </div>