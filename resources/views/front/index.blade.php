@extends('layouts.app')

@section('content')
    <div class="welcome-image m-auto"></div>
    <section class="custom-width services">
        @foreach($services as $service)
            <div class="service">
                <img class="service-image"
                    src="{{asset('storage/services/' . $service['image'])}}">
                <div class="service-content owerflow-auto">
                    <h4 class="text-center">{{$service['name']}}</h4>
                    <span class="text-justify">{{$service['body']}}</span>
                </div>
            </div>
        @endforeach
    </section>
    <iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJt7E589yW3UYRd-YVVUOqtI4&key=AIzaSyDChpwvOfo3HUIglbzAmHM46-ooCgi_oGI" allowfullscreen></iframe>
@endsection
