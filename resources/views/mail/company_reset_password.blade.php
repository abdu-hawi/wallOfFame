@component('mail::message')
# Introduction


 code: {!! $token !!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
