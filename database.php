<?php
    // Initialization and declaration of variables
    $servername = "localhost";
    $username = "root";
    $password = "Deuter0n0my318";
    $databasename = "establishment_db";

    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Catch connection errors
    if ($conn -> connect_error) {
        die ("MySQL database connection failed: " . $conn -> connect_error);
    }

    // Create the database if it doesn't exist
    $db = "CREATE DATABASE IF NOT EXISTS $databasename";
    if ($conn->query($db) === TRUE) {
        // echo "Database created successfully or already exists.<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }

    // Select the database
    $conn->select_db($databasename);

    // Read the SQL file
    $sqlFile = __DIR__ . '/sql_initial_setup.sql';
    $sqlCommands = file_get_contents($sqlFile);

    // Split the commands into individual SQL statements
    $sqlStatements = explode(';', $sqlCommands);

    // Execute each SQL statement
    foreach ($sqlStatements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            if ($conn->query($statement) === TRUE) {
                // echo "SQL statement executed successfully: $statement<br>";
            } else {
                // echo "Error executing statement: " . $conn->error . "<br>";
            }
        }
    }

    // echo "Database setup complete.";

    // $conn->close();
?>