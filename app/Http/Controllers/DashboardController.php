<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load([
            'applications.car',
            'testDrives.car',
            'favoriteCars',
        ]);

        return view('dashboard.index', compact('user'));
    }
}
