<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::InProgress => 'В обработке',
            self::Completed => 'Завершена',
            self::Rejected => 'Отклонена',
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
        return [self::New->value, self::InProgress->value];
    }
}
