<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panelim') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('You have successfully logged in!') }}
                </div>

                <div class="bg-gray-200 h-auto w-full flex justify-center items-center">
                    <div class="max-w-7xl mx-auto px-4 py-5 sm:px-6 lg:py-10 lg:px-8">
                        {{-- <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl dark:text-white">{{ __('My statistics') }}</h2> --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <dl>
                                        <dt
                                            class="text-sm text-center leading-5 font-medium text-gray-500 truncate">
                                            {{ __('Cornerposts') }}</dt>
                                        <dd
                                            class="mt-1 text-center text-3xl leading-9 font-semibold text-slate-600">
                                            {{ $values['cornerposts']->count() }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <dl>
                                        <dt
                                            class="text-sm text-center leading-5 font-medium text-gray-500 truncate">
                                            {{ __('Published') }}</dt>
                                        <dd
                                            class="mt-1 text-center text-3xl leading-9 font-semibold text-slate-600">
                                            {{ $values['cornerposts_published']->count() }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <dl>
                                        <dt
                                            class="text-sm text-center leading-5 font-medium text-gray-500 truncate">
                                            {{ __('Pending Approval') }}</dt>
                                        <dd
                                            class="mt-1 text-center text-3xl leading-9 font-semibold text-slate-600">
                                            {{ $values['cornerposts_pending']->count() }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <dl>
                                        <dt
                                            class="text-sm text-center leading-5 font-medium text-gray-500 truncate">
                                            {{ __('Total View') }}</dt>
                                        <dd
                                            class="mt-1 text-center text-3xl leading-9 font-semibold text-slate-600">
                                            {{ $values['cornerposts_total_view'] }}</dd>
                                    </dl>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
