<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}"><img src="{{ url('img/logo2.png') }}" alt="logo" width="140" height="70"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="button navbar-right">
                @if(Auth::check())
                    <a href="{{ url('logout')}}" class="nav-button login">Выйти</a>
                @else
                    <a href="{{ url('login')}}" class="nav-button login">Войти</a>
                @endif
            </div>
            <ul class="main-nav nav navbar-nav navbar-right">
                <li><a href="{{ url('') }}">Главная</a></li>
                <li><a href="#">О проекте</a></li>
                <li><a href="#">Контакты</a></li>
               @if(Auth::check())
                    <li><a href="{{ url('parse') }}">Управление парсером</a></li>
               @endif
            </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>