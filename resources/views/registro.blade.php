<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost | Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <style>
        /* Estilo complementario para las insignias de características adaptadas al vidrio */
        .feature-badge-custom { 
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1); 
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            margin: 0.15rem;
            font-size: 0.8rem;
            color: #fff;
        }
        .feature-badge-custom i {
            margin-right: 0.4rem;
            color: #198754;
        }
        
        /* Optimización de altura para que quepa al 100% en monitores de PC */
        @media (min-width: 992px) {
            .login-glass-card {
                padding: 1.75rem !important; /* Tarjeta ligeramente más compacta */
            }
            .login-logo-img {
                max-height: 55px; /* Evita que el logo empuje el formulario */
                width: auto;
            }
        }

        @media (max-width: 576px) {
            .login-glass-card {
                padding: 1.25rem !important;
            }
            .feature-badge-custom {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</head>
<body class="login-page-custom">

<div class="login-overlay"></div>

<div class="container">
    <div class="row justify-content-center align-items-center py-3 min-vh-100">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <div class="login-glass-card">
                
                {{-- HEADER --}}
                <div class="text-center mb-3">
                    <img src="{{ asset('imagenes/logo.png') }}"
                         alt="FitBoost"
                         class="login-logo-img mb-2 img-fluid" style="max-height: 60px; width: auto;">
                    <h2 class="fw-bold text-white fs-4 mb-0">FITBOOST</h2>
                    <p class="text-light opacity-75 small mb-0">Comienza tu transformación - SENA</p>
                </div>

                {{-- ALERTAS --}}
                @if(session('success'))
                    <div class="alert alert-success py-2 small mb-2">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger py-2 small mb-2">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('registro.submit') }}" method="POST">
                    @csrf

                    {{-- NOMBRE --}}
                    <div class="mb-2">
                        <label class="form-label text-white fw-semibold small mb-1">Nombre Completo</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text login-input-icon">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" 
                                   name="name" 
                                   class="form-control login-input" 
                                   placeholder="Ingresa tu nombre completo" 
                                   value="{{ old('name') }}"
                                   required>
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-2">
                        <label class="form-label text-white fw-semibold small mb-1">Correo Electrónico</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text login-input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   name="email" 
                                   class="form-control login-input" 
                                   placeholder="correo@correo.com" 
                                   value="{{ old('email') }}"
                                   required>
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label text-white fw-semibold small mb-1">Contraseña</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text login-input-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   name="password" 
                                   class="form-control login-input" 
                                   placeholder="********" 
                                   required>
                        </div>
                    </div>

                    {{-- CARACTERÍSTICAS / BADGES --}}
                    <div class="mb-3 text-center">
                        <div class="d-flex flex-wrap justify-content-center">
                            <span class="feature-badge-custom">
                                <i class="bi bi-check-circle-fill"></i> Rutinas
                            </span>
                            <span class="feature-badge-custom">
                                <i class="bi bi-check-circle-fill"></i> Nutrición
                            </span>
                            <span class="feature-badge-custom">
                                <i class="bi bi-check-circle-fill"></i> Logros
                            </span>
                        </div>
                    </div>

                    {{-- BOTON --}}
                    <button type="submit" class="btn btn-success w-100 login-btn py-2">
                        <i class="bi bi-person-plus-fill me-2"></i>Crear mi cuenta
                    </button>
                </form>

                {{-- VOLVER AL LOGIN --}}
                <div class="text-center mt-3">
                    <p class="text-light opacity-75 mb-0 small">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="login-link fw-semibold">
                            Iniciar Sesión
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>