<?php
    // Connect to database
    include 'database.php';

    // Get data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $service_id = $_POST['service'];
        $therapist_id = $_POST['therapist'];
        $appointment_date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $status = 'pending';
        $created_at = $_POST['created_at'];

        // Validate form
        if (empty($serviceId) || empty($therapistId) || empty($date) || 
            empty($time) || empty($customerName) || empty($customerEmail)) {

            die("Please fill in all required fields");
        }
    } else {
        // Check schedule
        $check_sql = "SELECT COUNT(*) FROM appointments WHERE therapist_id = $therapistId
        AND appointment_date = $date AND appointment_time = $time";

        // if ($conn -> query($check_sql)) {
        //     echo "Appointment created successfully! Please wait for our confirmation.";
        // } else {
        //     echo "Error creating appointment: " . $conn -> error . ". Please try again.";
        // }

        if ($conn -> query($check_sql) > 0) {
            // Therapist is unavailable
            echo "Sorry, the therapist is not available at that time.";
            exit;
        } else {
            // Therapist is available, so add appointment to database
        $add_sql = "INSERT INTO appointments (service_id, therapist_id, appointment_date, appointment_time, customer_name, customer_email)
        VALUES ($serviceId, $therapistId, $date, $time,$customerName, $customerEmail)";
    
            if ($conn -> query($add_sql)) {
                echo "Appointment created successfully! Please wait for our confirmation.";
                echo "";
                echo "<p>Customer Name: " . $full_name . "</p>";
                echo "<p>Customer Email: " . $email . "</p>";
                echo "<p>Service: " . $service_id . "</p>";
                echo "<p>Therapist: " . $therapist_id . "</p>";
                echo "<p>Appointment Date: " . $appointment_date . "</p>";
                echo "<p>Start Time: " . $start_time . "</p>";
                echo "<p>Expected End Time: " . $end_time . "</p>";
            } else {
                echo "Error creating appointment: " . $conn -> error . ". Please try again.";
            }
        }
    }
    $conn -> close();
?>