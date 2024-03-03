<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Your work</title>
</head>
@extends('index')
@section('header')
    <header class = "header">
        <div class="wide"><img src="images/alma.jpg" class = "logo"></div>
        <nav class = "navWrap" role = "navigation">
            <ul class = "navMenu">
                <li>Ubytování</li>
                <li>Ceník</li>
                <li>Kavárna</li>
                <li>Kontakt</li>
                <li>Členství</li>
            </ul>
        </nav>
    </header>
@endsection
