<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<header class = "header">
<a href="{{ url('/') }}"><img class = "logo" src="images/ratio.png" alt="logo"></a>
<nav class = "navWrap" role = "navigation">
    <ul class = "navMenu">
        <li><a href="{{ url('/') }}">Your work</a></li>
        <li><a href="{{ url('/projects') }}">Projects</a></li>
        <li>Time sheet</li>
        <li>Ideas</li>
    </ul>
</nav>
    <img class = "profilePhoto" src="images/oldMan.jpg" alt="profilePhoto">
</header>
<div class="line"></div>

@yield('content')
