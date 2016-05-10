@extends('layouts.layout')

@section('header')
    @include('partials/slider')
@endsection

@section('content')

    @foreach($categories as $category)
        <ul>
            <li><a href="{{ url('/cars', str_replace(' ', '-', $category->name)) }}">{{$category->name}}</a></li>
        </ul>
    @endforeach

@endsection