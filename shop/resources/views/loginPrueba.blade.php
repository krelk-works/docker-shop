@extends('layouts.app')

@section('content')
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 360px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo{
         
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .logo img {
            max-width: 200px;
            margin-bottom: 16px;
            margin-top: 16px;
        }
        .login-container input {
            border-radius: 8px;
        }
        .forgot-password {
            margin-bottom: 16px;
            display: block;
            color: #007bff;
            text-decoration: none;
        }
        .copyright {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 16px;
        }
    </style>
    <div class="login-container">
        <div class="logo">
            <img src="{{asset('img/logo.png') }}" alt="Moon Shoes Logo">
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>
            <a href="{{ route('password.request') }}" class="forgot-password">He olvidado mi contraseña</a>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>

        <p class="copyright">Copyright Moon Shoes S.L. 2025</p>
    </div>
@endsection