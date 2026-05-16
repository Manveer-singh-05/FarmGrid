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
        // PRODUCTION DIAGNOSTIC LOG
        \Log::info("PASSWORD_RESET_DEBUG: Request Received", [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'email' => $request->email,
            'has_csrf' => $request->has('_token'),
            'referer' => $request->header('referer'),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);

        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            // DIAGNOSTIC LOGGING (Temporary)
            \Log::info("PASSWORD_RESET_DEBUG: Dispatching Reset Link", [
                'email' => $request->email,
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'from' => config('mail.from.address'),
                'app_url' => config('app.url')
            ]);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            \Log::info("PASSWORD_RESET_DEBUG: Reset Link Result", [
                'status' => $status, 
                'email' => $request->email
            ]);

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
                            
        } catch (\Exception $e) {
            // Log the full error for production diagnosis
            \Log::error("PASSWORD_RESET_DEBUG: Failure - " . $e->getMessage(), [
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
