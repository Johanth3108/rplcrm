@component('mail::message')

Welcome to SAGI Pvt. Ltd.

Hi {{$details['usrname']}}, Congratulations and welcome to the team! 
We are excited to have you at SAGI Pvt. Ltd. We know you're 
going to be a valuable asset to our company and are looking 
forward to the positive impact you're going to have here.

Your credential for SAGICRM,

Username : {{$details['usrname']}},<br>
Email : {{$details['email']}},<br>
Password : {{$details['password']}}

@component('mail::button', ['url' => $details['url']])
Login now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
