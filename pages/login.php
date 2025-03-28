<?php
include_once("../includes/header.php");
?>

<main class="container">
    <section class="page-header">
        <h1>Login</h1>
        <p>Calculate your energy usage as well as your carbon footprint.</p>
    </section>

    <div class="login-gridcontainer">
        <div class="login-griditem">
            <h2>Log in</h2>
            <form class="login-form" action="<?php echo $base_path; ?>src/login.php" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
            <p>Don't have an account? <a href="<?php echo $base_path; ?>pages/register.php">Register here</a></p>
    </div>
</main>
<?php
include_once("../includes/footer.php"); ?>