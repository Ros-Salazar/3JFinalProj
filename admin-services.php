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
                                <button type='submit' id='editServiceButton' name='action' value='' class='btn btn-outline-primary'>Edit</button>
                                <button type='submit' name='action' value='delete' class='btn btn-outline-danger'>Delete</button>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>    

    <!-- <div id="editServiceForm" style="display: none;">
        <h3 style="margin-top: 20px;">Edit Service</h3>
        <div class="admin-dashboard-card" style="max-width: 800px;">
            <form method="POST" class="form" style="width: 750px;">
                <?php // Fetch all services
                $sql = "SELECT * FROM services WHERE service_id = '" . $_POST['service_id'] . "'";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc()
                ?>
                <div class="mb-3">
                    <label for="service_name" class="form-label">Service Name</label>
                    <input type="text" value="<?php echo $row['service_name']; ?>" class="form-control" id="service_name" name="service_name" placeholder="Service Name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" value="<?php echo $row['description']; ?>" id="description" name="description" placeholder="Description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" value="<?php echo $row['price']; ?>" class="form-control" id="price" name="price" placeholder="Price" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (minutes)</label>
                    <input type="number" value="<?php echo $row['duration']; ?>" class="form-control" id="duration" name="duration" placeholder="Duration (minutes)" required>
                </div>
                <button type="submit" name="action" value="edit" class="btn btn-primary">Update Service</button>
            </form>
        </div>
    </div> -->

    <button id="addServiceButton" type="submit" name="action" value="blank" class="btn btn-outline-primary" style="margin-top: 20px;">Add New Service</button>
    <div id="addServiceForm" style="display: none;">
        <h3 style="margin-top: 20px;">Add New Service</h3>
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
    </div>    
</section>

<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="service_id" id="edit_service_id">
                    <div class="mb-3">
                        <label for="edit_service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="edit_service_name" name="service_name" placeholder="Service Name" required>
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
                    <button type="submit" name="action" value="edit" class="btn btn-primary">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Handle add, edit, delete service actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Add new service
    if ($action == 'add') {
        $service_name = $_POST['service_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];

        $add_sql = "INSERT INTO services (service_name, description, price, duration) VALUES ('$service_name', '$description', '$price', '$duration')";
        if ($conn->query($add_sql)) {
            echo "<br><div class='alert alert-success'>Service added successfully!</div>";
            // echo "<script>{window.location.href = 'dashboard-admin.php#services';}</script>";
        } else {
            echo "<br><div class='alert alert-danger'>Failed to add service. Please try again.</div>";
        }
    }

    // Edit new service
    if ($action == 'edit') {
        $new_service_name = $_POST['service_name'];
        $new_description = $_POST['description'];
        $new_price = $_POST['price'];
        $new_duration = $_POST['duration'];

        $edit_sql = "UPDATE services SET service_name = $new_service_name, description = $new_description, price = $new_price, duration = '$new_duration' WHERE service_id = $service_id";
        if ($conn->query($edit_sql)) {
            echo "<br><div class='alert alert-success'>Service edited successfully!</div>";
            echo "<script>
                setTimeout(function() {window.location.href = 'dashboard-admin.php#services';}, 100);
            </script>"; // Refresh page to see new service
        } else {
            echo "<br><div class='alert alert-danger'>Failed to edit service. Please try again.</div>";
        }
    }

    // Delete service
    if ($action == 'delete') {
        $service_id = $_POST['service_id'];

        $delete_sql = "DELETE FROM services WHERE service_id = $service_id";
        if ($conn->query($delete_sql)) {
            echo "<br><div class='alert alert-success'>Service deleted successfully!</div>";
            // echo "<script>{window.location.href = 'dashboard-admin.php#services';}</script>"; // Refresh page to see new service
        } else {
            echo "<br><div class='alert alert-danger'>Failed to delete service. Please try again.</div>";
        }
    }
}
?>

<script>
    document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.dataset.id;

        // Fetch service details using AJAX or PHP and populate the modal form
        fetch('fetch_service.php', {
            method: 'POST',
            body: new URLSearchParams({
                service_id: serviceId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Handle error, e.g., display an error message
            } else {
                document.getElementById('edit_service_id').value = data.service_id;
                document.getElementById('edit_service_name').value = data.service_name;                                                                                              
                document.getElementById('edit_description').value = data.description;
                document.getElementById('edit_price').value = data.price;
                document.getElementById('edit_duration').value = data.duration;

                // Show the modal
                const editServiceModal = new bootstrap.Modal(document.getElementById('editServiceModal'));
                editServiceModal.show();
            }
        })
        .catch(error => {
            console.error('Error fetching service data:', error);
        });
    });
});
</script>