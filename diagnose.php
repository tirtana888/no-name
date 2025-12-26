<?php
/**
 * Laravel Boot Diagnostic Script
 * This will help identify where Laravel is failing
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Laravel Boot Diagnostic</h2>";

// Step 1: Check vendor autoload
echo "<h3>Step 1: Checking vendor autoload</h3>";
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    echo "✓ vendor/autoload.php exists<br>";
    try {
        require $autoloadPath;
        echo "✓ Autoloader loaded successfully<br>";
    } catch (Exception $e) {
        echo "✗ Autoloader error: " . $e->getMessage() . "<br>";
        exit;
    } catch (Error $e) {
        echo "✗ Autoloader fatal error: " . $e->getMessage() . "<br>";
        exit;
    }
} else {
    echo "✗ vendor/autoload.php NOT found<br>";
    exit;
}

// Step 2: Check bootstrap/app.php
echo "<h3>Step 2: Checking bootstrap/app.php</h3>";
$appPath = __DIR__ . '/../bootstrap/app.php';
if (file_exists($appPath)) {
    echo "✓ bootstrap/app.php exists<br>";
    try {
        $app = require $appPath;
        echo "✓ App bootstrapped successfully<br>";
    } catch (Exception $e) {
        echo "✗ Bootstrap error: " . $e->getMessage() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
        exit;
    } catch (Error $e) {
        echo "✗ Bootstrap fatal error: " . $e->getMessage() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
        exit;
    }
} else {
    echo "✗ bootstrap/app.php NOT found<br>";
    exit;
}

// Step 3: Check Kernel
echo "<h3>Step 3: Checking HTTP Kernel</h3>";
try {
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✓ Kernel created successfully<br>";
} catch (Exception $e) {
    echo "✗ Kernel error: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    exit;
} catch (Error $e) {
    echo "✗ Kernel fatal error: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    exit;
}

// Step 4: Check config loading
echo "<h3>Step 4: Checking config</h3>";
try {
    $config = $app->make('config');
    echo "✓ Config loaded<br>";
    echo "App Name: " . $config->get('app.name', 'N/A') . "<br>";
    echo "App Env: " . $config->get('app.env', 'N/A') . "<br>";
} catch (Exception $e) {
    echo "✗ Config error: " . $e->getMessage() . "<br>";
    exit;
} catch (Error $e) {
    echo "✗ Config fatal error: " . $e->getMessage() . "<br>";
    exit;
}

// Step 5: Check database connection
echo "<h3>Step 5: Checking database</h3>";
try {
    $db = $app->make('db');
    $pdo = $db->connection()->getPdo();
    echo "✓ Database connected<br>";
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "<br>";
} catch (Error $e) {
    echo "✗ Database fatal error: " . $e->getMessage() . "<br>";
}

// Step 6: Check routes
echo "<h3>Step 6: Checking routes</h3>";
try {
    $router = $app->make('router');
    $routes = $router->getRoutes();
    echo "✓ Router loaded with " . $routes->count() . " routes<br>";
} catch (Exception $e) {
    echo "✗ Router error: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "✗ Router fatal error: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<h3>Diagnostic Complete</h3>";
echo "If you see all ✓ marks, the basic Laravel setup is working.<br>";
echo "The issue might be in middleware or specific route handlers.";
