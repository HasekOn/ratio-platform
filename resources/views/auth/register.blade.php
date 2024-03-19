@extends('helpers.header')

@section('auth')
    <div class="bg-modal">
        <div class="modal-content">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h3 class="">Register</h3>
                <div class="">
                    <label for="name" class="">Name:</label><br>
                    <input type="text" name="name" id="name" class="loginInput" placeholder="Username">
                    @error('name')
                    <span class=""> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <label for="email" class="">Email:</label><br>
                    <input type="email" name="email" id="email" class="loginInput" placeholder="Email">
                    @error('email')
                    <span class=""> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <label for="password" class="">Password:</label><br>
                    <input type="password" name="password" id="password" class="loginInput" placeholder="Password">
                    @error('password')
                    <span class=""> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <label for="confirm-password" class="">Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" id="confirm-password" class="loginInput"
                           placeholder="Confirm Password">
                    @error('password_confirmation')
                    <span class=""> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <label for="remember-me" class=""></label><br>
                    <input type="submit" name="submit" class="submit" value="register">
                </div>
                <div class="">
                    <a href="/login" class="">Login here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
