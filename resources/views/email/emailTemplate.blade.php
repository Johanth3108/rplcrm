@component('mail::message')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
SAGIREALTY
@endcomponent
@endslot

Welcome to SAGIREALTY Pvt. Ltd.

Hi {{$details['client_name']}}, <br>
{{$details['message']}}


Thanks,<br>
Sagirealty.co
@endcomponent
