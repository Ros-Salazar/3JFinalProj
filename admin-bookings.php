<section id="bookings" style="margin-top: 40px;">
    <div class="admin-section-header">
        <h1>Manage Bookings</h1>
    </div>
    <div class="admin-dashboard-card">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <!-- <th class="col-md-1">Booking ID</th> -->
                    <th class="col-md-2">Customer Name</th>
                    <th class="col-md-2">Service</th>
                    <th class="col-md-2">Therapist</th>
                    <th class="col-md-1">Date</th>
                    <th class="col-md-1">Start Time</th>
                    <th class="col-md-1">End Time</th>
                    <th class="col-md-1">Status</th>
                    <th class="col-md-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'database.php';

                // Fetch all bookings
                $sql = "SELECT * FROM appointments JOIN users ON appointments.user_id = users.user_id JOIN services ON appointments.service_id = services.service_id";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    if ($row['therapist_id'] == 2) {
                        $therapist_name = 'Adam Smith';
                    } elseif ($row['therapist_id'] == 3) {
                        $therapist_name = 'Bob Smith';
                    } elseif ($row['therapist_id'] == 4) {
                        $therapist_name = 'Alvaro Mauro';
                    } elseif ($row['therapist_id'] == 5) {
                        $therapist_name = 'Reno Sanchez';
                    } elseif ($row['therapist_id'] == 6) {
                        $therapist_name = 'Eve Smith';
                    } elseif ($row['therapist_id'] == 7) {
                        $therapist_name = 'Alice Smith';
                    } elseif ($row['therapist_id'] == 8) {
                        $therapist_name = 'Kaitlin Monceda';
                    } else {
                        $therapist_name = 'Leilani Rosario';
                    }

                    echo "<tr>";
                    $row['appointment_id'];
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['service_name'] . "</td>";
                    echo "<td>" . $therapist_name . "</td>";
                    echo "<td>" . $row['appointment_date'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                    echo "<td>
                            <form method='POST'>
                                <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
                                <button type='submit' name='action' value='confirmed' class='btn btn-outline-primary'>Approve</button>
                                <button type='submit' name='action' value='cancel' class='btn btn-outline-danger'>Cancel</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>    
</section>

<?php
// Handle booking actions (approve, cancel, reschedule)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['appointment_id']) {
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
}
?>