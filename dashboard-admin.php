<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Navigation -->
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
</body>
</html>