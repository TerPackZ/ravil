<?php

namespace App\Http\Controllers;

use App\Enums\TestDriveStatus;
use App\Mail\NewTestDriveMail;
use App\Models\TestDrive;
use App\Support\AdminNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestDriveController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'car_id' => ['required', 'exists:cars,id'],
            'scheduled_for' => ['required', 'date', 'after:now'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $hasActiveTestDrive = TestDrive::query()
            ->where('user_id', $request->user()->id)
            ->where('car_id', $validated['car_id'])
            ->whereIn('status', TestDriveStatus::activeValues())
            ->exists();

        if ($hasActiveTestDrive) {
            return back()->with('error', 'У вас уже есть активная запись на тест-драйв для этого автомобиля.');
        }

        $testDrive = TestDrive::query()->create([
            'user_id' => $request->user()->id,
            'car_id' => $validated['car_id'],
            'scheduled_for' => $validated['scheduled_for'],
            'comment' => $validated['comment'] ?? null,
            'status' => TestDriveStatus::New,
        ]);

        AdminNotifier::notify(new NewTestDriveMail($testDrive->load(['user', 'car'])));

        return back()->with('success', 'Запись на тест-драйв оформлена.');
    }
}
