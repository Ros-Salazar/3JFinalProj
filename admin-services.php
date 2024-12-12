<section id="services" style="margin-top: 40px;">
    <div class="admin-section-header">
        <h1>Manage Services</h1>
    </div>
    <div class="admin-dashboard-card">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="col-md-2">Service Name</th>
                    <th class="col-md-4">Description</th>
                    <th class="col-md-2">Price</th>
                    <th class="col-md-2">Duration</th>
                    <th class="col-md-2">Actions</th>
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
                                <button type='submit' name='action' value='edit' class='btn btn-outline-primary'>Edit</button>
                                <button type='submit' name='action' value='delete' class='btn btn-outline-danger'>Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>    

    <h3>Add New Service</h3>
    <div class="admin-dashboard-card" style="max-width: 800px;">
        <form method="POST" class="form" style="width: 750px;">
            <div class="mb-3">
                <label for="service_name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Service Name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration (minutes)</label>
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration (minutes)" required>
            </div>
            <button type="submit" name="action" value="add" class="btn btn-primary">Add Service</button>
        </form>
    </div>    
</section>