<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request, Car $car): RedirectResponse
    {
        $request->user()->favoriteCars()->syncWithoutDetaching([$car->id]);

        return back()->with('success', 'Автомобиль добавлен в избранное.');
    }

    public function destroy(Request $request, Car $car): RedirectResponse
    {
        $request->user()->favoriteCars()->detach($car->id);

        return back()->with('success', 'Автомобиль удалён из избранного.');
    }
}
