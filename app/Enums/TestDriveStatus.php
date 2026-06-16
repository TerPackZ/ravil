<?php

namespace App\Enums;

enum TestDriveStatus: string
{
    case New = 'new';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::Confirmed => 'Подтверждена',
            self::Completed => 'Завершена',
            self::Cancelled => 'Отменена',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    /** @return list<string> */
    public static function activeValues(): array
    {
        return [self::New->value, self::Confirmed->value];
    }
}
