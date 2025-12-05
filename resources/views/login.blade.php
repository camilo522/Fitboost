<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #000000;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 50%, rgba(57, 169, 0, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 70% 50%, rgba(45, 130, 0, 0.1) 0%, transparent 50%);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: linear-gradient(135deg, rgba(57, 169, 0, 0.95) 0%, rgba(45, 130, 0, 0.95) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(57, 169, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(57, 169, 0, 0.4),
                        0 0 100px rgba(57, 169, 0, 0.2);
            animation: glowPulse 3s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow: 0 20px 60px rgba(57, 169, 0, 0.4),
                            0 0 100px rgba(57, 169, 0, 0.2);
            }
            50% {
                box-shadow: 0 20px 60px rgba(57, 169, 0, 0.6),
                            0 0 120px rgba(57, 169, 0, 0.3);
            }
        }

        .login-header {
            background: rgba(0, 0, 0, 0.3);
            padding: 2rem;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 25px rgba(57, 169, 0, 0.5),
                        0 0 40px rgba(57, 169, 0, 0.3);
        }

        .login-logo i {
            font-size: 2.5rem;
            color: #39a900;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
            color: #000;
        }

        .form-control:focus {
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
            background: #ffffff;
        }

        .form-control::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        .btn-login {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
            color: #39a900;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 30px rgba(255, 255, 255, 0.5);
            background: #ffffff;
            color: #2d8200;
            border-color: #ffffff;
        }

        .register-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .register-link:hover {
            color: #ffffff;
            text-decoration: underline;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #39a900;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: rgba(255, 255, 255, 0.8);
            background: #ffffff;
        }

        .alert {
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
        }

        .form-label {
            color: rgba(255, 255, 255, 0.95);
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        hr {
            border-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-card" style="width: 450px; max-width: 95%;">
        
        <!-- Header con logo -->
        <div class="login-header">
            <div class="login-logo">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <h3 class="text-white fw-bold mb-0">FitBoost</h3>
            <p class="text-white-50 mb-0 mt-1">Bienvenido de vuelta</p>
        </div>

        <!-- Cuerpo del formulario -->
        <div class="p-4">
            
            <!-- MENSAJE DE ÉXITO -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- ERRORES DE VALIDACIÓN -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">
                        <i class="bi bi-envelope me-2"></i>Correo Electrónico
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               placeholder="email@example.com" 
                               value="{{ old('email') }}"
                               required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark">
                        <i class="bi bi-lock me-2"></i>Contraseña
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-key"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="••••••••" 
                               required>
                    </div>
                </div>

                <!-- Botón de login -->
                <button type="submit" class="btn btn-login w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                </button>

                <!-- Separador -->
                <div class="text-center">
                    <hr class="my-3">
                    <p class="text-muted mb-0">
                        ¿No tienes cuenta? 
                        <a href="{{ route('registro') }}" class="register-link">
                            Crear una cuenta
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>