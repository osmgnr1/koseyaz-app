<nav class="px-10 pb-5 flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
        <li>
            <a href="{{ route('home') }}">Anasayfa</a>
        </li>
        <li>|</li>
        <li>
            <a href="{{ route('cornerpost') }}">Köşe Yazısı Nedir?</a>
        </li>
        <li>|</li>
        <li>
            <a href="{{ route('categories.index') }}">Kategoriler</a>
        </li>
        <li>|</li>
        <li>
            <a href="{{ route('contact') }}">Bize ulaşın</a>
        </li>
        <li>|</li>
        <li>
            <a href="{{ route('cornerposts.index') }}">Yazılara Gözat</a>
        </li>

    </ul>
    @auth

    <ul class="flex space-x-2 px-10">
        {{-- <li>
            <p>{{ Auth::user()->name }}</p>
        </li> --}}
        <li>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @if (Auth::user()->role == 'admin')
                            <x-dropdown-link :href="route('admin.index')">
                                {{ __('Admin') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </li>
    </ul>

    @else


    <ul class="flex space-x-2 px-10">
        <li>
            <a href="{{ route('login') }}">Giriş Yap</a>
        </li>
        <li>
            <a href="{{ route('register') }}">Kayıt ol</a>
        </li>
    </ul>

    @endauth
</nav>
