<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Register</h1>
        <p>Create a new account to start tracking your energy usage and carbon footprint.</p>
    </section>

    <div class="login-gridcontainer">
        <div class="login-griditem">
            <h2>Register</h2>
            <form class="login-form" action="<?php echo $base_path; ?>src/register.php" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn btn-primary">Register</button>
            
                <p>Already have an account? <a href="<?php echo $base_path; ?>pages/login.php">Log in here</a></p>
    </div>
</main>
<?php
include_once("../includes/footer.php"); ?>