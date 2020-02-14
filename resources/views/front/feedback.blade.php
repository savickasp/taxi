@extends('layouts.app')

@section('content')
    <div class="custom-width m-auto pt-5" id="app">
        <div class="d-flex justify-content-center align-items-center"><h1>Feedbacks</h1></div>
        <comments-container :user='@json(auth()->user() ?? false)'></comments-container>
    </div>
@endsection
