<?php
    // Connect the database
    include 'database.php';

    // Get customer data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $serviceId = $_POST['service'];
        $therapistId = $_POST['therapist'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $customerName = $_POST['customer_name'];
        $customerEmail = $_POST['customer_email'];

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

        if ($count > 0) {
            // Therapist is unavailable
            echo "Sorry, the therapist is not available at that time.";
            exit;
        } else {
            // Therapist is available, so add appointment to database
        $add_sql = "INSERT INTO appointments (service_id, therapist_id, appointment_date, appointment_time, customer_name, customer_email)
        VALUES ($serviceId, $therapistId, $date, $time,$customerName, $customerEmail)";
    
            if ($conn -> query($add_sql)) {
                echo "Appointment created successfully! Please wait for our confirmation.";
            } else {
                echo "Error creating appointment: " . $conn -> error . ". Please try again.";
            }
        }

        
    }

    // Redirect to confirmation page
    header("Location: confirmation.php");
    $conn->close();
?>