<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/public.css') }}" rel="stylesheet">


        <!-- google のCDNからjQuery読み込み -->
    </head>
    <body>
        <header>
            <!-- ナビバー -->
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <a href="/" class="navbar-brand">Logo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="menu" class="collapse navbar-collapse">
                    <!-- ナビバー右側 -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                        </li>
                        @endif
                        @else
                        <!-- ログアウト機能が不全になった時のログアウト記述 -->
                        <!--<li><a class="nav-link" href="{{ route('logout') }}">{{ __('Logout') }}</a></li>-->
                        <div aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{ Auth::user()->name }} <span class="caret"></span>
                             </a>
                        </div>
                        <div aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        @endguest
                    </ul>
                </div>
            </nav>
            <!-- ナビバーここまで -->
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        <footer>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        @yield('script')
    </body>
</html>
