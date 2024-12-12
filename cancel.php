<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment</title>
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
    <nav class="navbar navbar-expand-lg bg-dark py-3">
        <div class="container">
            <a class="brand-name" href="#">Lotus Serenity Spa</a>
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

    <?php
    // Connect to database
    include 'database.php';

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    // Get logged-in user's data
    // $user_id = 10;
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $user_result = $conn->query($user_query);
    $user_data = $user_result->fetch_assoc();

    if (isset($_GET['appointment_id'])) {
        $appointment_id = $_GET['appointment_id'];
        // Sanitize the input to prevent SQL injection or XSS
        $appointment_id = htmlspecialchars($appointment_id);
    } else {
        // Handle the case where the parameter is missing
        die("Appointment ID is missing.");
    }
    ?>

    <!-- Cancel Appointment Form -->
    <section class="container-edit py-5">
    <div class="text-center mb-5">
            <br>
            <br>
            <br>
        </div>
    <div class="text-center mb-5">
        </div>
        <div class="card-edit shadow-lg border-0 rounded-3 p-4 mx-auto" style="max-width: 500px;">
            
            <h2 class="text-center-edit mb-4">Cancel Appointment</h2>
            <?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the appointment ID is provided
    if (isset($_GET['appointment_id'])) {
        $appointment_id = intval($_GET['appointment_id']); // Sanitize input

        // Delete the appointment from the database
        $delete_query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";
        if ($conn->query($delete_query)) {
            echo "<script>window.appointmentDeleted = true;</script>";
            echo "<div class='alert alert-success'>Appointment has been successfully cancelled.</div>";
            header("refresh:3;url=dashboard.php");
        } else {
            echo "<div class='alert alert-danger'>Failed to cancel the appointment. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Appointment ID is missing. Unable to cancel the appointment.</div>";
    }
}
?>
            <form method="post" class="form-edit">
                <ul class="appointment-list">
                <?php
                $upcoming_query = "SELECT * FROM appointments WHERE appointment_id = $appointment_id"; 
                $upcoming_result = $conn->query($upcoming_query);

                while ($row = $upcoming_result->fetch_assoc()):
                if ($row['service_id'] == 1) {
                    $service_name = "Swedish Massage";
                } elseif ($row['service_id'] == 2) {
                    $service_name = "Sports Massage";
                } elseif ($row['service_id'] == 3) {
                    $service_name = "Trigger Point Therapy";
                } elseif ($row['service_id'] == 4) {
                    $service_name = "Deep Tissue Massage";
                } elseif ($row['service_id'] == 5) {
                    $service_name = "Chair Massage";
                } else {
                    $service_name = "Couple's Massage";
                }
                ?>
                
                    <li class="appointment-item-cancel">
                        <strong><?= htmlspecialchars($service_name) ?></strong><br>
                        <span class="text-muted">Date: <?= htmlspecialchars($row['appointment_date']) ?></span><br>
                        <span class="text-muted">Time: <?= htmlspecialchars($row['start_time']) ?> - <?= htmlspecialchars($row['end_time']) ?></span><br>
                        <span>Status: <?= htmlspecialchars($row['status']) ?></span><br>
                        <!-- <div class="appointment-actions">
                            <a class="btn btn-outline-danger btn-sm">Confirm Cancellation</a>
                            <a class="btn btn-outline-danger btn-sm">Cancel</a>
                        </div> -->
                    </li>
                <?php endwhile; ?>
                </ul>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" id = "confirmButton" class="btn btn-primary">Confirm Cancellation</button>
                    <a href="dashboard.php" id = "cancelButton" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <script>
    // Check if the appointment has been deleted
    if (window.appointmentDeleted) {
        // Hide the cancellation button
        document.getElementById("confirmButton").style.display = "none";
        document.getElementById("cancelButton").style.display = "none";
    }
</script>
        </div>
    </section>


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
                            <a id="smooth-services" href="index.php#services-section" class="link-item">
                                <i class="fas fa-spa"></i>
                                <span>Our Services</span>
                            </a>
                            <a class="nav-link" href="booking.php" class="link-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Book Appointment</span>
                            </a>
                            <a id="home-services" href="index.php#footers-section"   class="link-item">
                                <i class="fas fa-info-circle"></i>
                                <span>About Us</span>
                            </a>
                            <a id="home-services" href="index.php#footers-section" class="link-item">
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
    <script src="js/animation.js"></script>
</body>
</html>