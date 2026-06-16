<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table): void {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('slug')->unique();
            $table->year('year');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('mileage')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('color')->nullable();
            $table->text('description');
            $table->string('image');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
