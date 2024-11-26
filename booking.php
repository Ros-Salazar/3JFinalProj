<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
  <body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <!-- I'm not sure how about the back end for the login so that it will retain the user_id -->
      <input type="hidden" name="user_id" value="<?php include 'database.php';echo $user_id; ?>">

      <label for="service">Select Service:</label>
      <select name="service_id" id="service_id" required>
        <optgroup label="Services"></optgroup>
        <option value="1">Swedish Massage</option>
        <option value="2">Sports Massage</option>
        <option value="3">Trigger Point Therapy</option>
        <option value="4">Deep Tissue Massage</option>
        <option value="5">Chair Massage</option>
        <option value="6">Couple's Massage</option>
        </select>

      <br>

      <label for="therapist">Select Therapist:</label>
      <select name="therapist_id" id="therapist_id" required>
        <optgroup label="Male Therapists"></optgroup>
          <option value="2">Adam Smith</option>
          <option value="3">Bob Smith</option>
          <option value="4">Alvaro Mauro</option>
          <option value="5">Reno Sanchez</option>
        <optgroup label="Female Therapists"></optgroup>  
          <option value="6">Eve Smith</option>
          <option value="7">Alice Smith</option>
          <option value="8">Kaitlin Monceda</option>
          <option value="9">Leilani Rosario</option>
      </select>

      <br>

      <label for="date">Select Appointment Date:</label>
      <input type="date" name="appointment_date" id="appointment_date" required>

      <br>

      <label for="time">Select Start Time:</label>
      <input type="time" name="start_time" id="start_time" required>
      
      <br>

      <label for="time">Select End Time:</label>
      <input type="time" name="end_time" id="end_time" required>

      <br>

      <button type="submit">Confirm Appointment</button>
    </form>

    <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    
        // Get data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = 6;
            $service_id = $_POST['service_id'];
            $therapist_id = $_POST['therapist_id'];
            $appointment_date = $_POST['appointment_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $status = 'pending';
        
          // Check therapist availability
          $check_sql = "SELECT * FROM availability WHERE therapist_id = $therapist_id
            AND date = '$appointment_date'";
          $check_result = $conn -> query($check_sql);
          $therapist_availability = false;

          if ($check_result -> num_rows > 0) {
            while ($row = $check_result -> fetch_assoc()) {
              if ($start_time >= $row['start_time'] && $end_time <= $row['end_time']) {
                $therapist_availability = true;
                break;
              }
            }
          }
          
          // if ($conn -> query($check_sql)) {
          //     echo "Appointment created successfully! Please wait for our confirmation.";
          // } else {
          //     echo "Error creating appointment: " . $conn -> error . ". Please try again.";
          // }

          // if ($therapist_availability) {
            // Therapist is available, so add appointment to database
            
            
      
          if ($therapist_availability) {
            // Get user details
            $user_sql = "SELECT full_name, email FROM users WHERE user_id = $user_id";
            $user_result = $conn -> query($user_sql);
            $user_row = $user_result -> fetch_assoc();
            $full_name = $user_row['full_name'];
            $email = $user_row['email'];

            // Match services
            $service_sql = "SELECT service_name FROM services WHERE service_id = $service_id";
            $service_result = $conn -> query($service_sql);
            $service_row = $service_result -> fetch_assoc();
            $service_name = $service_row['service_name'];

            // Match therapist
            $therapist_sql = "SELECT full_name FROM users WHERE user_id = $therapist_id";
            $therapist_result = $conn -> query($therapist_sql);
            $therapist_row = $therapist_result -> fetch_assoc();
            $therapist_name = $therapist_row['full_name'];

            // Match status
            switch ($status) {
              case 'pending':
                  $appointment_status = 'Pending';
                  break;
              case 'confirmed':
                  $appointment_status = 'Confirmed';
                  break;
              case 'cancelled':
                  $appointment_status = 'Canceled';
                  break;
              default:
                  $appointment_status = 'Completed';
            }

            // Therapist is available, so add appointment to database
            $add_sql = "INSERT INTO appointments (user_id, service_id, therapist_id, appointment_date, start_time, end_time, status)
            VALUES ($user_id, $service_id, $therapist_id, '$appointment_date', '$start_time', '$end_time', '$status')";
    
            if ($conn -> query($add_sql)) {
                echo "<br>";
                echo "Appointment created successfully! Please wait for our confirmation.";
                echo "<br>";
                echo "<p>Customer Name: " . $full_name . "</p>";
                echo "<p>Customer Email: " . $email . "</p>";
                echo "<p>Service: " . $service_name . "</p>";
                echo "<p>Therapist: " . $therapist_name . "</p>";
                echo "<p>Appointment Date: " . $appointment_date . "</p>";
                echo "<p>Start Time: " . $start_time . "</p>";
                echo "<p>Expected End Time: " . $end_time . "</p>";
                echo "<p>Appointment Status: " . $appointment_status . "</p>";
            } else {
                echo "Error creating appointment: " . $conn -> error . ". Please try again.";
            }
          } else {
            // Therapist is unavailable
            echo "Sorry, the therapist is not available at that time.";
            exit;
          }
        $conn -> close();
      }
      ?>

    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
  </body>
</html>