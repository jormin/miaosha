<?php

return [
    'prefix' => [
        'activity_info' => env('REDIS_PREFIX_ACTIVITY_INFO'),
        'activity_stock' => env('REDIS_PREFIX_ACTIVITY_STOCK'),
        'activity_all_user_ids' => env('REDIS_PREFIX_ACTIVITY_ALL_USER_IDS'),
        'activity_success_user_ids' => env('REDIS_PREFIX_ACTIVITY_SUCCESS_USER_IDS'),
        'activity_queue' => env('REDIS_PREFIX_ACTIVITY_QUEUE'),
    ]
];