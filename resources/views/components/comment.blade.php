@props(['comments'])
@foreach($comments as $comment)
    <div class="display-comment row mt-3">
        <div>
            <div class="w-full bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex justify-between pb-1">
                    <div>
                        <strong>{{ $comment->user->username }}</strong>
                        <small><i class="fa fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    @auth
                    @if (Auth::user()->id == $comment->user_id)
                        <div class="pr-0">
                            <form action="{{ route('comment.destroy', ['id'=>$comment->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}" /> --}}
                                <div class="col-md-1 pr-2">
                                    <button class="border-1 rounded-md py-0 px-2 bg-red-700 text-sm text-slate-200 hover:bg-red-500"><i class="fa fa-reply"></i>{{ __('Delete') }}</button>
                                </div>
                            </form>
                        </div>
                    @endif
                    @endauth
                </div>

                <p class="pb-2 text-sm text-slate-500">{!! nl2br($comment->body) !!}</p>
                @auth


                <div class="pb-4">
                    <form method="post" action="{{ route('comment.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group flex space-x-3 items-center">
                                    <x-input-label for="" :value="__(Auth::user()->username)" />
                                    <input type="hidden" name="corner_post_id" value="{{ $comment->corner_post_id }}" />
                                    <input type="hidden" name="reply_to_user_id" value="{{ $comment->user->username }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                    <x-text-area-input :cols="$cols = '5'" :rows="$rows = '1'" name="body" id="body"
                                            class="block mt-1 w-full" :value="old('body')" required />
                                    <x-input-error :messages="$errors->get('body')" class="mt-2" />

                                        <div class="col-md-1 items-end pt-1 pr-2">
                                            <button class="border-1 rounded-md py-0 px-2 bg-blue-500 text-sm text-slate-200 hover:bg-blue-800">{{__('Reply')}}</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endauth
            </div>
            <x-comment :comments="$comment->replies"/>
        </div>
    </div>


@endforeach

