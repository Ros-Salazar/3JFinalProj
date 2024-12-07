<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
  <body>
    <!-- Display services -->
     <h2>Services</h2>

     <!-- Greet user -->
     <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Start session
        session_start();

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
          header("Location: login.php");
          exit();
        } else {
          // User is logged in, display user's name
          echo "Welcome, ". $_SESSION['full_name']. "!";

          // Get user_id from session
          $user_id = $_SESSION['user_id'];
        }
    ?>

    <br> <br>

    <table>
        <tr>
            <th>Service Name</th>
            <th>Description</th>
            <th>Pricing</th>
        </tr>
        <?php
          // Connect to database
          include "database.php";

          // Get services
          $display_sql = "SELECT * FROM services";
          $display_result = $conn -> query($display_sql);

          if ($display_result -> num_rows > 0) {
              while ($display_row = $display_result -> fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $display_row['service_name'] . "</td>";
                  echo "<td>" . $display_row['description'] . "</td>";
                  echo "<td>". "PHP " . $display_row['price'] . " / ". $display_row['duration'] . " minutes" . "</td>";
                  echo "</tr>";
              };
          } else {
              echo "<tr><td colspan='3'>No Services</td></tr>";
          };
        ?>
        
    </table>

    <br> <br>

    <h3>Service and Therapist</h3>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
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

      <br> <br>

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

      <br> <br>

      <h3>Date and Time</h3>

      <label for="date">Select Appointment Date:</label>
      <input type="date" name="appointment_date" id="appointment_date" required>

      <br> <br>

      <label for="time">Select Start Time:</label>
      <input type="time" name="start_time" id="start_time" required>
      
      <br> <br>

      <label for="time">Select End Time:</label>
      <input type="time" name="end_time" id="end_time" required>

      <br> <br>

      <h3>Confirmation and Payment</h3>

      <label for="promo_code">Promo Code:</label>
      <input type="text" name="promo_code" id="promo_code" placeholder="Enter promo code">

      <br><br>

      <label for="payment_method">Payment Method:</label>
      <select name="payment_method" id="payment_method" required>
          <option value="cash">Cash</option>
          <option value="credit_card">Credit Card</option>
          <option value="paypal">PayPal</option>
      </select>

      <br><br>

      <button type="submit">Confirm Appointment</button>
    </form>

    <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Get user_id from session
        $user_id = $_SESSION['user_id'];
    
        // Get data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = 6;
            $service_id = $_POST['service_id'];
            $therapist_id = $_POST['therapist_id'];
            $appointment_date = $_POST['appointment_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $promo_code = $_POST['promo_code'];
            $payment_method = $_POST['payment_method'];
            $status = 'pending';

        // Validate promo code
        $discount = 0;
        if (!empty($promo_code)) {
            $promo_sql = "SELECT * FROM promotions WHERE promo_code = '$promo_code' AND start_date <= CURDATE() AND end_date >= CURDATE()";
            $promo_result = $conn->query($promo_sql);
            if ($promo_result->num_rows > 0) {
                $promo_row = $promo_result->fetch_assoc();
                $discount = $promo_row['discount_percent'];
                echo "<p>Promo applied: " . $promo_row['description'] . " (" . $discount . "% off)</p>";
            } else {
                echo "<p>Invalid promo code.</p>";
            }
        }    
        
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

          // // All details are valid, so add appointment to database
          // $add_sql = "INSERT INTO appointments (user_id, service_id, therapist_id, appointment_date, start_time, end_time, status)
          // VALUES ($user_id, $service_id, $therapist_id, '$appointment_date', '$start_time', '$end_time', '$status')";
  
          // if ($conn -> query($add_sql)) {
          //     echo "<br> <br>";
          //     echo "Appointment created successfully! Please wait for our confirmation.";
          //     echo "<br>";
          //     echo "<p>Customer Name: " . $full_name . "</p>";
          //     echo "<p>Customer Email: " . $email . "</p>";
          //     echo "<p>Service: " . $service_name . "</p>";
          //     echo "<p>Therapist: " . $therapist_name . "</p>";
          //     echo "<p>Appointment Date: " . date('F j, Y', strtotime($appointment_date)) . "</p>";
          //     echo "<p>Start Time: " . $start_time . "</p>";
          //     echo "<p>Expected End Time: " . $end_time . "</p>";
          //     echo "<p>Appointment Status: " . $appointment_status . "</p>";
          // } else {
          //     echo "Error creating appointment: " . $conn -> error . ". Please try again.";
          // }
        } else {
          // Therapist is unavailable
          echo "Sorry, the therapist is not available at that time.";
          exit;
        }

        // Calculate total price (fetch service price and apply discount)
        $service_sql = "SELECT price FROM services WHERE service_id = $service_id";
        $service_result = $conn->query($service_sql);
        if ($service_result->num_rows > 0) {
            $service_row = $service_result->fetch_assoc();
            $price = $service_row['price'];
            $final_price = $price - ($price * ($discount / 100));

            echo "<p>Total Cost: PHP " . number_format($final_price, 2) . "</p>";
        }

        // Insert appointment into database
        $add_sql = "INSERT INTO appointments (user_id, service_id, therapist_id, appointment_date, start_time, status)
                    VALUES ($user_id, $service_id, $therapist_id, '$appointment_date', '$start_time', 'pending')";
        if ($conn->query($add_sql)) {
            echo "<p>Appointment successfully created. Thank you for your booking!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }

        // $conn -> close();
      }
      ?>

    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
  </body>
</html>