<?php

namespace App\Http\Controllers;

use App\Enums\TestDriveStatus;
use App\Mail\NewTestDriveMail;
use App\Models\TestDrive;
use App\Models\User;
use App\Support\AdminCache;
use App\Support\AdminNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestDriveController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'car_id' => ['required', 'exists:cars,id'],
            'scheduled_for' => [
                'required',
                'date',
                'after:'.now()->addHour()->toDateTimeString(),
                'before:'.now()->addMonths(3)->toDateTimeString(),
            ],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $testDrive = DB::transaction(function () use ($request, $validated) {
            User::query()->whereKey($request->user()->id)->lockForUpdate()->first();

            $hasActiveTestDrive = TestDrive::query()
                ->where('user_id', $request->user()->id)
                ->where('car_id', $validated['car_id'])
                ->whereIn('status', TestDriveStatus::activeValues())
                ->lockForUpdate()
                ->exists();

            if ($hasActiveTestDrive) {
                return null;
            }

            return TestDrive::query()->create([
                'user_id' => $request->user()->id,
                'car_id' => $validated['car_id'],
                'scheduled_for' => $validated['scheduled_for'],
                'comment' => $validated['comment'] ?? null,
                'status' => TestDriveStatus::New,
            ]);
        });

        if ($testDrive === null) {
            return back()->with('error', 'У вас уже есть активная запись на тест-драйв для этого автомобиля.');
        }

        AdminCache::forgetPendingCounts();
        AdminNotifier::notify(new NewTestDriveMail($testDrive->load(['user', 'car'])));

        return back()->with('success', 'Запись на тест-драйв оформлена.');
    }
}
