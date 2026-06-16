<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_car_to_favorites(): void
    {
        $user = User::factory()->create();
        $car = Car::query()->create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'slug' => 'toyota-camry',
            'year' => 2024,
            'price' => 3000000,
            'description' => 'Описание',
            'image' => 'https://example.com/car.jpg',
        ]);

        $response = $this->actingAs($user)->post(route('favorites.store', $car));

        $response->assertRedirect();
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }

    public function test_user_can_remove_car_from_favorites(): void
    {
        $user = User::factory()->create();
        $car = Car::query()->create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'slug' => 'toyota-camry',
            'year' => 2024,
            'price' => 3000000,
            'description' => 'Описание',
            'image' => 'https://example.com/car.jpg',
        ]);

        $user->favoriteCars()->attach($car->id);

        $response = $this->actingAs($user)->delete(route('favorites.destroy', $car));

        $response->assertRedirect();
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }
}
