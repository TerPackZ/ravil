<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_submit_application(): void
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

        $response = $this->actingAs($user)->post("/catalog/{$car->slug}/apply", [
            'message' => 'Хочу купить',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'user_id' => $user->id,
            'car_id' => $car->id,
            'message' => 'Хочу купить',
            'status' => 'new',
        ]);
    }

    public function test_user_cannot_submit_duplicate_active_application(): void
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

        $this->actingAs($user)->post("/catalog/{$car->slug}/apply");

        $response = $this->actingAs($user)->post("/catalog/{$car->slug}/apply");

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('applications', 1);
    }

    public function test_admin_can_update_application_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
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

        $application = Application::query()->create([
            'user_id' => $user->id,
            'car_id' => $car->id,
            'status' => ApplicationStatus::New,
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.applications.update', $application), [
            'status' => ApplicationStatus::InProgress->value,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => 'in_progress',
        ]);
    }
}
