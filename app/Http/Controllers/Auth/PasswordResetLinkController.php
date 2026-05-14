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
        // MASSIVE DIAGNOSTIC LOG
        \Log::emergency("================================================================");
        \Log::emergency("CRITICAL DIAGNOSTIC: PasswordResetLinkController@store CALLED");
        \Log::emergency("EMAIL: " . $request->email);
        \Log::emergency("METHOD: " . $request->method());
        \Log::emergency("URL: " . $request->fullUrl());
        \Log::emergency("IP: " . $request->ip());
        \Log::emergency("================================================================");

        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            // DIAGNOSTIC LOGGING (Temporary)
            \Log::info("Password Reset Attempt Initiated", [
                'email' => $request->email,
                'mail_mailer' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_from' => config('mail.from.address'),
                'app_url' => config('app.url'),
                'env' => config('app.env')
            ]);

            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(
                $request->only('email')
            );

            \Log::info("Password Reset Link Result", ['status' => $status, 'email' => $request->email]);

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
