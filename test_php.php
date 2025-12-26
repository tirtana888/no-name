<?php
// Simple test script to check PHP is working
echo "<h1>PHP is working!</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>ionCube Loaded: " . (extension_loaded('ionCube Loader') ? 'Yes' : 'No') . "</p>";
echo "<pre>";
print_r(get_loaded_extensions());
echo "</pre>";
