@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{config('app.url')}}/assets/admin/images/logo/logo.png" class="logo">
<br>
{{ config('app.name') }}

@endcomponent
@endslot

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
لأية استفسارات ، يرجى الاتصال بنا على:
<a href="mailto:contact@esu.ac.ae">contact@esu.ac.ae</a>
<br>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent