<!--Development(Backend)-->
<?php
/*
    // Connect to database
    include 'database.php';

    // Start user session
    session_start();

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Get data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check with database
        $email_sql = "SELECT * FROM users WHERE email = '$email'";
        $email_result = $conn -> query($email_sql);

        if ($email_result -> num_rows > 0) {
            $row = $email_result -> fetch_assoc();
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Verify password
            if (password_verify($password, $row['password'])) {
                // Store user information in session
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["full_name"] = $row["full_name"];
                $_SESSION["role"] = $row["role"];

                // Redirect based on user role
                if ($_SESSION['role'] == 'admin') {
                    header("Location: dashboard-admin.php"); // Admin dashboard
                } else {
                    header("Location: dashboard.php"); // Customer dashboard
                }
                exit();
            } else {
                // Incorrect password
                echo "<br>Incorrect password. Please try again.";
            }
        } else {
            // User not found
            echo "<br>User not found. Please register.";
        }       
        // $conn -> close(); 
    }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

                    <!--Development(Frontend)-->
                    <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>

                    <!-- Conditional Links Based on Login Status -->
                    <?php /* if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard-admin.php">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; */?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <section class="cta-section py-5">
        <div class="container d-flex flex-column align-items-center justify-content-center" style="max-width: 1000px;">
            <p class="mb-5"></p>
            <p class="mb-5"></p>
            <p class="mb-3"></p>
            

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="login-form text-center w-50 p-4 shadow rounded bg-white">
            <h2 class="text-center mb-5">Login to Your Account</h2>
                <div class="mb-3">
                    <label for="email" class="form-label text-dark">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-dark">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" id="show-password">
                    <label class="form-check-label text-dark" for="show-password">Show Password</label>
                    <script>
                        const passwordInput = document.getElementById('password');
                        const showPasswordCheckbox = document.getElementById('show-password');

                        showPasswordCheckbox.addEventListener('change',() => {
                            if (showPasswordCheckbox.checked) {
                                passwordInput.type = 'text';
                            } else {
                                passwordInput.type = 'password';
                            }
                        });
                    </script>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </form>
            <p class="lead mt-4">Don't have an account? <a href="register.php" class="text-primary">Register</a></p>
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