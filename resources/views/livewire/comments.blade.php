<section class="bg-white py-2 lg:py-4">
    <div>
        {{-- {{ $model->comments }} --}}
    </div>
    <div class="max-w-2xl mx-auto px-4">

        {{-- main comment form --}}
        <form class="mb-6" wire:submit="postComment">
            <div class="py-2 mb-4">
                <label for="comment" class="sr-only">{{__('Add a comment')}}</label>
                <textarea wire:model="form.body" style="resize: none;" placeholder="{{__('Add a comment')}}" rows="2"
                    class="shadow-sm block rounded-md w-full border-gray-300 text-gray-900  focus:ring-blue-500 focus:border-blue-500
                    @error('form.body') text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror"></textarea>
                @error('form.body')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>


            @auth
                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{__('Submit')}}
                </button>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center py-2.5 px-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{__('Submit')}}
                </a>
            @endauth
        </form>


        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-slate-500">
                {{ $count }} {{ __('Comment') }}
            </h2>
        </div>

        @if ($comments->count())

        {{-- For nested component sending key is important in livewire. Or whenever using foreach loops --}}
            @foreach ($comments as $comment)
                @livewire('comment', ['comment' => $comment], key($comment->id))
            @endforeach

        @else
            <p class="text-slate-500 my-5">{{ __('No Comments Yet') }}</p>
        @endif

    </div>
</section>


