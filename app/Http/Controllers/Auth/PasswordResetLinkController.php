<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
                            
        } catch (\Exception $e) {
            // Log the full error for production diagnosis
            \Log::error("Password Reset Link Failure: " . $e->getMessage(), [
                'email' => $request->email,
                'trace' => $e->getTraceAsString()
            ]);

            // Provide a graceful fallback to the user
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'We encountered an error while sending the reset link. Please try again later or contact support.']);
        }
    }
}
