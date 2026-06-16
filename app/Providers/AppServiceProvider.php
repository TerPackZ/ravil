<?php

namespace App\Providers;

use App\Http\Controllers\CompareController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'cars.*', 'dashboard.*', 'home.*', 'admin.*'], function ($view): void {
            $request = request();
            $compareIds = CompareController::idsFromSession($request);

            $view->with('compareCarIds', $compareIds);
            $view->with('compareCount', count($compareIds));
            $view->with('favoriteCarIds', auth()->check()
                ? auth()->user()->favoriteCars()->pluck('cars.id')->all()
                : []);
        });
    }
}
