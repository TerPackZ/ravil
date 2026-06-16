<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_page_is_available(): void
    {
        Car::query()->create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'slug' => 'toyota-camry-2024',
            'year' => 2024,
            'price' => 3000000,
            'description' => 'Тестовый автомобиль',
            'image' => 'https://example.com/car.jpg',
        ]);

        $response = $this->get('/catalog');

        $response->assertOk();
        $response->assertSee('Toyota Camry');
    }

    public function test_catalog_search_filters_cars(): void
    {
        Car::query()->create([
            'brand' => 'BMW',
            'model' => 'X5',
            'slug' => 'bmw-x5',
            'year' => 2023,
            'price' => 6000000,
            'description' => 'Премиальный кроссовер',
            'image' => 'https://example.com/bmw.jpg',
        ]);

        Car::query()->create([
            'brand' => 'Kia',
            'model' => 'Rio',
            'slug' => 'kia-rio',
            'year' => 2022,
            'price' => 1500000,
            'description' => 'Городской седан',
            'image' => 'https://example.com/kia.jpg',
        ]);

        $response = $this->get('/catalog?search=BMW');

        $response->assertOk();
        $response->assertSee('BMW X5');
        $response->assertDontSee('Kia Rio');
    }
}
