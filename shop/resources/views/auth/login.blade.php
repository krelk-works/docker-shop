@extends('layouts.app')

@section('content')
    <div class="login-section">
        <div class="login-container">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Moon Shoes Logo">
            </div>

            {{-- Formulario de login con la lógica de Laravel --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <input id="email"
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
                           placeholder="Usuario">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <input id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Contraseña">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Recordar --}}
                <div class="mb-3 form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="remember"
                           id="remember"
                           {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                {{-- Olvidé mi contraseña --}}
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                {{-- Enlace para registrarse (por ahora #) --}}
                <a class="register-link" href="{{ route('register') }}">
                    {{ __('Create new account') }}
                </a>

                {{-- Botón login --}}
                <button type="submit" class="btn btn-dark w-100">
                    {{ __('Login') }}
                </button>
            </form>

            <p class="login-footer">
                &copy; Moon Shoes S.L. 2025
            </p>
        </div>
    </div>
@endsection
