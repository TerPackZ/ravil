<?php

namespace App\Models;

use App\Enums\TestDriveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestDrive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'scheduled_for',
        'comment',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_for' => 'datetime',
            'status' => TestDriveStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
