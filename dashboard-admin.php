<!-- PHP -->
<?php
    // Connect to database
    include 'database.php';

    // Start session to get logged-in user data
    session_start();

    // For debugging
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Get logged-in user's data
        $user_id = $_SESSION['user_id'];
        $user_query = "SELECT * FROM users WHERE user_id = $user_id";
        $user_result = $conn->query($user_query);
        $user_data = $user_result->fetch_assoc();
    
?>

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
    <!-- Libre Caslon Text Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="images/logo_favicon.png">
    <!-- For Apple devices -->
    <link rel="apple-touch-icon" href="images/logo_favicon.png">
</head>
<body class="admin-dashboard" style="position: absolute;">
    
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-top-nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo_favicon.png" alt="Lotus Serenity Spa" class="logo">
                Lotus Serenity Spa - Admin
            </a>
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Admin Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="edit-profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Container -->
    <div class="admin-dashboard-container">
        <!-- Sidebar Navigation -->
        <div class="admin-sidebar">
            <ul class="admin-sidebar-nav" style="margin-top: 100px;">
                <li class="">
                    <a href="#dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#bookings">
                        <i class="fas fa-calendar-check"></i>
                        <span>Manage Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="#services">
                        <i class="fas fa-spa"></i>
                        <span>Manage Services</span>
                    </a>
                </li>
                <li>
                    <a href="#therapists">
                        <i class="fas fa-user-md"></i>
                        <span>Therapist Schedule</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#reports">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- Main Content Area -->
        <main class="admin-main-content" style="margin-top: 100px;">
            <!-- Dashboard Overview -->
            <section id="dashboard" class="admin-section active">
                <div class="admin-section-header">
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="admin-dashboard-grid">
                    <div class="admin-dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="card-content">
                            <h3>Total Bookings</h3>
                            <p class="card-number">124</p>
                        </div>
                    </div>
                    <div class="admin-dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-content">
                            <h3>Active Clients</h3>
                            <p class="card-number">87</p>
                        </div>
                    </div>
                    <div class="admin-dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-content">
                            <h3>Average Monthly Revenue</h3>
                            <p class="card-number">₱12,450</p>
                        </div>
                    </div>
                </div>
            </section>
            <div id="bookings"></div>
            <?php include 'admin-bookings.php'; ?>
            <div id="services"></div>
            <?php include 'admin-services.php'; ?>
            <div id="therapists"></div>
            <?php include 'admin-therapists.php'; ?>
        </main>
    </div>

    <!-- <footer class="text-center py-3">
        <p>&copy; 2024 Lotus Serenity Spa. All rights reserved.</p>
    </footer> -->

     
    <script>
        document.getElementById('addServiceButton').addEventListener('click', function() {
            var form = document.getElementById('addServiceForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

        document.getElementById('editServiceButton').addEventListener('click', function() {
            var form = document.getElementById('editServiceForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

        document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.dataset.id;

        // Fetch service details using AJAX or PHP and populate the modal form
        fetch('fetch_service.php', {
            method: 'POST',
            body: new URLSearchParams({
                service_id: serviceId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Handle error, e.g., display an error message
            } else {
                document.getElementById('edit_service_id').value = data.service_id;
                document.getElementById('edit_service_name').value = data.service_name;                                                                                              
                document.getElementById('edit_description').value = data.description;
                document.getElementById('edit_price').value = data.price;
                document.getElementById('edit_duration').value = data.duration;

                // Show the modal
                const editServiceModal = new bootstrap.Modal(document.getElementById('editServiceModal'));
                editServiceModal.show();
            }
        })
        .catch(error => {
            console.error('Error fetching service data:', error);
        });
    });
});
        
        // $(document).ready(function () {
        //     // Handle form submissions and actions using AJAX
        //     $('#addServiceForm').submit(function (e) {
        //         e.preventDefault();
        //         $.ajax({
        //             url: 'add_service.php',
        //             method: 'POST',
        //             data: $(this).serialize(),
        //             success: function (response) {
        //                 alert('Service added successfully');
        //                 location.reload();
        //             }
        //         });
        //     });

        //     // Approve, Cancel, Reschedule booking actions
        //     $('.approve, .cancel, .reschedule').click(function () {
        //         var action = $(this).hasClass('approve') ? 'approve' :
        //                      $(this).hasClass('cancel') ? 'cancel' : 'reschedule';
        //         var appointmentId = $(this).data('id');
                
        //         $.ajax({
        //             url: 'manage_booking.php',
        //             method: 'POST',
        //             data: { action: action, appointment_id: appointmentId },
        //             success: function (response) {
        //                 alert('Booking status updated');
        //                 location.reload();
        //             }
        //         });
        //     });

        //     // Handle therapist availability form
        //     $('#availabilityForm').submit(function (e) {
        //         e.preventDefault();
        //         $.ajax({
        //             url: 'add_availability.php',
        //             method: 'POST',
        //             data: $(this).serialize(),
        //             success: function (response) {
        //                 alert('Availability added successfully');
        //                 location.reload();
        //             }
        //         });
        //     });
        // });
    </script>

  

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navigation.js"></script>
</body>
</html>