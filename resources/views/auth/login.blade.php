@extends('helpers.header')

@section('auth')
    <div class="bg-modal">
        <div class="modal-content2">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h3 class="">Login</h3>
                <div class="">
                    <label for="email" class="loginText">Email:</label><br>
                    <input type="email" name="email" id="email" class="loginInput" placeholder="email">
                    @error('email')
                    <span class=""> Invalid email </span>
                    @enderror
                </div>
                <div class="">
                    <label for="password" class="loginText">Password:</label><br>
                    <input type="password" name="password" id="password" class="loginInput" placeholder="password">
                    @error('password')
                    <span class=""> Wrong password </span>
                    @enderror
                </div>
                <div class="">
                    <label for="remember-me" class=""></label><br>
                    <input type="submit" name="submit" class="submit" value="Log in">
                </div>
                <div class="">
                    <a href="/register" class="loginText">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
