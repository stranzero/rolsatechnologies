<?php
include_once("../includes/header.php");
include_once("../src/db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// we check here if the user is logged in
if (!isset($_SESSION["UserID"])) {
    error_log("UserID is not set in the session. Redirecting to login.");
    header("Location: ../pages/login.php");
    exit;
}

$userID = $_SESSION["UserID"];
?>

<main class="container">
    <section class="page-header">
        <h1>Schedule Consultation/Installation</h1>
        <p>Manage your schedule and appointments.</p>
    </section>

    <section class="schedule-section">
        <div class="grid-container">
            <div class="grid-item small">
                <form class="schedule-form" action="<?php echo $base_path; ?>src/schedule.php" method="post">
                    <h2>Schedule Consultation</h2>
                    <h3>Type and Availability</h3>
                    <h4>Appointment Type</h4>
                    <select name="appointment-type" id="appointment-type">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option value="consultation">Consultation</option>
                        <option value="installation">Installation</option>
                    </select>
                    <h4>Date</h4>
                    <input type="date" id="appointment-date" name="appointment-date" required>
                    <h4>Address</h4>
                        <input type="text" name="address" placeholder="Enter your address">
                        <h4>City</h4>
                        <input type="text" name="city" placeholder="Enter your city">
                        <h4>Postcode</h4>
                        <input type="text" name="postcode" placeholder="Enter your postcode">

                    <!-- Consultation Questions -->
                    <div id="consultation-questions" style="display: none;">
                        <h4>Consultation Details</h4>
                        <textarea name="consultation-details" placeholder="Provide details about the consultation" rows="4"></textarea>
                    </div>

                    <!-- Installation Questions -->
                    <div id="installation-questions" style="display: none;">
                        <h4>Installation Details</h4>
                        <textarea name="installation-details" placeholder="Provide details about the installation" rows="4"></textarea>
                    </div>

                    <button id="schedule-consultation" class="btn btn-primary">Schedule</button>
                </form>
            </div>
            <div class="grid-item small">
                <h2>Upcoming Appointments</h2>
                <ul id="upcoming-appointments">
                    <h3>Installation</h3>
                    <?php
                    // check for any installation appointments
                    $sql = "SELECT * FROM installation WHERE UserID = ? AND Completed = 0";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()) {
                        echo "<li>Installation on " . $row['InstallationDate'] . " at " . $row['InstallationAddress'] . "<form action='../src/cancel_appointment.php' method='post'><input type='hidden' name='installationID' value='" . $row['InstallationID'] . "'><button type='submit' class='btn btn-secondary'>Cancel</button></form></li>";
                    }
                    // we check here if there are any results and if not then we will display this message so that it doesnt look ew
                    if ($result->num_rows == 0) {
                        echo "<li>No upcoming installation appointments.</li>";
                    }

                    $stmt->close();
                    ?>
                    <h3>Consultation</h3>
                    <?php
                    // check for any consultation appointments
                    $sql = "SELECT * FROM consultation WHERE UserID = ? AND Completed = 0";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()) {
                        echo "<li>Consultation on " . $row['ConsultationDate'] . " at " . $row['ConsultationAddress'] . "<form action='../src/cancel_appointment.php' method='post'><input type='hidden' name='consultationID' value='" . $row['ConsultationID'] . "'><button type='submit' class='btn btn-secondary'>Cancel</button></form></li>";
                    }

                    if ($result->num_rows == 0) {
                        echo "<li>No upcoming Consultation appointments.</li>";
                    }
                    $stmt->close();
                    ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<script> // we put this here as its better to just do it here instead of in the main.js file (makes it easier to execute)
    const futureDate = new Date();
    futureDate.setDate(futureDate.getDate() + 3);
    const futureDateString = futureDate.toISOString().split('T')[0];
    document.getElementById('appointment-date').setAttribute('min', futureDateString);
</script>

<?php
include_once("../includes/footer.php");
?>