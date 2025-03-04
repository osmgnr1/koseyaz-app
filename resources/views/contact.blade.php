<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aşağıdaki formu doldurarak bize geri bildirimde bulunabilirsiniz!') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center mb-5">
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 py-2 text-lg text-slate-600 text-center bg-green-300" :status="session('contact_send')" />

            <form method="POST" action="{{ route('contact.enquiry') }}">
                @csrf

                <div class="grid-cols-1 justify-items-center py-5">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Contact') }}
                    </h2>
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Subject -->
                <div class="mt-4">
                    <x-input-label for="subject" :value="__('Subject')" />
                    <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                        :value="old('subject')" required autocomplete="subject" />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <!-- Message Body -->
                <div class="mt-4">
                    <x-input-label for="body" :value="__('Body')" />
                    <x-text-area-input :cols="$cols='30'" :rows="$rows='8'" name="body" id="body" class="block mt-1 w-full" :value="old('body')"
                        required />
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <!-- Google Recaptcha Widget-->
                <div class="g-recaptcha mt-4" data-sitekey={{ config('services.recaptcha.key') }}></div>
                {{-- <x-input-error :messages="$errors->get('recaptcha')" class="mt-2" /> --}}
                <x-auth-session-status class="mb-4 text-red-600" :status="session('recaptcha')" />

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
