<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index', [
            'featuredCars' => Car::query()->where('is_featured', true)->latest()->take(6)->get(),
            'latestNews' => News::query()->published()->latest('published_at')->take(3)->get(),
        ]);
    }
}
