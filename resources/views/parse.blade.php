@extends('layouts.layout')

@section('header')

    <div class="container">
        <a class="btn btn-default center-block" href="{{ url('parse/ss') }}" role="button">Parse SS.lv</a>
        <a class="btn btn-default center-block" href="{{ url('parse/latauto') }}" role="button">Parse LatAuto.lv</a>
        <a class="btn btn-default center-block" href="{{ url('parse/auto24') }}" role="button">Parse Auto24.lv</a>
    </div>



@endsection

@section('content')

    @if(isset($result))
        <p>New ads: {{ $result['new'] }}</p>
        <p>Duplicates: {{ $result['duplicateCounter'] }}</p>
        <p>Time: {{ $result['time'] }} sec</p>
        <p>Duplicates:</p>
        <ul>
        @foreach($result['duplicates'] as $duplicate)
                <li><a href="{{$duplicate}}">{{$duplicate}}</a></li>
        @endforeach
        </ul>
    @endif


@endsection