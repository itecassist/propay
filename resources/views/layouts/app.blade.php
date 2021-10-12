<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/9ac87a4368.js" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="{{ asset('css/custom.css') }}?{{ time() }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div id="app" class="container-xl">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ProPay</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}" aria-current="page"
                                href="{{ route('dashboard') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ __('global.menu.dashboard') }}"><i class="fa fa-tachometer-alt"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->is('candidates*') ? ' active' : '' }}"
                                href="{{ route('candidates.index') }}">{{ __('global.menu.candidates') }}</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <div class="btn-group dropstart" id="profile">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('global.logout') }}</a>
                                </li>
                            </ul>
                        </div>
                    </span>
                </div>
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    <script>
        window.addEventListener('modal', event => {
            $('#' + event.detail.modal).modal(event.detail.action);
        });

        function notice(type, title, message = '', time = 1500) {
            if (type === 'error') {
                time = 4000;
            }
            Swal.fire({
                position: 'top-end',
                toast: true,
                title: title,
                html: message,
                icon: type,
                showCloseButton: true,
                showConfirmButton: false,
                timer: time
            });
        }
        @if (session()->get('success'))
            //https://sweetalert.js.org/guides/
            Swal.fire({
            position: 'top-end',
            toast: true,
            title:'{!! session()->get('success') !!}',
            text:"",
            icon: 'success',
            showConfirmButton: false,
            timer: 2500
            });
        @endif
        @if (session()->get('error'))
            Swal.fire({
            position: 'top-end',
            toast: true,
            title:'{!! session()->get('error') !!}',
            text:"",
            icon: "error",
            showConfirmButton: false,
            timer: 2500
            });
        @endif
    </script>
    @yield('scripts')
</body>

</html>
