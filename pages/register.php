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
            <form class="login-form" action="../src/register.php" method="post"> <!-- Updated action -->
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
                
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" class="btn btn-primary">Register</button>
            
                <p>Already have an account? <a href="../pages/login.php">Log in here</a></p>
            </form>
        </div>
    </div>
</main>

<?php
include_once("../includes/footer.php");
?>