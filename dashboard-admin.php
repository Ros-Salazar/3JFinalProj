<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    
    <!-- Navigation for dashboard -->
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="admin_bookings.php">Manage Bookings</a></li>
            <li><a href="admin_services.php">Manage Services</a></li>
            <li><a href="admin_therapists.php">Therapist Schedule</a></li>
            <li><a href="admin_reports.php">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Admin Dashboard Content -->
    <div class="container">

        <!-- Manage Bookings Section -->
        <section id="manage_bookings">
            <h2>Manage Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Therapist</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';

                    // Fetch all bookings
                    $sql = "SELECT * FROM appointments JOIN users ON appointments.user_id = users.user_id JOIN services ON appointments.service_id = services.service_id";
                    $result = $conn->query($sql);
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['appointment_id'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['service_name'] . "</td>";
                        echo "<td>" . $row['therapist_name'] . "</td>";
                        echo "<td>" . $row['appointment_date'] . "</td>";
                        echo "<td>" . ucfirst($row['status']) . "</td>";
                        echo "<td>
                                <form method='POST'>
                                    <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
                                    <button type='submit' name='action' value='approve'>Approve</button>
                                    <button type='submit' name='action' value='cancel'>Cancel</button>
                                    <button type='submit' name='action' value='reschedule'>Reschedule</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <?php
        // Handle booking actions (approve, cancel, reschedule)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $appointment_id = $_POST['appointment_id'];
            $new_status = '';

            if ($action == 'approve') {
                $new_status = 'confirmed';
            } elseif ($action == 'cancel') {
                $new_status = 'canceled';
            } elseif ($action == 'reschedule') {
                // Additional logic for rescheduling can be implemented
                $new_status = 'pending';
            }

            if ($new_status) {
                // Update appointment status in the database
                $update_sql = "UPDATE appointments SET status = '$new_status' WHERE appointment_id = $appointment_id";
                if ($conn->query($update_sql)) {
                    echo "Booking status updated successfully!";
                    header("Refresh:0"); // Refresh page to see updated status
                } else {
                    echo "Error updating status: " . $conn->error;
                }
            }
        }
        ?>

        <!-- Manage Services Section -->
        <section id="manage_services">
            <h2>Manage Services</h2>
            <table>
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all services
                    $sql = "SELECT * FROM services";
                    $result = $conn->query($sql);
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['service_name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['duration'] . " minutes</td>";
                        echo "<td>
                                <form method='POST'>
                                    <input type='hidden' name='service_id' value='" . $row['service_id'] . "'>
                                    <button type='submit' name='action' value='edit'>Edit</button>
                                    <button type='submit' name='action' value='delete'>Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <h3>Add New Service</h3>
            <form method="POST">
                <input type="text" name="service_name" placeholder="Service Name" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="number" name="price" placeholder="Price" required>
                <input type="number" name="duration" placeholder="Duration (minutes)" required>
                <button type="submit" name="action" value="add">Add Service</button>
            </form>
        </section>

        <?php
        // Handle add, edit, delete service actions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];

            // Add new service
            if ($action == 'add') {
                $service_name = $_POST['service_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $duration = $_POST['duration'];

                $add_sql = "INSERT INTO services (service_name, description, price, duration) VALUES ('$service_name', '$description', '$price', '$duration')";
                if ($conn->query($add_sql)) {
                    echo "Service added successfully!";
                    header("Refresh:0"); // Refresh page to see new service
                } else {
                    echo "Error adding service: " . $conn->error;
                }
            }

            // Edit or delete service logic can be implemented similarly.
        }
        ?>

        <!-- Therapist Schedule Section -->
        <section id="therapist_schedule">
            <h2>Therapist Schedule</h2>
            <form method="POST">
                <select name="therapist_id" required>
                    <?php
                    // Fetch therapist list
                    $therapists = $conn->query("SELECT * FROM users WHERE role = 'therapist'");
                    while ($therapist = $therapists->fetch_assoc()) {
                        echo "<option value='" . $therapist['user_id'] . "'>" . $therapist['full_name'] . "</option>";
                    }
                    ?>
                </select>
                <input type="date" name="date" required>
                <input type="time" name="start_time" required>
                <input type="time" name="end_time" required>
                <button type="submit" name="action" value="add_availability">Add Availability</button>
            </form>
        </section>

        <?php
        // Handle availability form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'add_availability') {
            $therapist_id = $_POST['therapist_id'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];

            $insert_sql = "INSERT INTO therapist_availability (therapist_id, date, start_time, end_time) VALUES ('$therapist_id', '$date', '$start_time', '$end_time')";
            if ($conn->query($insert_sql)) {
                echo "Availability added successfully!";
                header("Refresh:0"); // Refresh page to see updated availability
            } else {
                echo "Error adding availability: " . $conn->error;
            }
        }
        ?>
    </div>

    <script>
        $(document).ready(function () {
            // Handle form submissions and actions using AJAX
            $('#addServiceForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'add_service.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Service added successfully');
                        location.reload();
                    }
                });
            });

            // Approve, Cancel, Reschedule booking actions
            $('.approve, .cancel, .reschedule').click(function () {
                var action = $(this).hasClass('approve') ? 'approve' :
                             $(this).hasClass('cancel') ? 'cancel' : 'reschedule';
                var appointmentId = $(this).data('id');
                
                $.ajax({
                    url: 'manage_booking.php',
                    method: 'POST',
                    data: { action: action, appointment_id: appointmentId },
                    success: function (response) {
                        alert('Booking status updated');
                        location.reload();
                    }
                });
            });

            // Handle therapist availability form
            $('#availabilityForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'add_availability.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Availability added successfully');
                        location.reload();
                    }
                });
            });
        });
    </script>

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