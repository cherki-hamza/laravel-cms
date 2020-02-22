<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      cherki hamza developer web full stack
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            @if(Auth()->user())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.show' , Auth()->user()->id)}}">
                                    <img id="{{Auth()->user()->hasPicture()}}" src="{{ Auth()->user()->hasPicture()? asset('storage/'.Auth()->user()->getPicture()) : Auth()->user()->getGravatar()}}" style="border-radius: 50%; width: 25px;height: 25px;" />
                                </a>
                            </li>
                            @endif

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- start body -->
        @auth
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 my-4">
                        <ul class="list-group">
                            @if(auth()->user()->isAdmin())
                                <li class="list-group-item">
                                    <a href="{{route('users.index')}}"><i class="fal fa-cog mr-2"></i>Users</a>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <a href="/home"><i class="fal fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('posts.index')}}"><i class="fal fa-home-heart mr-2"></i>Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('trashed.index')}}"><i class="fal fa-trash mr-2"></i>Trashed Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('categories.index')}}"><i class="fal fa-cog mr-2"></i>Categories</a>
                            </li>
                                <li class="list-group-item">
                                    <a href="{{route('users.edit' , Auth()->user()->id)}}"><i class="fal fa-cog mr-2"></i>Profile</a>
                                </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.index')}}"><i class="fal fa-cog mr-2"></i>Tags</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/posts"><i class="fal fa-cog mr-2"></i>Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <main class="py-4">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        @else
            <main class="py-4">
                @yield('content')
            </main>
        @endauth
        <!-- end body -->

    </div>
{{--    <script src="{{ asset('assets/js/jquery.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>--}}
    <script src="{{ asset('assets/js/all.js') }}"></script>

@yield('scripts')

</body>
</body>
</html>
