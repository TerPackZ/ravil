<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Support\ImageUploader;
use App\Support\SlugGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminCarController extends Controller
{
    public function index(): View
    {
        return view('admin.cars.index', [
            'cars' => Car::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cars.create', ['car' => new Car()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCar($request);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['slug'] = SlugGenerator::generate(
            $validated['brand'].'-'.$validated['model'].'-'.$validated['year'],
            Car::class
        );
        $validated['image'] = $this->resolveImage($request);

        Car::query()->create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Автомобиль добавлен.');
    }

    public function edit(Car $car): View
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car): RedirectResponse
    {
        $validated = $this->validateCar($request, true);
        $validated['is_featured'] = $request->boolean('is_featured');

        $slugSource = $validated['brand'].'-'.$validated['model'].'-'.$validated['year'];
        $currentSlugSource = $car->brand.'-'.$car->model.'-'.$car->year;

        if ($slugSource !== $currentSlugSource) {
            $validated['slug'] = SlugGenerator::generate($slugSource, Car::class, $car->id);
        }

        $validated['image'] = $this->resolveImage($request, $car->image);

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Автомобиль обновлен.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        if ($car->applications()->exists() || $car->testDrives()->exists()) {
            return back()->with('error', 'Нельзя удалить автомобиль, у которого есть заявки или записи на тест-драйв.');
        }

        ImageUploader::deleteIfLocal($car->image);
        $car->delete();

        return back()->with('success', 'Автомобиль удален.');
    }

    private function validateCar(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'price' => ['required', 'numeric', 'min:0'],
            'mileage' => ['nullable', 'integer', 'min:0'],
            'engine' => ['nullable', 'string', 'max:100'],
            'transmission' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:10000'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
            'image_url' => [$isUpdate ? 'nullable' : 'required_without:image', 'nullable', 'url'],
            'is_featured' => ['nullable', 'boolean'],
        ]);
    }

    private function resolveImage(Request $request, ?string $currentImage = null): string
    {
        $uploaded = ImageUploader::store($request->file('image'), 'cars', $currentImage);

        if ($uploaded) {
            return $uploaded;
        }

        if ($request->filled('image_url')) {
            if ($currentImage && $request->file('image') === null) {
                ImageUploader::deleteIfLocal($currentImage);
            }

            return $request->string('image_url')->toString();
        }

        if ($currentImage) {
            return $currentImage;
        }

        throw ValidationException::withMessages([
            'image' => 'Загрузите изображение или укажите ссылку.',
        ]);
    }
}
