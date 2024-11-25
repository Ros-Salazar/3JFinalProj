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
  <select name="service" id="service">
    </select>

  <label for="therapist">Select Therapist:</label>
  <select name="therapist" id="therapist">
    </select>

  <label for="date">Select Date:</label>
  <input type="date" name="date" id="date">

  <label for="time">Select Time:</label>
  <select name="time" id="time">
    </select>

  <button type="submit">Confirm Appointment</button>

</form>
</body>
</html>