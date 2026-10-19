<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        if ($message->status === 'unread') {
            $message->update([
                'status' => 'read',
            ]);
        }

        return view(
            'admin.messages.show',
            compact('message')
        );
    }

    public function markAsRead(
        ContactMessage $message
    ): RedirectResponse {
        $message->update([
            'status' => 'read',
        ]);

        return back()->with(
            'success',
            'Message marked as read.'
        );
    }

    public function markAsUnread(
        ContactMessage $message
    ): RedirectResponse {
        $message->update([
            'status' => 'unread',
        ]);

        return back()->with(
            'success',
            'Message marked as unread.'
        );
    }

    public function destroy(
        ContactMessage $message
    ): RedirectResponse {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with(
                'success',
                'Message deleted successfully.'
            );
    }
}