@extends('helpers.header')

@section('content')
    <body>
    <h1>{{$project->name}}</h1>
    </body>
    @include('scripts.scripts')
@endsection
