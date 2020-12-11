@component('mail::message')
# Hello {{$card->sendername}},<br>
# A *${{number_format($card->amount,2)}}* virtual gift card was sent to {{$card->recipientname}} on your behalf.


Card Information
<div class="card virtual-card" style="width: 100%!important;  padding: 25px;">
<div class="card-body" style="width: 100% !important;">
<table style="width: 100%">
<tr>
<td cols="8" sm="8" class="text-white font-weight-bold">
{{'$'.number_format($card->amount,2)}}
</td>
<td  align="right">
<img
src="https://buycards.giftcenta.com/img/visa.png"
height="45"
>
</td>
</tr>
<tr>
<td colspan="2" align="center" style="font-size: 28px; font-weight: bolder;">
{{$card->masked_number}}
</td>
</tr>
<tr>
<td cols="8" sm="8" class="text-white font-weight-bold">
{{$card->billing_name}}
</td>

<td align="right">
{{$card->expiry_date}}<br>
<small>Expires</small>
</td>
</tr>
</table>
</div>
</div>


@component('mail::panel')
<small>Your Message {{$card->sendername}}:</small>
<blockquote>
{{$card->message}}
</blockquote>
@endcomponent

# Transaction summary
<strong>Card Amount:</strong> ${{number_format($card->amount,2)}}<br>
<strong>Service Charge:</strong> ${{number_format(4,2)}}<br>
<strong>Amount Due:</strong> ${{number_format($card->amount+4,2)}}<br>


# Thank you for choosing GiftCenta


Thanks,<br>
{{ config('app.name') }}
@endcomponent
