@component('mail::message')
# Details

You have just requested to join {{ config('app.name') }}, however you already have an account with this email.

Forgot your password? Click [here]({{ config('app.url') }}/password/reset) to reset it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
