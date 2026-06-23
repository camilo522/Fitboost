<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost | Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <style>
        /* Partículas flotantes que respetan el overlay */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            animation: float-up 15s infinite ease-in-out;
        }

        @keyframes float-up {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-80vh) translateX(30px); opacity: 0; }
        }

        /* Características con efecto cristalizado unificado */
        .landing-feature-icon {
            width: 55px;
            height: 55px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            transition: all 0.3s ease;
            margin: 0 auto 0.5rem;
        }

        .landing-feature-item:hover .landing-feature-icon {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }

        /* Botón de crear cuenta secundario traslúcido */
        .btn-landing-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            border: 2px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .btn-landing-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
        }

        /* Ajustes finos de visualización en pantallas */
        @media (min-width: 992px) {
            .landing-card-custom {
                padding: 3rem !important;
            }
        }
    </style>
</head>
<body class="login-page-custom">

<div class="login-overlay"></div>

<div class="particle" style="width: 40px; height: 40px; top: 75%; left: 15%; animation-delay: 0s;"></div>
<div class="particle" style="width: 25px; height: 25px; top: 65%; left: 85%; animation-delay: 2s;"></div>
<div class="particle" style="width: 35px; height: 35px; top: 35%; left: 75%; animation-delay: 4s;"></div>
<div class="particle" style="width: 50px; height: 50px; top: 80%; left: 45%; animation-delay: 1s;"></div>

<div class="container position-relative text-center" style="z-index: 2;">
    <div class="row min-vh-100 justify-content-center align-items-center py-4">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
            
            <div class="login-glass-card landing-card-custom py-5 px-4">
                
                {{-- HEADER / LOGO --}}
                <div class="mb-4">
                    <img src="{{ asset('imagenes/logo.png') }}"
                         alt="FitBoost"
                         class="login-logo-img mb-3 img-fluid" style="max-height: 85px; width: auto;">
                    <h1 class="fw-bold text-white display-5 mb-2" style="letter-spacing: 2px;">FITBOOST</h1>
                    <p class="text-light opacity-75 fs-5">Tu compañero ideal para alcanzar tus metas fitness</p>
                </div>

                <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.15);">

                {{-- FEATURES --}}
                <div class="row justify-content-center g-3 mb-5">
                    <div class="col-4 col-sm-3 landing-feature-item">
                        <div class="landing-feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <span class="text-white small fw-medium d-block">Seguimiento</span>
                    </div>
                    <div class="col-4 col-sm-3 landing-feature-item">
                        <div class="landing-feature-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <span class="text-white small fw-medium d-block">Rutinas</span>
                    </div>
                    <div class="col-4 col-sm-3 landing-feature-item">
                        <div class="landing-feature-icon">
                            <i class="bi bi-apple"></i>
                        </div>
                        <span class="text-white small fw-medium d-block">Nutrición</span>
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="row justify-content-center g-3">
                    <div class="col-12 col-sm-6 col-md-5">
                        <a href="{{ route('login') }}" class="btn btn-success w-100 login-btn py-3 fw-bold rounded-pill">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-5">
                        <a href="{{ route('registro') }}" class="btn btn-landing-secondary w-100 py-3 fw-bold rounded-pill">
                            <i class="bi bi-person-plus me-2"></i> Crear Cuenta
                        </a>
                    </div>
                </div>

                {{-- PIE DE PÁGINA MÍNIMO --}}
                <div class="mt-4 pt-2">
                    <span class="text-light opacity-50 small">Plataforma Fitness - SENA</span><br>
                    <span class="text-light opacity-50 small">Realizado por: @ Camilo Rojas & @ Kevin Sanchez</span>
                </div>

            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>