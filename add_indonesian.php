<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Get current user_languages setting
$settings = DB::table('settings')->where('name', 'user_languages')->first();
echo "Current setting ID: " . ($settings ? $settings->id : "NOT FOUND") . "\n";

if ($settings) {
    $translation = DB::table('setting_translations')
        ->where('setting_id', $settings->id)
        ->first();
    echo "Current value: " . ($translation ? $translation->value : "EMPTY") . "\n";

    if ($translation && $translation->value) {
        $languages = json_decode($translation->value, true);
        if (!is_array($languages)) {
            $languages = unserialize($translation->value);
        }
        print_r($languages);

        // Add Indonesian if not exists
        if (!in_array('id', $languages)) {
            $languages[] = 'id';
            $newValue = json_encode($languages);

            DB::table('setting_translations')
                ->where('setting_id', $settings->id)
                ->update(['value' => $newValue]);

            echo "\n\nIndonesian (id) added! New value: " . $newValue . "\n";
        } else {
            echo "\n\nIndonesian already exists in languages list!\n";
        }
    }
} else {
    echo "user_languages setting not found\n";
}
