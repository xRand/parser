@extends('layouts.layout')

@section('header')
    <div class="slider-area" style="height: 300px;">
        <div class="slider" >
            <div id="sg-slider" >
                <div class="item" >
                    <img src="{{ URL::to('img/widecar.jpg') }}" alt="auto" >
                    <div class="mask"></div>
                </div>
            </div>
        </div>
        <div class="container slider-content search2">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 ">
                    @include('partials/search')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4 pull-left col-xs-12">
            <div class="sidebar">
                @include('partials/filter')
            </div>
        </div>
        <div class="col-md-8 col-xs-12 pull-right listings">
            @include('partials/sort')
            @foreach($ads as $ad)
                <div class="row listing-row">
                    <div class="col-md-3 col-sm-2 hidden-xs photo" >
                            <a href="{{$ad->url}}" onclick="centeredPopup(this.href);return false" >
                                <img class="img-responsive" src="{{$ad->img == 'noimage' ? url('/img/noimage.png') : $ad->img}}" width="150" height="150" alt="auto">
                            </a>
                    </div>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                        <h3>
                            <a class="" href="{{$ad->url}}" onclick="centeredPopup(this.href);return false">
                                {{$categoryName == 'all' ?  $ad->category : $categoryName}} {{$ad->model}} -
                                <strong> {{number_format($ad->price, 0, '.', ' ')}} €</strong>
                            </a>
                        </h3>
                        @if(!empty($ad->description))
                            <p>{{str_limit($ad->description, 70)}}</p>
                        @endif
                        <p class="ad-description">
                            <strong>{{$ad->year}}</strong>
                            @if(!empty($ad->mileage))
                                | <strong> {{number_format($ad->mileage, 0, '.', ' ')}} км</strong>
                            @endif
                            @if(!empty($ad->capacity))
                                | <strong>{{$ad->capacity}}</strong>
                            @endif
                            <span class="pull-right">
                                @if(strpos($ad->url, 'ss') !== false) ss.lv

                                @elseif(strpos($ad->url, 'latauto') !== false) latauto.lv
                                @else auto24.lv
                                @endif
                                &nbsp;-&nbsp;{{$ad->created_at->format('d/m/y')}}
                            </span>
                        </p>
                    </div>
                </div>
             @endforeach

            <div class="pagination text-center">
                {{--dd($filterOptions)--}}
                {{--{{ $ads->appends(['sort' => $sortOption, empty($filterOptions[0]) ? $filterOptions : dd($filterOptions[0])])->render() }}--}}
                {{ $ads->appends(['sort' => $sortOption])->appends($filterOptions)->render() }}
            </div>

        </div>

    </div>

@endsection

@section('footer')
<script>
    var popupWindow = null;
    function centeredPopup(url){
        var w = (screen.width) ? (screen.width)/1.5 : 700;
        var h = (screen.height) ? (screen.height)/1.5 : 600;
        var LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
        var TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

        var settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars,resizable';
        popupWindow = window.open(url,'my',settings);
    }
</script>
@append