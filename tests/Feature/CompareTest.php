<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompareTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_add_car_to_compare_list(): void
    {
        $car = Car::query()->create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'slug' => 'toyota-camry',
            'year' => 2024,
            'price' => 3000000,
            'description' => 'Описание',
            'image' => 'https://example.com/car.jpg',
        ]);

        $response = $this->post(route('cars.compare.store', $car));

        $response->assertRedirect();
        $response->assertSessionHas('compare_cars', [$car->id]);
    }

    public function test_compare_page_shows_selected_cars(): void
    {
        $car = Car::query()->create([
            'brand' => 'BMW',
            'model' => 'X5',
            'slug' => 'bmw-x5',
            'year' => 2023,
            'price' => 6000000,
            'description' => 'Описание',
            'image' => 'https://example.com/bmw.jpg',
        ]);

        $response = $this->withSession(['compare_cars' => [$car->id]])->get(route('cars.compare'));

        $response->assertOk();
        $response->assertSee('BMW X5');
    }

    public function test_compare_list_is_limited_to_three_cars(): void
    {
        $cars = collect(range(1, 4))->map(function (int $number) {
            return Car::query()->create([
                'brand' => 'Brand',
                'model' => "Model {$number}",
                'slug' => "car-{$number}",
                'year' => 2024,
                'price' => 1000000 * $number,
                'description' => 'Описание',
                'image' => 'https://example.com/car.jpg',
            ]);
        });

        $session = ['compare_cars' => $cars->take(3)->pluck('id')->all()];

        $response = $this->withSession($session)->post(route('cars.compare.store', $cars[3]));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }
}
