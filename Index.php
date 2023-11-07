<?php
require('./partials/header.php');
require('./partials/navbar.php');
require('./partials/footer.php');

print($header);
?>

<body>
    <header>
        <?php print($indexPageNav);
        ?>
    </header>

    <!-- Hero Section -->
    <div class="jumbotron text-center  align-items-center">
        <div class="container">
            <div class="row">
                <div class="col" id="logoContainer">
                    <img src="../resources/logo.png" alt="Pharmacy Logo" style= "object-fit: contain;">
                </div>
            </div>
            <h1>Welcome to Your Own Pharmacy</h1>
            <p>Your health is our priority.</p>
        </div>
        <div class="container-fluid m-2">
            <div class="row my-5">
                <div class="col-md-4">
                    <i class="bi bi-heart feature-icon"></i>
                    <h2 class="feature-heading">Quality Products</h2>
                    <p class="feature-description">We provide a wide range of high-quality pharmaceutical products.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-clock feature-icon"></i>
                    <h2 class="feature-heading">Fast Services</h2>
                    <p class="feature-description">Our dedicated team ensures quick and efficient service.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-phone feature-icon"></i>
                    <h2 class="feature-heading">Customer Support</h2>
                    <p class="feature-description">Our support team is available 24/7 to assist you.</p>
                </div>
                <div class="span3 mt-2 mb-5">
                    <a href="../views/login.php" class="btn btn-primary">Explore Products</a>
                </div>
            </div>
        </div>

    </div>


    <!-- Featured Products Section -->
    <div id="featuredProduct" class="container text-center mt-5">
        <h2>Featured Products</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card h-100 ">
                    <img src="./resources/tablet1.jpg" class="card-img-top" alt="Product 1" style = "object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Pain Relief Tablets</h5>
                        <p class="card-text">Effective pain relief tablets for various types of pain.</p>
                        <p class="card-text">Price: $12.99</p>
                        <div class="span2">
                            <a href="../views/login.php" class="btn btn-primary mt-auto ">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 ">
                    <img src="./resources/tablet2.png" class="card-img-top" alt="Product 2"  style = "object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Vitamin C Supplements</h5>
                        <p class="card-text">Boost your immune system with our high-quality Vitamin C supplements.</p>
                        <p class="card-text">Price: $9.99</p>
                        <div class="span2">
                            <a href="../views/login.php" class="btn btn-primary mt-auto">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 ">
                    <img src="./resources/tablet3.jpg" class="card-img-top" alt="Product 3"   style = "object-fit: contain;" >
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Allergy Relief Spray</h5>
                        <p class="card-text">Fast-acting allergy relief nasal spray for seasonal allergies.</p>
                        <p class="card-text">Price: $8.49</p>
                        <div class="span2">
                            <a href="../views/login.php" class="btn btn-primary mt-auto">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span2 p-3">
                <a href="../views/login.php" class="btn btn-primary">Explore Products</a>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="container text-center mt-5" id="services">
        <h2>Our Services</h2>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-calendar-check service-icon"></i>
                        <h5 class="card-title">Online Medicine Booking</h5>
                        <p class="card-text">Easily book your medicines online from the comfort of your home.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-truck service-icon"></i>
                        <h5 class="card-title">One Day Delivery</h5>
                        <p class="card-text">Get your medicines delivered to your doorstep within 24 hours.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-chat-dots service-icon"></i>
                        <h5 class="card-title">Expert Consultation</h5>
                        <p class="card-text">Consult with our expert pharmacists for personalized advice and
                            recommendations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-heart service-icon"></i>
                        <h5 class="card-title">Health & Wellness Products</h5>
                        <p class="card-text">Explore a wide range of health and wellness products for a healthier
                            lifestyle.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-file-prescription service-icon"></i>
                        <h5 class="card-title">Prescription Refills</h5>
                        <p class="card-text">Easily refill your prescriptions online for added convenience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-shield-check service-icon"></i>
                        <h5 class="card-title">Privacy & Security</h5>
                        <p class="card-text">Rest assured with our secure and private online pharmacy experience.</p>
                    </div>
                </div>
            </div>
            <!-- Add more service cards here -->
        </div>
    </div>
    <!-- Contact Section -->
    <div id="contactusdiv" class="container text-center mt-5">
        <?php
        
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success mt-3" id = "success-alert">Message sent successfully.</div>';
        }
        ?>
        <h2>Contact Us</h2>
        <p>We'd love to hear from you. Feel free to get in touch!</p>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="./views/save_contact_us_form.php" method="post" name="contact-us-form">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Your Name" name="username">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Your Email" name="email">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" placeholder="Your Phone Number" name="phone">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Your Message" name="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    <button class="back-to-top" onclick="scrollToTop()">
        &#9650;
    </button>
    <?php print ($commonFooterForHome)?>
    <script>
        window.addEventListener("scroll", function () {
            var backToTopButton = document.querySelector(".back-to-top");
            if (window.scrollY > 300) {
                backToTopButton.classList.add("show");
            } else {
                backToTopButton.classList.remove("show");
            }
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
        successAlert.style.display = 'block';
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 2000); // Display for 2 seconds
}
    </script>
</body>