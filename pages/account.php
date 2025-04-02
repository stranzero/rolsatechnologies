<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Account</h1>
        <p>Manage your account settings and preferences.</p>
    </section>

    <section class="account-section">
        <div class="grid-container">
            <!-- Top row with 3 columns -->
            <div class="grid-item">
                <h2>Energy Saved</h2>
                <p id="energy-saved">0 kWh</p>
            </div>
            <div class="grid-item">
                <h2>Carbon Reduction</h2>
                <p id="carbon-reduction">0 kg</p>
            </div>
            <div class="grid-item">
                <h2>Money Saved</h2>
                <p id="total-money-saved">£0.00</p>
            </div>
            <!-- Second row with 2 columns -->
            <div class="grid-item">
                <h2>Installation Schedule/History</h2>
                <p id="installation-history">No installations scheduled.</p>
            </div>
            <div class="grid-item">
                <h2>Consultation Schedule/History</h2>
                <p id="consultation-history">No consultations scheduled.</p>
            </div>
        </div>
    </section>
</main>

<?php
include_once("../includes/footer.php");
?>