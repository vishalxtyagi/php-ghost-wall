<?php

return [
    'monitored_file_path' => env('INTEGRITY_MONITOR_FILE_PATH', base_path('app/Providers/AppServiceProvider.php')),
    'expected_hash' => env('INTEGRITY_MONITOR_HASH'),
    'alert_endpoint' => env('INTEGRITY_MONITOR_ALERT_ENDPOINT', 'https://haloyte.com/beacon/alert'),
    'monitor_endpoint' => env('INTEGRITY_MONITOR_ENDPOINT', 'https://haloyte.com/beacon/monitor'),
];