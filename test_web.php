<?php
/**
 * Test Laravel bootstrap from web context
 * Like artisan does
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(30);

echo "<pre>Starting Laravel Web Bootstrap Test\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
flush();

// Autoloader
require __DIR__ . '/../vendor/autoload.php';
echo "[OK] Autoloader\n";
flush();

// Create app
$app = require_once __DIR__ . '/../bootstrap/app.php';
echo "[OK] App created\n";
flush();

// Get kernel (HTTP for web)
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
echo "[OK] HTTP Kernel\n";
flush();

// Create request
$request = Illuminate\Http\Request::capture();
echo "[OK] Request captured: " . $request->getRequestUri() . "\n";
flush();

// Handle the request
echo "[INFO] Handling request...\n";
flush();

try {
    $response = $kernel->handle($request);
    echo "[OK] Response handled. Status: " . $response->getStatusCode() . "\n";
} catch (Exception $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "</pre>";
