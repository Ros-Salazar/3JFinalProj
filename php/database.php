<?php
    // Initialization and declaration of variables
    $servername = "localhost";
    $username = "root";
    $password = "*****";
    $databasename = "establishment_db";

    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Catch connection errors
    if ($conn -> connect_error) {
        die ("MySQL database connection failed: " . $conn -> connect_error);
    }
?>