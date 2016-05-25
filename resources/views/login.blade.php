@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Вход в систему</div>
                    <div class="panel-body">

                        @include('errors.input')

                        <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@postLogin') }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Имя пользователя</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Пароль</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Войти
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection