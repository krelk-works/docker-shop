@php
    use App\Models\Category;
    $categories = Category::all();
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap & scripts (via Vite) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Bootstrap Icons (o donde los tengas) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
</head>
<body>
    <div id="app">
        <!-- Agregamos aria-label para indicar que es navegación principal -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" aria-label="Main navigation">
            <div class="container">
                
                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="{{ config('app.name', 'Laravel') }}" 
                         height="30">
                </a>
                
                <!-- Botón menú responsive -->
                <button class="navbar-toggler" type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" 
                        aria-expanded="false" 
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Contenido colapsable -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                            @if (Route::has('login'))
                                <!-- Otras opciones de menú para invitados -->
                                @foreach($categories as $category)
                                <li><a class="nav-link" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('shoes.index') }}">
                                        Productos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categorias.index') }}">
                                        Categorías
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pedidos.index') }}">
                                        Pedidos
                                    </a>
                                </li>
                            @else
                                <!-- Opciones de menú para usuarios no administradores -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Hombre
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Mujer
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Niño/a
                                    </a>
                                </li>
                                <!-- FAVORITES -->
                                <li class="nav-item d-inline d-md-none">
                                    <a class="nav-link" href="#">
                                        Favourites
                                    </a>
                                </li>
                                <!-- CART -->
                                <li class="nav-item d-inline d-md-none">
                                    <a class="nav-link" href="#">
                                        Cart
                                    </a>
                                </li>
                                 <!-- PROFILE -->
                                 <li class="nav-item d-inline d-md-none">
                                    <a class="nav-link" href="#">
                                        Profile
                                    </a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        
                        <!-- Formulario de búsqueda: se recomienda un label oculto para accesibilidad -->
                        <li class="nav-item d-none d-md-inline">
                            <form class="d-flex" role="search" style="padding-right: 10px">
                                <div class="input-group">
                                    <!-- Label oculto para accesibilidad -->
                                    <label for="search" class="visually-hidden">{{ __('Search') }}</label>
                                    
                                    <!-- Campo de texto -->
                                    <input 
                                        id="search"
                                        type="search" 
                                        class="form-control" 
                                        placeholder="Search" 
                                        aria-label="Search">
                                    
                                    <!-- Botón con icono de lupa -->
                                    <button class="btn btn-outline-success" type="submit">
                                        <i class="bi bi-search"></i>
                                        <!-- Opcional: añadir texto SR-only si deseas más accesibilidad -->
                                        <!-- <span class="visually-hidden">Buscar</span> -->
                                    </button>
                                </div>
                            </form>
                        </li>

                        
                        @guest
                            @if (Route::has('login'))
                                <!-- Carrito -->
                                <li class="nav-item">
                                    <a class="nav-link position-relative" href="#" aria-label="Cart">
                                        <!-- Ícono de carrito -->
                                        <i class="bi bi-cart" style="font-size: 1.2rem; color: black;"></i>
                                        <!-- Badge -->
                                        <span class="position-absolute top-25 start-100 translate-middle 
                                                     badge rounded-pill bg-danger">
                                            3
                                        </span>
                                    </a>
                                </li>
                                
                                <!-- Login (solo ícono) -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" aria-label="Login">
                                        <i class="bi bi-person-fill" style="font-size: 1.2rem; color: black;"></i>
                                    </a>
                                </li>
                            @endif
                            
                            <!-- @if (Route::has('register')) -->
                                <!--
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                                -->
                            <!-- @endif -->
                        @else
                            <!-- FAVORITES -->
                            <li class="nav-item d-none d-md-inline" style="font-size: 1.2rem; color: black;">
                                <a class="nav-link position-relative" href="#" aria-label="Favorites">
                                    <!-- Ícono SOLO visible en md o mayor -->
                                    <span>
                                        <i class="bi bi-heart" style="font-size: 1.2rem; color: black;"></i>
                                    </span>

                                    <!-- Texto SOLO visible en pantallas pequeñas -->
                                    <span class="d-inline d-md-none">
                                        Favorites
                                    </span>
                                </a>
                            </li>
                            <!-- CART -->
                            <li class="nav-item d-none d-md-inline" style="font-size: 1.2rem; color: black;">
                                <a class="nav-link position-relative" href="#" aria-label="Cart">
                                    <!-- Ícono SOLO visible en md o mayor -->
                                    <span>
                                        <i class="bi bi-cart" style="font-size: 1.2rem; color: black;"></i>
                                    </span>

                                    <!-- Badge siempre visible (tanto en móvil como en escritorio) -->
                                    <span class="position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger" 
                                        style="font-size: 0.75rem; padding: 2px 6px;">
                                        3
                                    </span>
                                </a>
                            </li>
                            <!-- Dropdown usuario autenticado -->
                            <li class="nav-item dropdown d-none d-md-inline">
                                <a id="navbarDropdown" 
                                   class="nav-link dropdown-toggle" 
                                   href="#" 
                                   role="button" 
                                   data-bs-toggle="dropdown" 
                                   aria-haspopup="true" 
                                   aria-expanded="false" 
                                   v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" 
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" 
                                          action="{{ route('logout') }}" 
                                          method="POST" 
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
