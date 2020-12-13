@component('mail::message')
# Hello {{$card->recipientname}},<br>
# {{$card->sendername}} has sent you a *${{number_format($card->amount,2)}}* virtual gift card.


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
{{$card->number}}
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

<div class="card virtual-card" style="width: 100%!important;  padding: 25px; margin-top: 10px;">
<div class="card-body" style="width: 100% !important;">
<table style="width: 100%">
<tr>
<td cols="8" sm="8" class="text-white font-weight-bold">
    &nbsp;
</td>
<td  align="right">
    &nbsp;

</td>
</tr>
<tr>
<td colspan="2" align="center" style="font-size: 28px; font-weight: bolder; background-color: white; color: #0a0b11;">
CVV:{{$card->cvv}}
</td>
</tr>
<tr>
<td cols="8" sm="8" class="text-white font-weight-bold">
    &nbsp;

</td>

<td align="right">
    &nbsp;

</td>
</tr>
</table>
</div>
</div>

@component('mail::panel')
<small>Message from {{$card->sendername}}:</small>
<blockquote>
{{$card->message}}
</blockquote>
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
