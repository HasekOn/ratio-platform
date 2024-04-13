<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>  @yield('title') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
@guest()
    @yield('auth')
@endguest
@auth()
    <header class="header">
        <nav class="navWrap" role="navigation">
            <a href="{{ url('/') }}"><img class="logo" src="images/ratio.png" alt="logo"></a>
            <div class="menu">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="menuContent">
                <ul class="">
                    <li><a href="{{ url('/') }}">Your work</a></li>
                    <li><a href="{{ url('/projects') }}">Projects</a></li>
                    <li>Time sheet</li>
                    <li>Ideas</li>
                </ul>
                <div class="closeBtn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <ul class="navMenu">
                <li><a href="{{ url('/') }}" class="{{ Route::is('ratio.home') ? 'activeBtn' : 'noneActive'}}">Your work</a></li>
                <li><a href="{{ url('/projects') }}" class="{{ Route::is('projects.index') ? 'activeBtn' : 'noneActive'}}">Projects</a></li>
                <li>Time sheet</li>
                <li>Ideas</li>
            </ul>
        </nav>
        <div class="header-right">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="logout">Logout</button>
            </form>
            <a href="{{ route('profile') }}" class="">
                <div class="profile">
                    <p>{{ Auth::user()->name }}</p>
                    <img src="{{ Auth::user()->getImageURL() }}" class="profilePhoto">
                </div>
            </a>
        </div>
    </header>
    <div class="line"></div>

@yield('content')
@include('scripts.scripts')
@endauth
