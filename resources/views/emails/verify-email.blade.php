@extends('helpers.header')

@section('auth')
    <section class="register">
        <div class="registration-form">
            @include('alerts.success')
            <h1>To complete your registration please check your email box</h1>
            <h2>Click on link below to resend new email</h2>
            <a href="{{ route('resendEmail', $user) }}" class="verifyBtn">Resend Email</a>
            <div class="buttons">
                <a href="/login" class="loginText">Login here</a>
            </div>
        </div>
    </section>
@endsection
