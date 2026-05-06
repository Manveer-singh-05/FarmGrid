<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'farmgrid_db';

try {
    // Connect to MySQL without specifying database
    $conn = new mysqli($host, $user, $password);

    if ($conn->connect_error) {
        echo "❌ Connection Failed: " . $conn->connect_error . "\n";
        exit(1);
    }

    echo "✅ Connected to MySQL Server\n";

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS " . $database;
    if ($conn->query($sql) === TRUE) {
        echo "✅ Database '$database' created/exists successfully\n";
    } else {
        echo "❌ Error creating database: " . $conn->error . "\n";
        exit(1);
    }

    $conn->close();
    echo "✅ MySQL Setup Complete!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>