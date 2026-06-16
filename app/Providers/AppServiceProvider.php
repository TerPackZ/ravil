<?php

namespace App\Providers;

use App\Enums\ApplicationStatus;
use App\Enums\TestDriveStatus;
use App\Http\Controllers\CompareController;
use App\Models\Application;
use App\Models\TestDrive;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
        Paginator::defaultView('vendor.pagination.default');

        View::composer(['layouts.admin', 'admin.partials.nav'], function ($view): void {
            $view->with('pendingApplications', Cache::remember(
                'admin.pending_applications',
                30,
                fn () => Application::query()->where('status', ApplicationStatus::New)->count()
            ));
            $view->with('pendingTestDrives', Cache::remember(
                'admin.pending_test_drives',
                30,
                fn () => TestDrive::query()->where('status', TestDriveStatus::New)->count()
            ));
        });

        View::composer(['layouts.app', 'cars.*', 'dashboard.*', 'home.*'], function ($view): void {
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
