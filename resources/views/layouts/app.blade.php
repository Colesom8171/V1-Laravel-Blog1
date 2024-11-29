<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BLOG PBAW</title>

        <link rel="stylesheet" href="{{ asset('bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <!-- <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}"> -->
        <link rel="stylesheet" href="{{ asset('css/trix.css') }}">

        
</head>
<body class="font-sans antialiased container">

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
                    @if(auth()->user()->role_id == 1)
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
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('blogs_users/create')}}">Crear Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('messages') }}">Bandeja de entrada</a>
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
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script src="{{ asset('jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!--<script src="{{ asset('js/tinymce.min.js') }}"></script>-->
    <!--<script src="{{ asset('js/ckeditor.js') }}"></script>-->
    <!-- <script src="{{ asset('js/quill.js') }}"></script> -->
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
