<?php
// include the navigation bar
include_once("includes/header.php");
?>

<!-- Content -->
<main class="container">
    <section class="hero-section">
        <div class="grid-container">
            <div class="grid-item large">
                <h2>Sustainable Energy Solutions</h2>
                <p>At Rolsa, we're committed to providing green energy solutions that help reduce your carbon footprint and save you money.</p>
                <p>Our range of products includes solar panels, wind turbines, energy storage systems, and smart home technology.</p>
                <a href="<?php echo $base_path; ?>pages/greenproducts.php" class="btn btn-primary">Explore Products</a>
            </div>
            
            <div class="grid-item small">
                <h3>Lower your Carbon Footprint</h3>
                <p>Discover ways to reduce your carbon footprint and live a more sustainable life.</p>
                <a href="<?php echo $base_path; ?>pages/lowercarbon.php" class="btn btn-primary">Learn More</a>
            </div>

            <div class="grid-item small">
                <h3>Calculate</h3>
                <p>Calculate your energy usage as well as your carbon footprint.</p>
                <a href="<?php echo $base_path; ?>pages/calculatelanding.php" class="btn btn-primary    ">Calculate Now</a>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-carousel">
            <!-- they will be added dynamically -->
        </div>
    </section>
</main>