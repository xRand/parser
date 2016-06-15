@extends('layouts.layout')

@section('header')
    @include('partials/slider')
@endsection

@section('content')

    <div class="col-lg-8 col-lg-offset-2 content-box ">
        <div class="row">
            <div class="col-lg-12  box-title no-border">
                <h3 style="margin-top: 0;">Популярные категории</h3>
            </div>
            <div class="list-group" >
                @foreach($categories as $category)
                    @if($category->count >= 120)
                        <div class="col-xs-12 col-md-4">
                            <a class="list-group-item" href="{{ url('/cars/' . str_replace(' ', '-', $category->name) . '/all') }}">
                                <span class="badge">{{$category->count}}</span>
                                {{$category->name}}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection