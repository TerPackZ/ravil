<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class AdminCache
{
    public static function forgetPendingCounts(): void
    {
        Cache::forget('admin.pending_applications');
        Cache::forget('admin.pending_test_drives');
    }
}
