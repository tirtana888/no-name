<?php
/**
 * Deep Laravel Bootstrap Diagnostic
 * Tests earlier in the boot sequence
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Deep Laravel Boot Diagnostic</h2>";
echo "<pre>";

// Step 1: Load autoloader
require __DIR__ . '/../vendor/autoload.php';
echo "[OK] Autoloader loaded\n";

// Step 2: Load the app manually
$app = new Illuminate\Foundation\Application(
    dirname(__DIR__)
);
echo "[OK] Application instance created\n";

// Step 3: Register core bindings  
echo "\n[INFO] Registering core bindings...\n";

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);
echo "[OK] HTTP Kernel registered\n";

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
echo "[OK] Console Kernel registered\n";

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
echo "[OK] Exception Handler registered\n";

// Step 4: Bootstrap the application
echo "\n[INFO] Bootstrapping application...\n";

$bootstrappers = [
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
];

foreach ($bootstrappers as $bootstrapper) {
    try {
        echo "Bootstrapping: " . $bootstrapper . "... ";
        $app->make($bootstrapper)->bootstrap($app);
        echo "[OK]\n";
    } catch (Exception $e) {
        echo "[ERROR] " . $e->getMessage() . "\n";
        echo "Stack trace: " . $e->getTraceAsString() . "\n";
        echo "</pre>";
        exit;
    } catch (Error $e) {
        echo "[FATAL ERROR] " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
        echo "Stack trace: " . $e->getTraceAsString() . "\n";
        echo "</pre>";
        exit;
    }
}

echo "\n[SUCCESS] All bootstrappers loaded!\n";
echo "[OK] Config service: " . ($app->bound('config') ? 'bound' : 'NOT bound') . "\n";
echo "[OK] App Name: " . config('app.name') . "\n";
echo "</pre>";
