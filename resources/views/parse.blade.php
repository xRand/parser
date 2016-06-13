@extends('layouts.layout')

@section('content')

    <div class="row ">
        <form method="POST" class="form-inline mini" style="margin-bottom: 0px;">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Настройки</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row filter-row">
                                <div class="col-sm-6">
                                    <label>Время исполнения парсера</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input id="timepicker1" type="text" name="time" class="form-control input-small" placeholder="00:00">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-row">
                                <div class="col-sm-6 col-sm-offset-6">
                                    <div class="input-group" style="width:100%">
                                        <a class="btn btn-primary btn-block"  href="" role="button">Планировать</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <div class="row filter-row">
                                <div class="col-sm-6">
                                    <label>Максимальное время работы</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control price-input" placeholder="0" name="limit" value="0">
                                        <span class="input-group-addon">сек</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-row">
                                <div class="col-sm-6">
                                    <label>Задержка обхода по страницам</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control price-input" placeholder="5" name="delay" value="5">
                                        <span class="input-group-addon">сек</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row filter-row">
                                <div class="col-sm-6">
                                    <label>Количество страниц обхода</label>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control price-input" placeholder="1" name="pages" value="1">
                                        <span class="input-group-addon">стр</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                     </div>
                </div>
            </div>
            <div class="col-sm-6" style=" margin-top: 16em;">
                <div class="row filter-row col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary btn-block" formaction="{{ url('parse/ss') }}">Парсер SS.lv</button>
                    {{--<a class="btn btn-primary center-block" href="{{ url('parse/ss') }}" role="button" >Парсер SS.lv</a>--}}
                </div>
                <div class="row filter-row col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary btn-block" formaction="{{ url('parse/latauto') }}">Парсер LatAuto.lv</button>
                </div>
                <div class="row filter-row col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary btn-block" formaction="{{ url('parse/auto24') }}">Парсер Auto24.lv</button>
                </div>
            </div>
        </form>
    </div>


    @if(isset($result))
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <p>Time: {{ $result['time'] }} sec</p>
                <p>New ads: {{ $result['new'] }}</p>
                <p><a href="#" onclick="toggler('duplicates');">Duplicates: {{ $result['duplicateCounter'] }}</a></p>
                <div id="duplicates" style="display: none">
                    <ul>
                        @foreach($result['duplicates'] as $duplicate)
                            <li><a href="{{$duplicate}}">{{$duplicate}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <script>
            function toggler(divId) {
                $("#" + divId).toggle();
            }
        </script>
    @endif


@endsection