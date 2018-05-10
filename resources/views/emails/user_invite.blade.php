@component('mail::message')
# Details

You have requested to join {{ config('app.name') }}.

Click [here]({{ config('app.url') }}/register/invite/{{ $token }}) to sign up.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
