<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->loadCount('orders');

        $orders = $user->orders()
            ->withCount('orderItems')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.users.show', compact('user', 'orders'));
    }

    public function updateRole(
        Request $request,
        User $user
    ): RedirectResponse {
        $validated = $request->validate([
            'role' => ['required', 'in:admin,user'],
        ]);

        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()->with(
                'error',
                'You cannot remove your own admin access.'
            );
        }

        $user->update([
            'role' => $validated['role'],
        ]);

        return back()->with(
            'success',
            'User role updated successfully.'
        );
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot delete your own account from the admin panel.'
            );
        }

        if ($user->orders()->exists()) {
            return back()->with(
                'error',
                'This user cannot be deleted because they have existing orders.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully.'
        );
    }
}