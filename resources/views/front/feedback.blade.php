@extends('layouts.app')

@section('content')
    <div class="" id="app">
        <comments-container :user='@json(auth()->user() ?? false)'></comments-container>
    </div>
@endsection
