<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load([
            'applications' => fn ($query) => $query->with('car')->latest(),
            'testDrives' => fn ($query) => $query->with('car')->latest(),
            'favoriteCars' => fn ($query) => $query->orderByPivot('created_at', 'desc'),
        ]);

        return view('dashboard.index', compact('user'));
    }
}
