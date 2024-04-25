@extends('helpers.header')

@section('auth')
    <section class="register">
        <form action="{{ route('login') }}" method="post" class="registration-form">
            <div class="successLouOut">
                @include('alerts.success')
            </div>
            @csrf
            <h3 class="register-headline">Login</h3>
            <div class="registration-wrap">
                <div class="register-container">
                    <div class="loginDiv">
                        <input type="email" name="email" id="email" class="loginInput" placeholder="Email...">
                        @error('email')
                        <p class="loginError">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="loginDiv">
                        <input type="password" name="password" id="password" class="loginInput"
                               placeholder="Password...">
                        @error('password')
                        <p class="loginError">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="registration-avatar">
                    <div class="avatar">
                        <img src="images/logoRegister.png" alt="userProfilePicture">
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="submit" class="submit">Log in</button>
                <a href="/register" class="loginText">Register here</a>
            </div>
        </form>
    </section>
@endsection
