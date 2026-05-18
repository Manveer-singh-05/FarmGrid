<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
