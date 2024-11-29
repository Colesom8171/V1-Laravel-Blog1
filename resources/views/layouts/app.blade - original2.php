<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BLOG PBAW</title>

        <!-- Incluir el CSS de Bootstrap y otros estilos -->
        <link rel="stylesheet" href="{{ asset('bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> <!-- CSS personalizado -->

        <!-- Para DataTables -->
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

        <!-- Incluir los scripts necesarios -->
        <script src="{{ asset('jquery/dist/jquery.js') }}"></script>
        <script src="{{ asset('@popperjs/core/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Vite y otros scripts -->
        @vite(['resources/css/app.css'])
        @vite(['resources/js/app.js'])
        <!--
        <link rel="stylesheet" href="{{ asset('bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
        <script src="{{ asset('jquery/dist/jquery.js') }}"></script>
        <script src="{{ asset('@popperjs/core/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

        //Incluir el CSS personalizado
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        // Otros estilos CSS 
        @vite(['resources/css/app.css'])
        -->


    </head>
    <body class="font-sans antialiased container">

        <div class="row">
            <div class="cl-md-12">
<!--
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Blog</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('roles')}}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('users')}}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('categories')}}">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('tags')}}">Tags</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('blogs')}}">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('comments')}}">Comments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('blogs_users/create')}}">Crear Blog</a>
                            </li>
                        </ul>
                        </div>
                    </div>  

                    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-right:10px;">
                        <!-
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                Drop Down Button
                            </a>
                            <ul class="dropdawn-menu">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                    </x-dropdown-link>
                                    </form>
                                </li>
                                <li><a class="dropdown-item" href="#">SOMETHING ELSE HERE</a></li>
                            </ul>
                        </div>
                        ->
                        <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->name}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Salir') }}
                                                </x-dropdown-link>
                                            </form>
                                        </li>
                                    </ul>
                        </div>
                        <!-
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                        ->
                    </div>
                </nav>
-->
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Blog</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('roles')}}">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('users')}}">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('categories')}}">Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('tags')}}">Tags</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('blogs')}}">Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('comments')}}">Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('blogs_users/create')}}">Crear Blog</a>
                                </li>
                            </ul>
                            <div class="dropdown ms-auto">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                {{ __('Salir') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
<!-- Contenido principal -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
<!--
                @vite(['resources/js/app.js'])
                 Scripts JavaScript ->
                <script src="{{ mix('js/app.js') }}"></script>
                @yield('scripts') <!- Aquí puedes agregar scripts adicionales 
-->
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    @yield('scripts')

    </body>
</html>
