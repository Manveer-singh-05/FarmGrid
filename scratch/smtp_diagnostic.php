<?php

/**
 * SMTP Socket Diagnostic Script
 * Run this via: php scratch/smtp_diagnostic.php
 */

$host = 'smtp-relay.brevo.com';
$port = 587;
$timeout = 10;

echo "--- SMTP Diagnostic ---" . PHP_EOL;
echo "Testing connection to $host:$port..." . PHP_EOL;

$start = microtime(true);
$errno = 0;
$errstr = '';

$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

$duration = round(microtime(true) - $start, 3);

if (!$fp) {
    echo "FAILED: Could not connect to $host:$port" . PHP_EOL;
    echo "Error Number: $errno" . PHP_EOL;
    echo "Error Message: $errstr" . PHP_EOL;
    echo "Duration: {$duration}s" . PHP_EOL;
    echo "------------------------" . PHP_EOL;
    echo "RECOMMENDATION: If this is running on Render, ensure outbound SMTP is not blocked." . PHP_EOL;
} else {
    echo "SUCCESS: Connection established to $host:$port" . PHP_EOL;
    echo "Duration: {$duration}s" . PHP_EOL;
    
    // Try to read the initial response
    stream_set_timeout($fp, 5);
    $response = fgets($fp, 512);
    echo "Initial Response: " . trim($response) . PHP_EOL;
    
    fclose($fp);
    echo "------------------------" . PHP_EOL;
    echo "NEXT STEP: Since socket connection works, the hang might be during TLS negotiation or AUTH." . PHP_EOL;
}
