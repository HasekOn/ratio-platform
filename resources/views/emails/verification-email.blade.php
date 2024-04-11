<h1>Thanks for your registration {{ $user->name }}</h1>
<br>
<p>To complete your registration, please continue to the link below: </p>
<br>
<a href="{{ route('emailVerification', [$remember_token, $user]) }}">Complete Registration</a>
<br>
Thanks,
<br>
{{ config('app.name') }}
