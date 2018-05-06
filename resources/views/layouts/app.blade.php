<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body style="background:#FEFEFE">
    <!--div id="app"-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="{{route("home")}}">Bass Libraries</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border:1px solid white">
                <i class="fas fa-bars" style="color:white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{route("home")}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route("categories")}}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route("search")}}">Search</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a></li>
                    @else
                        <ul class="dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item text-white" href="{{route("user.logs")}}#history">Borrowing History</a>
                                <a class="dropdown-item text-white" href="{{route("user.logs")}}">Return Books</a>
                                <a class="dropdown-item text-white" href="{{route("user.fines")}}">Outstanding Fines</a>
                                @if(Auth::id()==1)
                                    <a class="dropdown-item text-white" href="{{route("admin.index")}}">Admin Control Panel</a>
                                @endif
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                   class="dropdown-item text-white">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </ul>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div id="global-black-bar" class="black-bar" style="opacity:0"><!--The black bar for the navbar that disappears!--></div>

        @yield('content')
    <!--/div-->

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var toggle=false;
        $(".navbar-toggler").click(function(){
            if(toggle==false && $("#navbarNav").hasClass("collapse") && !$("navbarNav").hasClass("show") ){
                $("nav").css("background","#212121");
                toggle=true;
            }
            else if($("#navbarNav").hasClass("show")){
                $("nav").css("background","rgba(0,0,0,0)");
                toggle=false;
            }
        });
        $(document).ready(function(){
            var scrollTop = 0;
            $(window).scroll(function(){
                scrollTop = $(window).scrollTop();
                $('.counter').html(scrollTop);

                if (scrollTop >= 100) {
                    $('#global-black-bar').css('opacity','1');
                } else if (scrollTop < 100) {
                    $('#global-black-bar').css('opacity','0');
                }

            });

        });
    </script>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">Made with ♥ by Yap Zhi Heng, for a school project.</span>
        </div>
    </footer>
</body>
</html>
