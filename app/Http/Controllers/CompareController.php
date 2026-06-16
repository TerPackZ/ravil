<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompareController extends Controller
{
    private const MAX_CARS = 3;

    public function index(Request $request): View
    {
        $ids = self::syncSessionIds($request);

        $cars = Car::query()
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn (Car $car) => array_search($car->id, $ids, true));

        return view('cars.compare', [
            'cars' => $cars,
        ]);
    }

    public function store(Request $request, Car $car): RedirectResponse
    {
        $ids = self::syncSessionIds($request);

        if (in_array($car->id, $ids, true)) {
            return back()->with('error', 'Этот автомобиль уже добавлен в сравнение.');
        }

        if (count($ids) >= self::MAX_CARS) {
            return back()->with('error', 'Можно сравнить не более '.self::MAX_CARS.' автомобилей.');
        }

        $ids[] = $car->id;
        $request->session()->put('compare_cars', $ids);

        return back()->with('success', 'Автомобиль добавлен в сравнение.');
    }

    public function destroy(Request $request, Car $car): RedirectResponse
    {
        $ids = array_values(array_filter(
            self::syncSessionIds($request),
            fn (int $id) => $id !== $car->id
        ));

        $request->session()->put('compare_cars', $ids);

        return back()->with('success', 'Автомобиль убран из сравнения.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('compare_cars');

        return redirect()->route('cars.index')->with('success', 'Список сравнения очищен.');
    }

    /** @return list<int> */
    public static function idsFromSession(Request $request): array
    {
        return self::sanitizeIds(
            (array) $request->session()->get('compare_cars', [])
        );
    }

    /** @return list<int> */
    private static function syncSessionIds(Request $request): array
    {
        $ids = self::sanitizeIds(
            (array) $request->session()->get('compare_cars', [])
        );

        $request->session()->put('compare_cars', $ids);

        return $ids;
    }

    /** @param list<int|string> $rawIds
     * @return list<int>
     */
    private static function sanitizeIds(array $rawIds): array
    {
        $ids = array_values(array_unique(array_filter(
            array_map('intval', $rawIds),
            fn (int $id) => $id > 0
        )));

        if ($ids === []) {
            return [];
        }

        $existing = Car::query()->whereIn('id', $ids)->pluck('id')->map(fn ($id) => (int) $id)->all();

        return array_values(array_filter(
            $ids,
            fn (int $id) => in_array($id, $existing, true)
        ));
    }
}
