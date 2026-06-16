<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ApplicationStatus;
use App\Enums\TestDriveStatus;
use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusChangedMail;
use App\Mail\TestDriveStatusChangedMail;
use App\Models\Application;
use App\Models\ContactMessage;
use App\Models\TestDrive;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'application_status' => ['nullable', Rule::enum(ApplicationStatus::class)],
            'test_drive_status' => ['nullable', Rule::enum(TestDriveStatus::class)],
        ]);

        $applicationStatus = $validated['application_status'] ?? null;
        $testDriveStatus = $validated['test_drive_status'] ?? null;

        $applicationsQuery = Application::query()->with(['user', 'car'])->latest();
        $testDrivesQuery = TestDrive::query()->with(['user', 'car'])->latest();

        if ($applicationStatus !== null) {
            $applicationsQuery->where('status', $applicationStatus);
        }

        if ($testDriveStatus !== null) {
            $testDrivesQuery->where('status', $testDriveStatus);
        }

        return view('admin.applications.index', [
            'applications' => $applicationsQuery->paginate(10, ['*'], 'applications_page')->withQueryString(),
            'testDrives' => $testDrivesQuery->paginate(10, ['*'], 'test_drives_page')->withQueryString(),
            'contactMessages' => ContactMessage::query()->latest()->paginate(10, ['*'], 'messages_page')->withQueryString(),
            'applicationStatuses' => ApplicationStatus::options(),
            'testDriveStatuses' => TestDriveStatus::options(),
            'filters' => [
                'application_status' => $applicationStatus?->value ?? '',
                'test_drive_status' => $testDriveStatus?->value ?? '',
            ],
        ]);
    }

    public function updateApplication(Request $request, Application $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(ApplicationStatus::class)],
        ]);

        $previousStatus = $application->status;
        $application->update($validated);

        if ($previousStatus !== $application->status) {
            Mail::to($application->user->email)->send(
                new ApplicationStatusChangedMail($application->load(['user', 'car']))
            );
        }

        return back()->with('success', 'Статус заявки обновлён.');
    }

    public function updateTestDrive(Request $request, TestDrive $testDrive): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(TestDriveStatus::class)],
        ]);

        $previousStatus = $testDrive->status;
        $testDrive->update($validated);

        if ($previousStatus !== $testDrive->status) {
            Mail::to($testDrive->user->email)->send(
                new TestDriveStatusChangedMail($testDrive->load(['user', 'car']))
            );
        }

        return back()->with('success', 'Статус тест-драйва обновлён.');
    }
}
