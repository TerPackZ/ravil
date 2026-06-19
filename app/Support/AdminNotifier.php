<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminNotifier
{
    public static function email(): string
    {
        return (string) config('mail.admin_address');
    }

    public static function notify(mixed $mailable): void
    {
        if (! self::exists()) {
            Log::warning('Admin notification skipped: no admin user or mail.admin_address configured.');

            return;
        }

        Mail::to(self::email())->send($mailable);
    }

    public static function exists(): bool
    {
        return User::query()->where('is_admin', true)->exists()
            || filled(config('mail.admin_address'));
    }
}
