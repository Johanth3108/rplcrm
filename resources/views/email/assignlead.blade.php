@component('mail::message')

Welcome to SAGI Pvt. Ltd.

Hi {{$details['usrname']}}, <br>
you have been assigned 
to a lead, Kindly have a check in your portal.

Lead details,<br>

Client name : {{$details['client_name']}},<br>
Client contact number : {{$details['client_phn']}},<br>
For property : {{$details['property_name']}}

@component('mail::button', ['url' => $details['url']])
Login now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
