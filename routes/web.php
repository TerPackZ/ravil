<?php

use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestDriveController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CarController::class, 'index'])->name('cars.index');
Route::get('/catalog/{car:slug}', [CarController::class, 'show'])->name('cars.show');
Route::post('/catalog/{car}/apply', [CarController::class, 'apply'])->middleware('auth')->name('cars.apply');
Route::get('/compare', [CompareController::class, 'index'])->name('cars.compare');
Route::post('/compare/{car}', [CompareController::class, 'store'])->name('cars.compare.store');
Route::delete('/compare/{car}', [CompareController::class, 'destroy'])->name('cars.compare.destroy');
Route::delete('/compare', [CompareController::class, 'clear'])->name('cars.compare.clear');

Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/test-drive', [TestDriveController::class, 'store'])->name('test-drives.store');
    Route::post('/favorites/{car}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{car}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::resource('cars', AdminCarController::class)->except('show');
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('news', AdminNewsController::class)->except('show');
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/applications/{application}', [AdminApplicationController::class, 'updateApplication'])->name('applications.update');
    Route::patch('/test-drives/{testDrive}', [AdminApplicationController::class, 'updateTestDrive'])->name('test-drives.update');
});
