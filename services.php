<!-- services.php -->
<?php
    // Connect to database
    include 'database.php';
    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    // Get services query
    $services_sql = "SELECT * FROM services WHERE 1=1";
    // Apply filters
    if (!empty($_GET['service_type'])) {
        $service_type = $conn->real_escape_string($_GET['service_type']);
        if ($_GET['service_type'] == "relaxation") {
            $services_sql .= " AND service_name IN ('Chair Massage', 'Couple\'s Massage', 'Swedish Massage')";
        } else {
            $services_sql .= " AND service_name IN ('Sports Massage', 'Trigger Point Therapy', 'Deep Tissue Massage')";
        }
    }
    if (!empty($_GET['min_price'])) {
        $min_price = $conn->real_escape_string($_GET['min_price']);
        $services_sql .= " AND price >= $min_price";
    }
    if (!empty($_GET['max_price'])) {
        $max_price = $conn->real_escape_string($_GET['max_price']);
        $services_sql .= " AND price <= $max_price";
    }
    if (!empty($_GET['duration'])) {
        $duration = $conn->real_escape_string($_GET['duration']);
        $services_sql .= " AND duration = $duration";
    }
    // Apply sorting
    $orderBy = "service_name ASC"; // Default sorting is alphabetical
    if (!empty($_GET['sort'])) {
        if ($_GET['sort'] == 'price') {
            $orderBy = "price ASC";
        } elseif ($_GET['sort'] == 'duration') {
            $orderBy = "duration ASC";
        } elseif ($_GET['sort'] == 'popularity') {
            $orderBy = "service_name ASC"; //How do we do this popularity filter bruuuh
        }
    }
?>

<!-- services frontend -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Libre Caslon Text Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="images/logo_favicon.png">
    <!-- For Apple devices -->
    <link rel="apple-touch-icon" href="images/logo_favicon.png">
</head>
<body>
    <?php
        // Start session to get logged-in user data
        session_start();
    ?>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-dark py-3">
        <div class="container">
            <a class="brand-name" href="#">Lotus Serenity Spa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a id="home-services" class="nav-link" href="index.php">Home</a></li>
                <!-- <li class="nav-item"><a id="smooth-services" class="nav-link" href="index.php#services-section">Services</a></li> -->
                <li class="nav-item"><a id="smooth-services" class="nav-link-active" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking.php">Book Now</a></li>

                    <!-- Conditional Links Based on Login Status -->
                    <?php
                    if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="text-gold nav-link" href="dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Display services -->
    <h2>Services</h2>

    <br> <br>

   <!-- Filter Form; Just an experiment -->
    <form method="GET" action="services.php" class="services-form ">
        <label for="service_type">Service Type:</label>
        <select name="service_type" id="service_type">
            <option value="">All</option>
            <option value="relaxation" <?= ($_GET['service_type'] ?? '') == 'relaxation' ? 'selected' : '' ?>>Relaxation Massages</option>
            <option value="therapeutic" <?= ($_GET['service_type'] ?? '') == 'therapeutic' ? 'selected' : '' ?>>Therapeutic Massages</option>
        </select>
        <br>
        <div class="price-filter">
            <label for="min_price">Min Price:</label>
            <input type="number" name="min_price" id="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '350') ?>">

            <label for="max_price">Max Price:</label>
            <input type="number" name="max_price" id="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '950') ?>">
        </div>
        <label for="duration">Duration:</label>
        <select name="duration" id="duration">
            <option value="">All</option>
            <option value="60" <?= ($_GET['duration'] ?? '') == '60' ? 'selected' : '' ?>>60 Minutes</option>
            <option value="90" <?= ($_GET['duration'] ?? '') == '90' ? 'selected' : '' ?>>90 Minutes</option>
        </select>
        <br>
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="">Default</option>
            <option value="popularity" <?= ($_GET['sort'] ?? '') == 'popularity' ? 'selected' : '' ?>>Popularity</option>
            <option value="price" <?= ($_GET['sort'] ?? '') == 'price' ? 'selected' : '' ?>>Price</option>
            <option value="duration" <?= ($_GET['sort'] ?? '') == 'duration' ? 'selected' : '' ?>>Duration</option>
        </select>
        <br><br>
        <button type="submit">Apply Filters</button>
    </form>

    <br> <br>

    <!-- Service Cards -->
    <div class="container mt-5">
        <div class="row">
            <?php
                // Fetch data
                $services_sql .= " ORDER BY $orderBy";
                $services_result = $conn->query($services_sql);
                if ($services_result && $services_result->num_rows > 0) {
                    while ($row = $services_result->fetch_assoc()) {
                        echo "<div class='col-lg-4 col-md-6 mb-4'>";
                        echo "<div class='service-card'>";
                        echo "<h3 class='service-title'>" . htmlspecialchars($row['service_name']) . "</h3>";
                        echo "<p class='service-price'><strong>Price: </strong>" . htmlspecialchars($row['price']) . "</p>";
                        echo "<p class='service-duration'><strong>Duration: </strong>" . htmlspecialchars($row['duration']) . " mins</p>";
                        echo "<p class='service-description'>" . htmlspecialchars($row['description']) . "</p>";
                        // echo "<button class='btn btn-primary'>Book Now</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12'><p>No Services Found</p></div>";
                }
            ?>
        </div>
    </div>

    <br> <br>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <div class="footer-info">
                            <h3 class="brand-name">Lotus Serenity Spa</h3>
                            <p class="footer-desc">Where tranquility meets luxury. Experience the perfect blend of traditional techniques and modern wellness solutions.</p>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Baguio Country Club, Baguio City</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>+63 912 345 6789</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@lotusserenityspa.ph</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="col-lg-4">
                        <div class="quick-links">
                            <h4>Quick Links</h4>
                            <div class="links-grid">
                                <a href="#" class="link-item">
                                    <i class="fas fa-spa"></i>
                                    <span>Our Services</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Book Appointment</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-info-circle"></i>
                                    <span>About Us</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-gift"></i>
                                    <span>Gift Cards</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media & Newsletter -->
                    <div class="col-lg-4">
                        <div class="social-newsletter">
                            <h4>Connect With Us</h4>
                            <div class="social-links">
                                <a href="#" class="social-icon facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-icon twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-icon tiktok">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </div>
                            <div class="newsletter-signup">
                                <h5>Subscribe to Our Newsletter</h5>
                                <form class="newsletter-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright">© 2024 Lotus Serenity Spa. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-links">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navigation.js"></script>
</body>
</html>