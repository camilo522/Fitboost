<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost - Registro (Dark Glow)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* COLORES VERDES NEON (Estilo Dark Glow) */
        :root {
            --glow-color: #39a900; /* Verde principal para brillo */
            --dark-glow-color: #2d8200; /* Tono más oscuro */
        }
        
        body {
            /* Fondo Negro con Efecto Radial de Brillo Verde */
            background: #000000;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
            padding: 2rem 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Efecto de luz radial neón */
            background: radial-gradient(circle at 30% 50%, rgba(57, 169, 0, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 70% 50%, rgba(45, 130, 0, 0.1) 0%, transparent 50%);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .register-card { 
            /* Fondo con degradado de verde oscuro/neón y transparencia */
            background: linear-gradient(135deg, rgba(57, 169, 0, 0.95) 0%, rgba(45, 130, 0, 0.95) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(57, 169, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
            /* Sombra y brillo animado */
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

        .register-header { 
            background: rgba(0, 0, 0, 0.3);
            padding: 2rem;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .register-logo { 
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

        .register-logo i { 
            font-size: 2.5rem;
            color: var(--glow-color); 
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            /* Estilo Dark Glow: Borde y fondo blanco semitransparente */
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

        .btn-register { 
            /* Botón blanco con texto verde neón */
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
            color: var(--glow-color); 
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 30px rgba(255, 255, 255, 0.5);
            background: #ffffff;
            color: var(--dark-glow-color); 
            border-color: #ffffff;
        }

        .login-link { 
            /* Enlace en blanco con sombra de texto */
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .login-link:hover {
            color: #ffffff;
            text-decoration: underline;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        .input-group-text { 
            /* Fondo blanco con icono verde neón */
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--glow-color); 
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
            /* Etiquetas en blanco/claro */
            color: rgba(255, 255, 255, 0.95); 
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .text-muted {
            /* Texto secundario en blanco semitransparente */
            color: rgba(255, 255, 255, 0.7) !important;
        }

        hr {
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Estilo para los Badges de Features */
        .feature-badge { 
            display: inline-flex;
            align-items: center;
            /* Fondo semitransparente en el tono de la tarjeta */
            background: rgba(0, 0, 0, 0.1); 
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin: 0.25rem;
            font-size: 0.85rem;
            color: #fff; /* Texto blanco */
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
        }

        .feature-badge i {
            margin-right: 0.5rem;
            color: var(--glow-color); /* Icono interno en verde neón */
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="register-card" style="width: 500px; max-width: 95%;">
        
        <div class="register-header">
            <div class="register-logo">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <h3 class="text-white fw-bold mb-0">FitBoost</h3>
            <p class="text-white-50 mb-0 mt-1">Comienza tu transformación</p>
        </div>

        <div class="p-4">
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

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

                <button type="submit" class="btn btn-register w-100 mb-3">
                    <i class="bi bi-person-plus-fill me-2"></i>Crear mi cuenta
                </button>

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