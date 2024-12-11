<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
<body class= "booking-body">
    <!-- Navigation -->
    <?php
        session_start();
    ?>
    
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg booking-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Lotus Serenity Spa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a id="home-services" class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a id="smooth-services" class="nav-link" href="index.php#services-section">Services</a></li>

                    <!--development-->
                    <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <!-- Conditional Links Based on Login Status --> 
                    <!-- <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; ?> -->
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Display services -->
    <div class="booking-container">
        <div class="text-center mb-5">
            <br>
        </div>
        <h2 class="booking-title">Booking</h2>

        <!-- <table class="table booking-table styled-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Pricing</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  // Connect to database
                  include "database.php";
                  // Get services
                  $display_sql = "SELECT * FROM services";
                  $display_result = $conn -> query($display_sql);
                  if ($display_result -> num_rows > 0) {
                      while ($display_row = $display_result -> fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $display_row['service_name'] . "</td>";
                          echo "<td>" . $display_row['description'] . "</td>";
                          echo "<td>". "PHP " . $display_row['price'] . " / ". $display_row['duration'] . " minutes" . "</td>";
                          echo "</tr>";
                      };
                  } else {
                      echo "<tr><td colspan='3'>No Services</td></tr>";
                  };
                ?>
            </tbody>
        </table> -->

        <br> <br>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="booking-form">
            <h3 class="booking-subtitle">Service and Therapist</h3>
            <label for="service">Select Service:</label>
            <select name="service_id" id="service_id" class="animated-dropdown" required>
                <optgroup label="Services"></optgroup>
                <option value="1">Swedish Massage</option>
                <option value="2">Sports Massage</option>
                <option value="3">Trigger Point Therapy</option>
                <option value="4">Deep Tissue Massage</option>
                <option value="5">Chair Massage</option>
                <option value="6">Couple's Massage</option>
            </select>

            <br> <br>

            <label for="therapist">Select Therapist:</label>
            <select name="therapist_id" id="therapist_id" class="animated-dropdown" required>
                <optgroup label="Male Therapists"></optgroup>
                <option value="2">Adam Smith</option>
                <option value="3">Bob Smith</option>
                <option value="4">Alvaro Mauro</option>
                <option value="5">Reno Sanchez</option>
                <optgroup label="Female Therapists"></optgroup>  
                <option value="6">Eve Smith</option>
                <option value="7">Alice Smith</option>
                <option value="8">Kaitlin Monceda</option>
                <option value="9">Leilani Rosario</option>
            </select>

            <br> <br>

            <h3 class="booking-subtitle">Date and Time</h3>

            <label for="date">Select Appointment Date:</label>
            <input class="animated-dropdown" type="date" name="appointment_date" id="appointment_date" required>

            <br> <br>

            <label for="time">Select Start Time:</label>
            <input class="animated-dropdown" type="time" name="start_time" id="start_time" required>
            
            <br> <br>

            <label for="time">Select End Time:</label>
            <input class="animated-dropdown" type="time" name="end_time" id="end_time" required>

            <br> <br>

            <h3 class="booking-subtitle">Confirmation and Payment</h3>

            <label for="promo_code">Promo Code:</label>
            <input class="animated-dropdown" type="text" name="promo_code" id="promo_code" placeholder="Enter promo code">

            <br><br>

            <label for="payment_method">Payment Method:</label>
            <select class="animated-dropdown" name="payment_method" id="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>

            <br><br>

            <button type="submit" class="btn btn-primary">Confirm Appointment</button>
        </form>
    </div>

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
                                    <span>info@serenityspa.ph</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Quick Links -->
                    <div class="col-lg-4">
                        <div class="quick-links">
                            <h4>Quick Links</h4>
                            <div class="links-grid">
                                <a href="index.php#services-section"  class="link-item">
                                    <i class="fas fa-spa"></i>
                                    <span>Our Services</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Book Appointment</span>
                                </a>
                                <a href="index.php#home-section" class="link-item">
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
                        <p class="copyright"> 2024 Lotus Serenity Spa. All rights reserved.</p>
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