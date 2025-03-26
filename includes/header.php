<?php
// Include Config File
require_once dirname(__DIR__ ) ."/config.php";

// Redefine Site Constants
$site_name = SITE_NAME;
$site_description = SITE_DESCRIPTION;

$base_path = getBasePath();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add CSS -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/styles.css">
    <!-- Add Chart.js for graph visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add Font Awesome for better icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title><?php echo $site_name; ?></title>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="site-logo">
                <a href="<?php echo $base_path; ?>index.php">
                    <h1><i class="fas fa-leaf"></i><?php echo $site_name; ?></h1>
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?php echo $base_path;?>pages/lowercarbon.php"><i class="fa-solid fa-seedling"> Lower Carbon Footprint</i></a></li>
                    <li><a href="<?php echo $base_path;?>pages/greenproducts.php"><i class="fa-solid fa-solar-panel"> Green Products</i></a></li>
                    <li><a href="<?php echo $base_path;?>pages/calculatelanding.php"><i class="fa-solid fa-calculator"> Calculate</i></a></li>
                </ul>
            </nav>
            <div class="header-actions">
            <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark/light mode">
            <span class="theme-toggle-icon"><i class="fas fa-sun"></i></span>
                </button>
                <a href="<?php echo $base_path; ?>pages/account.php" class="account-icon">
                    <span class="icon"><i class="fas fa-user"></i></span>
                </a>
                <a href="<?php echo $base_path; ?>pages/schedule.php" class="btn btn-primary">
                    <i class="fas fa-tools"></i> Schedule an Appointment
                </a>
            </div>
        </div>
    </header>
    <script>
        // Light and Dark Mode
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = themeToggle.querySelector('.theme-toggle-icon i');
            const htmlElement = document.documentElement;
            
            const savedTheme = localStorage.getItem('theme') || 'dark';
            htmlElement.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);
            
            themeToggle.addEventListener('click', function() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });
            
            // Update icon based on current theme
            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.className = 'fas fa-sun';
                } else {
                    themeIcon.className = 'fas fa-moon';
                }
            }
        });
    </script>    
</body>
</html>


