<section id="therapists">
    <h2>Therapist Schedule</h2>
    <form method="POST" class="form" style="max-width: 800px;">
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