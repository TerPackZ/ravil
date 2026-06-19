<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredCars = Car::query()->where('is_featured', true)->latest()->take(6)->get();

        if ($featuredCars->isEmpty()) {
            $featuredCars = Car::query()->latest()->take(6)->get();
        }

        return view('home.index', [
            'featuredCars' => $featuredCars,
            'heroCar' => $featuredCars->first(),
            'carsCount' => Car::query()->count(),
            'latestNews' => News::query()->published()->latest('published_at')->take(3)->get(),
        ]);
    }
}
