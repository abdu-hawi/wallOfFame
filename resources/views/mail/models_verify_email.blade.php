@component('mail::message')
    # Introduction


    code: {!! $data !!}


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
