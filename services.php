<!-- services.php -->




<!-- services frontend -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
</head>
<body>
    <!-- Display services -->
    <h2>Services</h2>

    <!-- Greet user -->
    <h2>Welcome!</h2>

    <br> <br>

    <!-- Filter Form; Just an experiment-->
    <form method="GET" action="services.php">
        <label for="service_type">Service Type:</label>
        <input type="text" name="service_type" id="service_type" value="<?= htmlspecialchars($_GET['service_type'] ?? '') ?>">
        <br>
        <label for="min_price">Min Price:</label>
        <input type="number" name="min_price" id="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
        
        <label for="max_price">Max Price:</label>
        <input type="number" name="max_price" id="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
        <br>
        <label for="duration">Duration:</label>
        <input type="number" name="duration" id="duration" value="<?= htmlspecialchars($_GET['duration'] ?? '') ?>">
        <br>
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="">Default</option>
            <option value="popularity" <?= ($_GET['sort'] ?? '') == 'popularity' ? 'selected' : '' ?>>Popularity</option>
            <option value="price" <?= ($_GET['sort'] ?? '') == 'price' ? 'selected' : '' ?>>Price</option>
            <option value="duration" <?= ($_GET['sort'] ?? '') == 'duration' ? 'selected' : '' ?>>Duration</option>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <br> <br>

    <!-- Service Cards; Also just an experiment -->
    <?php
        // Connect to database
        include 'database.php';

        // For debugging
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // Get services query
        $services_sql = "SELECT * FROM services WHERE 1=1";

        // Apply filters
        if (!empty($_GET['service_type'])) {
            $service_type = $conn->real_escape_string($_GET['service_type']);
            $services_sql .= " AND service_name LIKE '%$service_type%'";
        }

        if (!empty($_GET['min_price'])) {
            $min_price = $conn->real_escape_string($_GET['min_price']);
            $services_sql .= " AND price >= $min_price";
        }

        if (!empty($_GET['max_price'])) {
            $max_price = $conn->real_escape_string($_GET['max_price']);
            $services_sql .= " AND price <= $max_price";
        }

        if (!empty($_GET['duration'])) {
            $duration = $conn->real_escape_string($_GET['duration']);
            $services_sql .= " AND duration = $duration";
        }

        // Apply sorting
        $orderBy = "service_name ASC"; // Default sorting is alphabetical
        if (!empty($_GET['sort'])) {
            if ($_GET['sort'] == 'price') {
                $orderBy = "price ASC";
            } elseif ($_GET['sort'] == 'duration') {
                $orderBy = "duration ASC";
            } elseif ($_GET['sort'] == 'popularity') {
                $orderBy = "service_name ASC"; //How do we do this popularity filter bruuuh
            }
        }
        $services_sql .= " ORDER BY $orderBy";

        // Fetch data
        $services_result = $conn->query($services_sql);
        
        if ($services_result && $services_result->num_rows > 0) {
            while ($row = $services_result->fetch_assoc()) {
                echo "<div class='service-card'>";
                // echo "<img src='placeholder.jpg' alt='Service Image'>";
                echo "<h2>" . htmlspecialchars($row['service_name']) . "</h2>";
                echo "<p><strong>Price: </strong>" . htmlspecialchars($row['price']) . "</p>";
                echo "<p><strong>Duration: </strong>" . htmlspecialchars($row['duration']) . " mins</p>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "No Services Found";
        }
    ?>

    <br> <br>

    <!-- Book Now -->
    <p><a href="booking.php">Book Now</a></p>

    <!-- Quick back to home while developing -->
    <br><br><br>
    <p><a href="index.php">Home</a></p>
</body>
</html>