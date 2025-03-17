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

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/67cec5e33de42919170a7c0a/1ilvra0ki';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->


<body class="d-flex flex-column min-vh-100">
    <div id="app" class="flex-grow-1">
        <!-- Agregamos aria-label para indicar que es navegación principal -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" aria-label="Main navigation">
            <div class="container">

                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" height="30">
                </a>

                <!-- Botón menú responsive -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido colapsable -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        @foreach ($categories as $category)
                            @if ($category->active === 1)
                                <li>
                                    <a class="nav-link"
                                        href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        @auth
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
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">

                        <!-- Formulario de búsqueda: se recomienda un label oculto para accesibilidad -->
                        <li class="nav-item d-none d-md-inline">
                            <form class="d-flex" role="search" aria-label="Search"
                                action="{{ route('shoes.search') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <!-- Label oculto para accesibilidad -->
                                    <label for="search" class="visually-hidden">{{ __('Search') }}</label>

                                    <!-- Campo de texto -->
                                    <input id="search" name="search" type="search" class="form-control"
                                        placeholder="Search" aria-label="Search" value="{{ old('search') }}" required>

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
                                    <a class="nav-link position-relative offline-cart" href="{{ route('cart.index') }}"
                                        aria-label="Cart" data-toggle="modal" data-target="#exampleModal">
                                        <!-- Ícono de carrito -->
                                        <i class="bi bi-cart" style="font-size: 1.2rem; color: black;"></i>
                                        <!-- Badge -->
                                        @if ($cartItemCount > 0)
                                            <span
                                                class="position-absolute top-25 start-100 translate-middle 
                                                     badge rounded-pill bg-danger" id="cart-count">
                                                {{ $cartItemCount }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                <!-- Login (solo ícono) -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" aria-label="Login">
                                        <i class="bi bi-person-fill" style="font-size: 1.2rem; color: black;"></i>
                                    </a>
                                </li>
                            @endif
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
                                <a class="nav-link position-relative" href="{{ route('cart.index') }}" aria-label="Cart">
                                    <!-- Ícono SOLO visible en md o mayor -->
                                    <span>
                                        <i class="bi bi-cart" style="font-size: 1.2rem; color: black;"></i>
                                    </span>

                                    <!-- Badge siempre visible (tanto en móvil como en escritorio) -->
                                    @if ($cartItemCount > 0)
                                        <span
                                            class="position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger"
                                            style="font-size: 0.75rem; padding: 2px 6px;" id="cart-count">
                                            {{ $cartItemCount }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <!-- Dropdown usuario autenticado -->
                            <li class="nav-item dropdown d-none d-md-inline">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <a class="dropdown-item" href="{{ route('shoes.index') }}">
                                            Productos
                                        </a>
                                        <a class="dropdown-item" href="{{ route('category.index') }}">
                                            Categorías
                                        </a>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                                            Pedidos
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Usuarios
                                        </a>
                                        <a class="dropdown-item" href="{{ route('colors.index') }}">
                                            Colores
                                        </a>
                                        <a class="dropdown-item" href="{{ route('sizes.index') }}">
                                            Tallas
                                        </a>
                                        <a class="dropdown-item" href="{{ route('brands.index') }}">
                                            Marcas
                                        </a>
                                        <a class="dropdown-item" href="{{ route('models.index') }}">
                                            Modelos
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
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
            <!-- Contenedor de la alerta (inicialmente oculto) -->
            <div id="alert-container" class="position-fixed top-15 end-0 p-3" style="z-index: 1050;"></div>
            @yield('content')

            @guest
                @if (Route::has('login'))
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endguest
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-4 mb-3">
                    <h5>Moon Shoes</h5>
                    <p class="small">
                        Tienda especializada en calzado para todas las edades. Encuentra la mejor calidad y diseño
                        para tu estilo.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-3">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Inicio</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Tienda</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contacto</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Sobre Nosotros</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4 mb-3">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-telephone-fill me-2"></i>(+34) 123 456 789</li>
                        <li><i class="bi bi-envelope-fill me-2"></i>info@moonshoes.com</li>
                        <li><i class="bi bi-geo-alt-fill me-2"></i>Calle Luna 123, 28000 Madrid</li>
                    </ul>
                </div>
            </div>
            <hr class="border-light">
            <!-- Copyright -->
            <div class="text-center">
                <p class="mb-0 small">&copy; {{ date('Y') }} Moon Shoes. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>
