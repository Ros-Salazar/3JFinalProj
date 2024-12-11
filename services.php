<!-- services.php -->




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
    <!-- Manhattan Font -->
    <link href="https://fonts.cdnfonts.com/css/manhattan-darling" rel="stylesheet">

    <link rel="icon" type="image/png" href="images/logo_favicon.png">
    <!-- For Apple devices -->
    <link rel="apple-touch-icon" href="images/logo_favicon.png">
</head>
<body>
    <!-- Navigation -->
    <?php
        // Start session to get logged-in user data
        session_start();
    ?>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Lotus Serenity Spa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking.php">Book Now</a></li>

                    <!-- Conditional Links Based on Login Status -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
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

    <!-- Greet user -->
    <h2>Welcome!</h2>

    <br> <br>

    <!-- Filter Form; Just an experiment-->
    <form method="GET" action="services.php">
        <label for="service_type">Service Type:</label>
        <input type="text" name="service_type" id="service_type" value="<?= htmlspecialchars($_GET['service_type'] ?? '') ?>">
        <br>
        <label for="min_price">Min Price:</label>
        <input type="number" name="min_price" id="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
        
        <label for="max_price">Max Price:</label>
        <input type="number" name="max_price" id="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
        <br>
        <label for="duration">Duration:</label>
        <input type="number" name="duration" id="duration" value="<?= htmlspecialchars($_GET['duration'] ?? '') ?>">
        <br>
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="">Default</option>
            <option value="popularity" <?= ($_GET['sort'] ?? '') == 'popularity' ? 'selected' : '' ?>>Popularity</option>
            <option value="price" <?= ($_GET['sort'] ?? '') == 'price' ? 'selected' : '' ?>>Price</option>
            <option value="duration" <?= ($_GET['sort'] ?? '') == 'duration' ? 'selected' : '' ?>>Duration</option>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <br> <br>

    <!-- Service Cards -->
    <div class="container mt-5">
        <div class="row">
            <?php
                // Fetch data
                if ($services_result && $services_result->num_rows > 0) {
                    while ($row = $services_result->fetch_assoc()) {
                        echo "<div class='col-lg-4 col-md-6 mb-4'>";
                        echo "<div class='service-card'>";
                        echo "<h3 class='service-title'>" . htmlspecialchars($row['service_name']) . "</h3>";
                        echo "<p class='service-price'><strong>Price: </strong>" . htmlspecialchars($row['price']) . "</p>";
                        echo "<p class='service-duration'><strong>Duration: </strong>" . htmlspecialchars($row['duration']) . " mins</p>";
                        echo "<p class='service-description'>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<button class='btn btn-primary'>Book Now</button>";
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

    <!-- Book Now -->
    <p><a href="booking.php">Book Now</a></p>

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