<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ApplicationStatus;
use App\Enums\TestDriveStatus;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Car;
use App\Models\ContactMessage;
use App\Models\TestDrive;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'cars' => Car::query()->count(),
                'users' => User::query()->where('is_admin', false)->count(),
                'applications_new' => Application::query()->where('status', ApplicationStatus::New)->count(),
                'test_drives_new' => TestDrive::query()->where('status', TestDriveStatus::New)->count(),
                'contact_messages' => ContactMessage::query()->count(),
                'favorites' => DB::table('favorites')->count(),
            ],
            'recentApplications' => Application::query()->with(['user', 'car'])->latest()->take(5)->get(),
            'recentTestDrives' => TestDrive::query()->with(['user', 'car'])->latest()->take(5)->get(),
            'popularCars' => Car::query()
                ->withCount('applications')
                ->orderByDesc('applications_count')
                ->take(5)
                ->get(),
        ]);
    }
}
