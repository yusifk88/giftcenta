@component('mail::message')
# {{$airtime->sender_name}} have sent you Airtime.

You just received GHS{{number_format($airtime->amount,2)}} airtime from {{$airtime->sender_name}}

@component('mail::panel')
{{$airtime->message}}
@endcomponent
-{{$airtime->sender_name}}<br>
<br>
Regards,<br>
{{ config('app.name') }}
@endcomponent
