<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ secure_asset('editor/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::user())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('articles.index') }}">Articles</a></li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a id="delete-btn" href="#">
                                            Delete Account
                                        </a>
                                        <form id="delete-form" method="POST" action="{{ route('users.destroy', Auth::id()) }}" accept-charset="UTF-8">
                                            {{ method_field('DELETE') }}
                                            {{csrf_field()}}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}"></script>

    <script src="{{ secure_asset('editor/summernote/dist/summernote.js') }}"></script>
    @yield('scripts')
    <script>
        $('.confirm-delete').on('click', function(event){
            return confirm('Are you sure you want to delete this item?');
        });

        $('#delete-btn').on('click', function(event){
            event.preventDefault();
            var confirm_delete = confirm('Are you sure you want to delete your account?');
            if(confirm_delete== true){
                $('#delete-form').submit();
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });

    </script>

    <style>
        #cke_1_top {
            height: 37px !important;
            overflow-x: scroll;
        }
        /*.note-toolbar {
            overflow-x: scroll;
        }*/
        .note-toolbar {
           display: flex;
           overflow-x: scroll;
            overflow-y: hidden;
        }
        .note-toolbar .note-btn-group {
            display: flex;
            height: 30px;
        }
        .note-btn {
            height: 30px;
        }
    </style>

    <script>
        $('document').ready(function() {
            $(".dropdown-toggle").click(function () {
                if($(this).hasClass("note-btn")) {
                    var closest_element = $(this).next();
                    var height = closest_element.height()+50;
                    if($(this).attr('aria-expanded') === 'true'){
                        console.log('notclick');
                        $('.note-toolbar').height('101%');
                    }
                    else {
                        $('.note-toolbar').height(height + 25);
                    }

                }
            });
            $(".dropdown-toggle").blur(function () {
                if($(this).hasClass("note-btn")) {
                    $('.note-toolbar').height('101%');

                }
            });
        });
    </script>
</body>
</html>
