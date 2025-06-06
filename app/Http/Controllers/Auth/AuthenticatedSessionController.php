<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\IpUtils;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        if (Auth::once($request->only('email', 'password'))) {

            $recaptcha_response = $request->input('g-recaptcha-response');

            if (is_null($recaptcha_response)) {
                return redirect()->back()->with('recaptcha', __('Please Complete the Recaptcha to proceed'));
            }

            $url = "https://www.google.com/recaptcha/api/siteverify";

            $body = [
                'secret' => config('services.recaptcha.secret'),
                'response' => $recaptcha_response,
                'remoteip' => IpUtils::anonymize($request->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
            ];

            $response = Http::asForm()->post($url, $body);
            $result = json_decode($response);

            if ($response->successful() && $result->success == true) {
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard', absolute: false));

            } else {

                return redirect()->back()->with('status', __('Please Complete the Recaptcha Again to proceed'));

            }

        }else {
            // return redirect()->back()->with('error', 'Girilmiş olan kullanıcı verileri sistemdekiler ile eşleşmemektedir');
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
