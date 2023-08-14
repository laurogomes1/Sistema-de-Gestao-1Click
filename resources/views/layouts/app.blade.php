<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: 200px;
            height: calc(100% - 80px);
            overflow-y: auto;
            z-index: 1;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            background-color: white;
            margin: 10px 0;
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: #002e7a;
            text-decoration: none;
        }

        .main-content {
            padding-left: 220px;
            width: 100%;
        }

        .table-responsive {
            width: 100%;
        }
        .sidebar summary {
        color: #002e7a;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema de gestão
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
<div class="sidebar">
    <ul>
    <li><a class="sidebar-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line" style="color: #002e7a;"></i> Dashboard</a></li>
        <li>
            <details>
                <summary><i class="fa-solid fa-store" style="color: #1a0a53;"></i> Minha Empresa</summary>
                <ul>
                    <li><a href="{{ route('cadastrar-venda') }}"><i class="fas fa-dollar-sign"></i> Vendas</a></li>
                    <li><a href="{{ route('cadastrar-despesa') }}"><i class="fas fa-receipt"></i> Despesas</a></li>
                    <li><a href="{{ route('cadastrar-filial') }}"><i class="fas fa-building"></i> Filiais</a></li>
                    <li><a href="{{ route('cadastrar-cliente') }}"><i class="fas fa-user-tie"></i> Clientes</a></li>
                    <li><a href="{{ route('cadastrar-fornecedor') }}"><i class="fas fa-truck-moving"></i> Fornecedores</a></li>
                </ul>
            </details>
        </li>
        <li>
            <details>
                <summary><i class="fas fa-user"></i> Minha Vida</summary>
                <ul>
                    <li><a href="{{ route('cadastrar-rendimento') }}"><i class="fas fa-money-bill-wave"></i> Cadastrar Rendimento</a></li>
                    <li><a href="{{ route('cadastrar-despesa-vida') }}"><i class="fas fa-credit-card"></i> Cadastrar Despesa</a></li>
                </ul>
            </details>
        </li>
    </ul>
</div>

<div class="main-content">
    <main class="py-4">
        @yield('content')
    </main>
</div>
@else
<main class="py-4">
    @yield('content')
</main>
@endauth

    </div>
</body>
</html>
