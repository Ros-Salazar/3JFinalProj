<!-- PHP -->
<?php
    // Connect to database
    include 'database.php';

    // Start session to get logged-in user data
    session_start();
    

    // For debugging
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

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
                <!-- <li class="active">
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
                </li> -->
                <li>
                    <a href="#services">
                        <i class="fas fa-spa"></i>
                        <span>Manage Services</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#therapists">
                        <i class="fas fa-user-md"></i>
                        <span>Therapist Schedule</span>
                    </a>
                </li> -->
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
            <!-- Edit Service Overview -->
            <h3 style="margin-top: 20px;">Edit Service</h3>
            <div class="admin-dashboard-card" style="max-width: 800px;">
                <form method="POST" class="form" style="width: 750px;">
                    <?php // Fetch all services
                    if (isset($_GET['service_id'])) {
                        $service_id = $_GET['service_id'];
                        // Sanitize the input to prevent SQL injection or XSS
                        $service_id = htmlspecialchars($service_id);
                    } else {
                        // Handle the case where the parameter is missing
                        die("Service ID is missing.");
                    }

                    $sql = "SELECT * FROM services WHERE service_id = $service_id";
                    $result = $conn->query($sql);

                    // Check if query was successful
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" value="<?= htmlspecialchars($row['service_name']) ?>" class="form-control" id="service_name" name="service_name" placeholder="Service Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Description" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" value="<?= htmlspecialchars($row['price']) ?>" class="form-control" id="price" name="price" placeholder="Price" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" value="<?= htmlspecialchars($row['duration']) ?>" class="form-control" id="duration" name="duration" placeholder="Duration (minutes)" required>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                    <button type="submit" name="action" value="edit" class="btn btn-primary">Update Service</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
                    </div>
                    <?php endwhile; ?>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $action = $_POST['action'];
                    // Add new service
                    if ($action == 'edit') {
                        $service_id = $_GET['service_id'];
                        $service_name = $_POST['service_name'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $duration = $_POST['duration'];

                        // Sanitize inputs to prevent SQL injection
                        $service_name = $conn->real_escape_string($service_name);
                        $description = $conn->real_escape_string($description);
                        $price = $conn->real_escape_string($price);
                        $duration = $conn->real_escape_string($duration);

                        $update_sql = "UPDATE services 
                        SET service_name = '$service_name', 
                            description = '$description', 
                            price = '$price', 
                            duration = '$duration' 
                        WHERE service_id = $service_id";

                        if ($conn->query($update_sql)) {
                            echo "<br><div class='alert alert-success'>Service edited successfully!</div>";
                            echo "<script>window.location.href = 'dashboard-admin.php#services';</script>";
                        } else {
                            echo "<br><div class='alert alert-danger'>Failed to edit service. Please try again.</div>";
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>

    <!-- <footer class="text-center py-3">
        <p>&copy; 2024 Lotus Serenity Spa. All rights reserved.</p>
    </footer> -->
  

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navigation.js"></script>
</body>
</html>