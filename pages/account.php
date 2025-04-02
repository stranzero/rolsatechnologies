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
            <div class="grid-item">
                <h2>Carbon Reduction</h2>
                <p id="trajectory">0 kg</p>
            </div>
            <div class="grid-item">
                <h2>Money Saved</h2>
                <p id="total-money-saved">£0.00</p>
            </div> 
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