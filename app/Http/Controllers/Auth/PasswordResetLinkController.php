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
            // PREVENTION: Prevent PHP from hanging forever
            set_time_limit(30);

            // DIAGNOSTIC LOGGING
            \Log::info("PASSWORD_RESET_DEBUG: Dispatching Reset Link...", [
                'email' => $request->email,
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'timeout' => config('mail.mailers.smtp.timeout'),
                'app_url' => config('app.url')
            ]);

            $startTime = microtime(true);
            
            $status = Password::sendResetLink(
                $request->only('email')
            );

            $duration = round(microtime(true) - $startTime, 2);

            \Log::info("PASSWORD_RESET_DEBUG: Reset Link Result Received", [
                'status' => $status, 
                'email' => $request->email,
                'duration_seconds' => $duration
            ]);

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
                            
        } catch (\Symfony\Component\Mailer\Exception\TransportExceptionInterface $e) {
            \Log::error("PASSWORD_RESET_DEBUG: Transport Failure - " . $e->getMessage(), [
                'email' => $request->email,
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Mail server connection timeout. Please try again later.']);

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
