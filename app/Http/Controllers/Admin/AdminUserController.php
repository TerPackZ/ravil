<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->latest()->paginate(20),
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $willBeAdmin = $request->boolean('is_admin');

        if ($user->is_admin && ! $willBeAdmin) {
            if (User::query()->where('is_admin', true)->count() <= 1) {
                return back()->with('error', 'Нельзя снять права у последнего администратора.');
            }

            if (auth()->id() === $user->id) {
                return back()->with('error', 'Нельзя снять права администратора у самого себя.');
            }
        }

        $user->fill(collect($validated)->except('is_admin')->all());
        $user->is_admin = $willBeAdmin;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Пользователь обновлен.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Нельзя удалить собственную учетную запись.');
        }

        if ($user->is_admin && User::query()->where('is_admin', true)->count() <= 1) {
            return back()->with('error', 'Нельзя удалить последнего администратора.');
        }

        $user->delete();

        return back()->with('success', 'Пользователь удален.');
    }
}
