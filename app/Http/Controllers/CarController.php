<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\TestDriveStatus;
use App\Mail\NewApplicationMail;
use App\Models\Application;
use App\Models\Car;
use App\Models\TestDrive;
use App\Support\AdminNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(Request $request): View
    {
        $query = Car::query();

        $query
            ->when($request->filled('search'), function ($builder) use ($request): void {
                $search = '%'.$request->string('search').'%';
                $builder->where(function ($nested) use ($search): void {
                    $nested->where('brand', 'like', $search)
                        ->orWhere('model', 'like', $search)
                        ->orWhere('description', 'like', $search);
                });
            })
            ->when($request->filled('brand'), fn ($builder) => $builder->where('brand', $request->string('brand')))
            ->when($request->filled('year'), fn ($builder) => $builder->where('year', $request->integer('year')))
            ->when($request->filled('price_from'), fn ($builder) => $builder->where('price', '>=', $request->integer('price_from')))
            ->when($request->filled('price_to'), fn ($builder) => $builder->where('price', '<=', $request->integer('price_to')))
            ->when($request->filled('transmission'), fn ($builder) => $builder->where('transmission', $request->string('transmission')))
            ->when($request->filled('mileage_to'), fn ($builder) => $builder->where('mileage', '<=', $request->integer('mileage_to')));

        $sort = $request->string('sort', 'latest')->toString();

        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'year_desc' => $query->orderByDesc('year'),
            'year_asc' => $query->orderBy('year'),
            default => $query->latest(),
        };

        return view('cars.index', [
            'cars' => $query->paginate(9)->withQueryString(),
            'brands' => Car::query()->select('brand')->distinct()->orderBy('brand')->pluck('brand'),
            'years' => Car::query()->select('year')->distinct()->orderByDesc('year')->pluck('year'),
            'transmissions' => Car::query()->select('transmission')->whereNotNull('transmission')->distinct()->orderBy('transmission')->pluck('transmission'),
            'filters' => $request->only(['search', 'brand', 'year', 'price_from', 'price_to', 'transmission', 'mileage_to', 'sort']),
        ]);
    }

    public function show(Car $car): View
    {
        return view('cars.show', [
            'car' => $car,
            'relatedCars' => Car::query()->whereKeyNot($car->id)->where('brand', $car->brand)->take(3)->get(),
            'hasActiveApplication' => auth()->check()
                ? Application::query()
                    ->where('user_id', auth()->id())
                    ->where('car_id', $car->id)
                    ->whereIn('status', ApplicationStatus::activeValues())
                    ->exists()
                : false,
            'hasActiveTestDrive' => auth()->check()
                ? TestDrive::query()
                    ->where('user_id', auth()->id())
                    ->where('car_id', $car->id)
                    ->whereIn('status', TestDriveStatus::activeValues())
                    ->exists()
                : false,
        ]);
    }

    public function apply(Request $request, Car $car): RedirectResponse
    {
        $hasActiveApplication = Application::query()
            ->where('user_id', $request->user()->id)
            ->where('car_id', $car->id)
            ->whereIn('status', ApplicationStatus::activeValues())
            ->exists();

        if ($hasActiveApplication) {
            return back()->with('error', 'У вас уже есть активная заявка на этот автомобиль.');
        }

        $validated = $request->validate([
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $application = Application::query()->create([
            'user_id' => $request->user()->id,
            'car_id' => $car->id,
            'message' => $validated['message'] ?? null,
            'status' => ApplicationStatus::New,
        ]);

        AdminNotifier::notify(new NewApplicationMail($application->load(['user', 'car'])));

        return back()->with('success', 'Заявка успешно отправлена.');
    }
}
