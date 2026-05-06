<?php
require __DIR__ . '/vendor/autoload.php';

$uri = 'mongodb+srv://manveersingh:100121@proappoint.m2kipdf.mongodb.net/farmgrid_db';

try {
    $client = new MongoDB\Client($uri);

    // Try to get server info
    $admin = $client->admin;
    $result = $admin->command(['ping' => 1]);

    echo "✅ SUCCESS! Connected to MongoDB Atlas\n";
    echo "Database: farmgrid_db\n";
    echo "Response: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

    // List databases
    $databases = $client->listDatabases();
    echo "\n📊 Available Databases:\n";
    foreach ($databases as $database) {
        echo "  - " . $database['name'] . "\n";
    }

} catch (Exception $e) {
    echo "❌ FAILED to connect to MongoDB Atlas\n";
    echo "Error: " . $e->getMessage() . "\n";
}
?>