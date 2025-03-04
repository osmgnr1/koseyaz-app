<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tekrar Hoşgeldiniz') }}
        </h2>
    </x-slot>


    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mb-2">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-lg" :status="session('password_change_status')" />
            <x-auth-session-status class="mb-4 text-red-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="grid-cols-1 justify-items-center py-5">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Login') }}
                    </h2>
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Google Recaptcha Widget-->
                <div class="g-recaptcha mt-4" data-sitekey={{ config('services.recaptcha.key') }}></div>
                {{-- <x-input-error :messages="$errors->get('recaptcha')" class="mt-2" /> --}}
                <x-auth-session-status class="mb-4 text-red-600" :status="session('recaptcha')" />

                <div class="flex justify-between mt-4">
                    <!-- Remember Me -->
                    <div class="flex items-center justify-center">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <!-- Forgot your password -->
                    <div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <div class="flex items-center justify-center my-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('register') }}">
                            {{ __('Register an account') }}
                        </a>
                    </div>

                    <div class="flex items-center justify-end my-4">
                        <x-primary-button class="ms-3">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>

                </div>

            </form>
        </div>
    </div>

</x-guest-layout>
