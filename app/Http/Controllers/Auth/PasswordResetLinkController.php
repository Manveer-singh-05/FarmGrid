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
            // PREVENTION: Prevent PHP from hanging if SMTP is unresponsive
            set_time_limit(30);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
                            
        } catch (\Symfony\Component\Mailer\Exception\TransportExceptionInterface $e) {
            \Log::error("Password Reset Transport Failure: " . $e->getMessage(), [
                'email' => $request->email,
                'code' => $e->getCode()
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Mail server connection timeout. Please try again later.']);

        } catch (\Exception $e) {
            \Log::error("Password Reset Failure: " . $e->getMessage(), [
                'email' => $request->email
            ]);

            // Provide a graceful fallback to the user
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'We encountered an error while sending the reset link. Please try again later or contact support.']);
        }
    }
}
