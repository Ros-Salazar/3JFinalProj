<section id="services">
<h2>Manage Services</h2>
    <table>
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all services
            $sql = "SELECT * FROM services";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['service_name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['duration'] . " minutes</td>";
                echo "<td>
                        <form method='POST'>
                            <input type='hidden' name='service_id' value='" . $row['service_id'] . "'>
                            <button type='submit' name='action' value='edit'>Edit</button>
                            <button type='submit' name='action' value='delete'>Delete</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Add New Service</h3>
    <form method="POST">
        <input type="text" name="service_name" placeholder="Service Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="duration" placeholder="Duration (minutes)" required>
        <button type="submit" name="action" value="add">Add Service</button>
    </form>
</section>