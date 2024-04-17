@extends('helpers.header')

@section('auth')
    <section class="register">
        <form action="{{ route('register') }}" method="post" class="registration-form">
            <h3 class="register-headline">Register</h3>
            @csrf
            <div class="registration-wrap">
                <div class="register-container">
                    <input type="text" name="name" id="name" class="loginInput" placeholder="Name...">
                    @error('name')
                    <span class=""> {{ $message }} </span>
                    @enderror
                    <input type="email" name="email" id="email" class="loginInput" placeholder="Email...">
                    @error('email')
                    <span class=""> {{ $message }} </span>
                    @enderror
                    <input type="password" name="password" id="password" class="loginInput"
                           placeholder="Password...">
                    @error('password')
                    <span class=""> {{ $message }} </span>
                    @enderror
                    <input type="password" name="password_confirmation" id="confirm-password" class="loginInput"
                           placeholder="Confirm Password...">
                    @error('password_confirmation')
                    <span class=""> {{ $message }} </span>
                    @enderror
                </div>
                <div class="registration-avatar">
                    <div class="avatar">
                        <img src="images/logoRegister.png" alt="userProfilePicture">
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="submit" class="submit">Register</button>
                <a href="/login" class="loginText">Login here</a>
            </div>
        </form>
    </section>
@endsection
