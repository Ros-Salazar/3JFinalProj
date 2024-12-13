<section id="therapists" style="margin-top: 40px;">
    <div class="admin-section-header">
        <h1>Manage Therapist Schedules</h1>
    </div>
    <div class="admin-dashboard-card" style="max-width: 800px;">
        <form method="POST" class="form" style="width: 750px;">
            <div class="mb-3">
                <label for="therapist_id" class="form-label">Therapist Name</label>
                <select name="therapist_id" class="form-control" id="therapist_id" required>
                    <?php
                    // Fetch therapist list
                    $therapists = $conn->query("SELECT * FROM users WHERE role = 'therapist'");
                    while ($therapist = $therapists->fetch_assoc()) {
                        echo "<option value='" . $therapist['user_id'] . "'>" . $therapist['full_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>
            <button type="submit" name="action" class="btn btn-primary" value="add_availability" >Add Availability</button>
        </form>
    </div>
</section>

<?php
// Handle availability form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'add_availability') {
    $therapist_id = $_POST['therapist_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $insert_sql = "INSERT INTO availability (therapist_id, date, start_time, end_time) VALUES ('$therapist_id', '$date', '$start_time', '$end_time')";
    if ($conn->query($insert_sql)) {
        // echo "<script>window.location.href = 'dashboard-admin.php';</script>";
        echo "<br><div class='alert alert-success'>Availability added successfully!</div>";
    } else {
        echo "<br><div class='alert alert-danger'>Failed to add availability!</div>";
    }
}
?>