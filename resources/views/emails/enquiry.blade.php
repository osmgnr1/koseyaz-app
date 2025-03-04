<x-mail::message>
# Merhaba, bir mesajınız var!

<div>
<div>
    <h3>{{ __('Email') }}:</h3>
    <p>{{ Str::upper($data['email'])  }}</p>
</div>
<div>
    <h3>{{ __('Subject') }}:</h3>
    <p>{{ Str::ucfirst($data['subject']) }}</p>
</div>
<div>
    <h3>{{ __('Message') }}:</h3>
    <p>{{ Str::ucfirst($data['body']) }}</p>
</div>

</div>
<h3> </h3>



{{-- <x-mail::button :url="$url">
{{ __('See the message')}}
</x-mail::button> --}}

{{ __('Thanks') }}<br>
{{ config('app.name') }}
</x-mail::message>
