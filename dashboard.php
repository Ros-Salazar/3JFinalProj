<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <!-- Navigation -->
    <?php /*
        // Start session to get logged-in user data
        session_start();
    */ ?>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-dark py-3">
        <div class="container">
            <a class="brand-name" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a id="home-services" class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a id="smooth-services" class="nav-link" href="index.php#services-section">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking.php">Book Now</a></li>

                    <!-- Conditional Links Based on Login Status -->
                    <?php /*
                    if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; */ ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- User Dashboard -->
    <section class="dashboard container py-5">
        <div class="text-center mb-5">
            <h1 class="dashboard-title">Welcome, <?= htmlspecialchars($user_data['full_name']) ?>!</h1>
            <p class="dashboard-subtitle">Here's an overview of your appointments and rewards.</p>
        </div>
        <div class="container text-center position-relative align-items-center justify-content-center text-center">
            
            <?php /*
            // Connect to database
            include 'database.php';

            // For debugging
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

            // Check if user is logged in
            // if (!isset($_SESSION['user_id'])) {
            //     header("Location: login.php");
            //     exit();
            // }

            // Get logged-in user's data
            $user_id = 10;
            // $user_id = $_SESSION['user_id'];
            $user_query = "SELECT * FROM users WHERE user_id = $user_id";
            $user_result = $conn->query($user_query);
            $user_data = $user_result->fetch_assoc();

            // Upcoming Appointments
            $upcoming_query = "
                SELECT a.*, s.service_name 
                FROM appointments a
                JOIN services s ON a.service_id = s.service_id
                WHERE a.user_id = $user_id AND a.status IN ('pending', 'confirmed') AND a.appointment_date >= CURDATE()
                ORDER BY a.appointment_date, a.start_time";
            $upcoming_result = $conn->query($upcoming_query);

            // Past Appointments
            $past_query = "
                SELECT a.*, s.service_name 
                FROM appointments a
                JOIN services s ON a.service_id = s.service_id
                WHERE a.user_id = $user_id AND a.status = 'completed'
                ORDER BY a.appointment_date DESC";
            $past_result = $conn->query($past_query);

            // Promotions
            $promotions_query = "
            SELECT * FROM promotions 
            WHERE start_date <= CURDATE() AND end_date >= CURDATE()";
            $promotions_result = $conn->query($promotions_query);
            */ ?>

            <!-- Dashboard Panels -->
            <div class="row g-4">
                    <!-- Upcoming Appointments -->
                    <div class="col-md-6">
                        <div class="dashboard-card">
                            <h3 class="card-title">Upcoming Appointments</h3>
                            <?php if ($upcoming_result->num_rows > 0): ?>
                                <ul class="appointment-list">
                                    <?php while ($row = $upcoming_result->fetch_assoc()): ?>
                                        <li class="appointment-item">
                                            <strong><?= htmlspecialchars($row['service_name']) ?></strong><br>
                                            <span class="text-muted">Date: <?= htmlspecialchars($row['appointment_date']) ?></span><br>
                                            <span class="text-muted">Time: <?= htmlspecialchars($row['start_time']) ?> - <?= htmlspecialchars($row['end_time']) ?></span><br>
                                            <span>Status: <?= htmlspecialchars($row['status']) ?></span><br>
                                            <div class="appointment-actions">
                                                <a href="cancel.php?appointment_id=<?= $row['appointment_id'] ?>" class="btn btn-outline-danger btn-sm">Cancel</a>
                                                <a href="reschedule.php?appointment_id=<?= $row['appointment_id'] ?>" class="btn btn-outline-primary btn-sm">Reschedule</a>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p>No upcoming appointments</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Past Appointments -->
                    <div class="col-md-6">
                        <div class="dashboard-card">
                            <h3 class="card-title">Past Appointments</h3>
                            <?php if ($past_result->num_rows > 0): ?>
                                <ul class="appointment-list">
                                    <?php while ($row = $past_result->fetch_assoc()): ?>
                                        <li class="appointment-item">
                                            <strong><?= htmlspecialchars($row['service_name']) ?></strong><br>
                                            <span class="text-muted">Date: <?= htmlspecialchars($row['appointment_date']) ?></span><br>
                                            <a href="review.php?appointment_id=<?= $row['appointment_id'] ?>" class="btn btn-outline-success btn-sm">Leave a Review</a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p>No past appointments</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <!-- Promotions Section -->
            <div class="dashboard-card mt-5">
                <h3 class="card-title">Promotions and Rewards</h3>
                <?php
                if ($promotions_result->num_rows > 0): ?>
                    <ul class="promotions-list">
                        <?php while ($promo = $promotions_result->fetch_assoc()): ?>
                            <li class="promotion-item">
                                <strong><?= htmlspecialchars($promo['promo_code']) ?></strong>: <?= htmlspecialchars($promo['description']) ?> 
                                (<?= htmlspecialchars($promo['discount_percent']) ?>% off)
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No active promotions.</p>
                <?php endif;
                ?>
            </div>

            <!-- Account Settings -->
            <div class="dashboard-card-buttons mt-5 text-center">
                <a href="edit-profile.php" class="btn btn-edit btn-lg mx-2">Edit Profile</a>
                <a href="change-password.php" class="btn btn-change-password btn-lg mx-2">Change Password</a>
                <!-- <a href="logout.php" class="btn btn-danger btn-lg mx-2">Logout</a> -->
            </div>
        </div>
    </section>

    <br><br>
    <br><br>
    <br><br>
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