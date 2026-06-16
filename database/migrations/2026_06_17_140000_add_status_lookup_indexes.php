<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table): void {
            $table->index(['user_id', 'car_id', 'status']);
            $table->index(['status', 'created_at']);
        });

        Schema::table('test_drives', function (Blueprint $table): void {
            $table->index(['user_id', 'car_id', 'status']);
            $table->index(['status', 'created_at']);
        });

        Schema::table('news', function (Blueprint $table): void {
            $table->index(['published_at']);
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table): void {
            $table->dropIndex(['user_id', 'car_id', 'status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('test_drives', function (Blueprint $table): void {
            $table->dropIndex(['user_id', 'car_id', 'status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('news', function (Blueprint $table): void {
            $table->dropIndex(['published_at']);
        });
    }
};
