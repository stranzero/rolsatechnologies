<?php
include_once("../includes/header.php");
session_start();
// we check here if the user is logged in
if (isset($_SESSION["UserID"])) {
    $userID = $_SESSION["UserID"];
} else {
    header("location: login.php");
    exit;
}
?>
    

<main class="container">
    <section class="page-header">
        <h1>Account</h1>
        <p>Manage your account settings and preferences.</p>
    </section>

    <section class="account-section">
        <div class="grid-container">
            <div class="grid-item">
                <h2>Personal Carbon Trajectory</h2>
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
            <div class="grid-item">
                <h2>Account Functions</h2>
                <p><a href="../src/delete_account.php" class="btn btn-primary">Delete Account</a></p>
                <p><a href="../src/logout.php" class="btn btn-secondary">Logout</a></p>
                <p><a href="../src/clear_data.php" class="btn btn-secondary">Clear Data</a></p>
            </div>
        </div>
    </section>
</main>

<?php
include_once("../includes/footer.php");
?>