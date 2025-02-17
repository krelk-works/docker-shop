<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Moon Shoes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .logo img {
            max-width: 100px;
            margin-bottom: 20px;
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
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="URL_DE_TU_LOGO" alt="Moon Shoes Logo">
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>
            <a href="{{ route('password.request') }}" class="forgot-password">He olvidado mi contraseña</a>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>

        <p class="copyright">Copyright Moon Shoes S.L. 2025</p>
    </div>
</body>
</html>
