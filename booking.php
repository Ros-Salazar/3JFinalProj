<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<body>
<form action="process_booking.php" method="POST">
  <label for="service">Select Service:</label>
  <select name="service_id" id="service_id" required>
    <optgroup label="Services"></optgroup>
    <option value="1">Swedish Massage</option>
    <option value="2">Sports Massage</option>
    <option value="3">Trigger Point Therapy</option>
    <option value="4">Deep Tissue Massage</option>
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
  <label for="date">Select Date:</label>
  <input type="date" name="appointment_date" id="appointment_date" required>
  <br>
  <label for="time">Select Time:</label>
  <input type="time" name="start_time" id="start_time" required>
<br>
  <button type="submit">Confirm Appointment</button>

  <?php
    // Connect to database
    include 'database.php';

    // Get booking details
    $booking_sql = "SELECT * FROM appointments";
  ?>

</form>
</body>
</html>