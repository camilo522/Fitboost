<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            padding: 2rem;
            text-align: center;
        }

        .register-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .register-logo i {
            font-size: 2.5rem;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.15);
        }

        .btn-register {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
            color: white;
        }

        .login-link {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            color: #2575fc;
            text-decoration: underline;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: #6a11cb;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .form-label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .feature-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(90deg, rgba(106, 17, 203, 0.1), rgba(37, 117, 252, 0.1));
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin: 0.25rem;
            font-size: 0.85rem;
            color: #6a11cb;
        }

        .feature-badge i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="register-card" style="width: 500px; max-width: 95%;">
        
        <!-- Header con logo -->
        <div class="register-header">
            <div class="register-logo">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <h3 class="text-white fw-bold mb-0">FitBoost</h3>
            <p class="text-white-50 mb-0 mt-1">Comienza tu transformación</p>
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

            <form action="{{ route('registro.submit') }}" method="POST">
                @csrf

                <!-- Nombre -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-person-fill me-2"></i>Nombre Completo
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" 
                               name="name" 
                               class="form-control" 
                               placeholder="Ingresa tu nombre completo" 
                               value="{{ old('name') }}"
                               required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-envelope-fill me-2"></i>Correo Electrónico
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               placeholder="correo@example.com" 
                               value="{{ old('email') }}"
                               required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-lock-fill me-2"></i>Contraseña
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-key"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="Mínimo 8 caracteres" 
                               required>
                    </div>
                    <small class="text-muted d-block mt-1">
                        <i class="bi bi-info-circle me-1"></i>Usa al menos 8 caracteres para mayor seguridad
                    </small>
                </div>

                <!-- Features -->
                <div class="mb-4 text-center">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="feature-badge">
                            <i class="bi bi-check-circle-fill"></i> Entrenamientos personalizados
                        </span>
                        <span class="feature-badge">
                            <i class="bi bi-check-circle-fill"></i> Planes nutricionales
                        </span>
                        <span class="feature-badge">
                            <i class="bi bi-check-circle-fill"></i> Seguimiento de progreso
                        </span>
                    </div>
                </div>

                <!-- Botón de registro -->
                <button type="submit" class="btn btn-register w-100 mb-3">
                    <i class="bi bi-person-plus-fill me-2"></i>Crear mi cuenta
                </button>

                <!-- Separador -->
                <div class="text-center">
                    <hr class="my-3">
                    <p class="text-muted mb-0">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="login-link">
                            Iniciar sesión
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