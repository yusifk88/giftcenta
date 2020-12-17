@component('mail::message')
# Your airtime as a gift was sent.

We have sent GHS{{number_format($airtime->amount,2)}} airtime to {{$airtime->phone_number}} as you requested.

@component('mail::panel')
{{$airtime->message}}
@endcomponent
-Your Message
<br>
Regards,<br>
{{ config('app.name') }}
@endcomponent
