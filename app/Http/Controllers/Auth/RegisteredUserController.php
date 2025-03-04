<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\IpUtils;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {

        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response)) {
            return redirect()->back()->with('status', __('Please Complete the Recaptcha to proceed'));
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

            // $request->validate([
            //     'username' =>['required', 'string', 'lowercase', 'max:20', 'unique:'.User::class],
            //     'name' => ['string', 'max:25', 'nullable'],
            //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            //     'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // ]);

            // $request->validated();

            $user = User::create([
                'username' => $request->username,
                'name' => $request->name ?? __('Anonymous'),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'author'
            ]);

            event(new Registered($user));
            Auth::login($user);
            return redirect(route('dashboard', absolute: false));

        } else {
            return redirect()->back()->with('status', __('Please Complete the Recaptcha Again to proceed'));
        }

    }
}
