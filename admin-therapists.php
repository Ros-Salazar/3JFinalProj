<section id="therapists">
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