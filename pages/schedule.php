<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Schedule Consultation/Installation</h1>
        <p>Manage your schedule and appointments.</p>
    </section>

    <section class="schedule-section">
        <div class="grid-container">
            <div class="grid-item small">
                <form action="<?php echo $base_path; ?>src/schedule.php" method="post">
                    <h2>Schedule Consultation</h2>
                    <h3>Type and Availability</h3>
                    <h4>Appointment Type</h4>
                    <select name="appointment-type" id="appointment-type">
                        <option value="consultation">Consultation</option>
                        <option value="installation">Installation</option>
                    </select>
                    <h4>Date</h4>
                    <input type="date" name="appointment-date" id="appointment-date">
                    <!-- Add the rest using JavaScript -->
                    <button id="schedule-consultation" class="btn btn-primary">Schedule</button>
                </form>
            </div>
        </div>
    </section>