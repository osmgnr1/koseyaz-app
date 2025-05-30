<div x-data="{
    isReplying: @entangle('isReplying'),
    isEditing: @entangle('isEditing').live,
}"
    x-effect="
     if(isReplying){$nextTick(() => $refs.replyForm.focus())};
     if(isEditing){$nextTick(() => $refs.updateForm.focus())}"
     >
    <article class=" my-6 text-base bg-white rounded-lg">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900">
                    <img class="mr-2 w-6 h-6 rounded-full" src="{{ $comment->user->avatar() }}"
                        alt="{{ $comment->user->username }}">
                    {{ $comment->user->username }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $comment->presenter()->relativeCreatedAt() }}
                </p>
            </div>
        </footer>
        <!-- Comment Body -->
        <p class="text-gray-500" x-show="!isEditing">
            {{ $comment->body }}
        </p>

        {{-- Update form --}}
        <form class="mb-6" x-show="isEditing" x-transition wire:submit="updateComment" x-cloak>
            <label for="comment" class="sr-only">Your comment</label>
            <textarea x-ref="updateForm" wire:model="updateForm.body" style="resize: none;" placeholder="{{ __('Write a comment...') }}"
                rows="2"
                class="shadow-sm block rounded-md w-full border-gray-300 text-gray-900  focus:ring-blue-500 focus:border-blue-500
            @error('updateForm.body')
                text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 border-red-300
                @enderror"></textarea>
            @error('updateForm.body')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
            <button type="submit"
                class="inline-flex items-center py-1.5 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-blue-800 mt-4">
                {{ __('Update') }}
            </button>
            <button type="button" @click="isEditing=false"
                class="rounded-lg bg-white px-3 py-1.5 text-xs font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                {{ __('Cancel') }}
            </button>
        </form>

        <!--  Reply,Edit, Delete Section -->
        <div class="flex items-center mt-4 space-x-4">
            @if (!$comment->isReply())
                <button @click="isReplying=!isReplying" type="button"
                    class="flex items-center text-sm text-gray-500 hover:underline">
                    <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    {{__('Reply')}}
                </button>
            @endif

            @can('update', $comment)
                <button @click="isEditing=true" type="button"
                    class="flex items-center text-sm text-gray-500 hover:underline">
                    <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    {{__('Edit')}}
                </button>
            @endcan

            @can('delete', $comment)
                <button wire:confirm="{{ __('Are you sure you want to delete your comment')}}" wire:click="$dispatch('deleteComment',{comment_id: {{ $comment->id }}})"
                    type="button" class="flex items-center text-sm text-gray-500 hover:underline">
                    <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    {{ __('Delete') }}
                </button>
            @endcan
        </div>
    </article>

    {{-- Reply form --}}
    <form class="mb-6 ml-8" x-show="isReplying" x-transition wire:submit="storeReply" x-cloak>
        <label for="comment" class="sr-only">{{ __('Your comment') }}</label>
        <textarea x-ref="replyForm" wire:model="form.body" style="resize: none;" placeholder="{{ __('Write a reply...') }}" rows="2"
            class="shadow-sm block rounded-md w-full border-gray-300 text-gray-900  focus:ring-blue-500 focus:border-blue-500
            @error('form.body')
                text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 border-red-300
                @enderror"></textarea>
        @error('form.body')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
        @enderror
        <button type="submit"
            class="inline-flex items-center py-1.5 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-blue-800 mt-4">
            {{ __('Reply') }}
        </button>
        {{-- <span wire:loading>{{ __('Saving...') }}</span> --}}
        <button type="button" @click="isReplying=!isReplying"
            class="rounded-lg bg-white px-3 py-1.5 text-xs font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            {{ __('Cancel') }}
        </button>
    </form>

    <div class="ml-8 mt-6">
        {{-- We are using the concept of recursion here to loop over comment replies --}}
        @foreach ($comment->replies as $reply)
            @livewire('comment', ['comment' => $reply], key($reply->id))
        @endforeach
    </div>
</div>

