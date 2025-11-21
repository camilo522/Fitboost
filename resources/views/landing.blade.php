<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost - Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: url('/images/fitboost.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Capa oscura con gradiente */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(106, 17, 203, 0.85) 0%, rgba(37, 117, 252, 0.85) 100%);
            z-index: 1;
        }

        /* Animación de partículas flotantes */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            animation: float 15s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) translateX(50px); opacity: 0; }
        }

        .welcome-container {
            z-index: 2;
            text-align: center;
            color: #fff;
            max-width: 900px;
            padding: 2rem;
            animation: fadeInUp 1s ease-out;
        }

        .logo-container {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: pulse 2s infinite ease-in-out;
        }

        .logo-container i {
            font-size: 4rem;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 15px 50px rgba(255, 255, 255, 0.4); }
        }

        .welcome-container h1 {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: 3px;
            margin-bottom: 1rem;
            text-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .welcome-container h1 .brand {
            background: linear-gradient(90deg, #fff 0%, #e0e0e0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .welcome-container .tagline {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 1rem;
            opacity: 0.95;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .feature-list {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.3);
        }

        .feature-text {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 3rem;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.8s both;
        }

        .btn-custom {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-primary-custom {
            background: white;
            color: #6a11cb;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 255, 255, 0.4);
            color: #2575fc;
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid white;
            backdrop-filter: blur(10px);
        }

        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 255, 255, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-container h1 {
                font-size: 2.5rem;
            }
            
            .welcome-container .tagline {
                font-size: 1.2rem;
            }

            .feature-list {
                gap: 1rem;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
            }

            .btn-custom {
                width: 100%;
                max-width: 300px;
            }
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-10px); }
            60% { transform: translateX(-50%) translateY(-5px); }
        }
    </style>
</head>
<body>
    <!-- Partículas flotantes -->
    <div class="particle" style="width: 50px; height: 50px; top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="width: 30px; height: 30px; top: 60%; left: 80%; animation-delay: 2s;"></div>
    <div class="particle" style="width: 40px; height: 40px; top: 40%; left: 70%; animation-delay: 4s;"></div>
    <div class="particle" style="width: 60px; height: 60px; top: 70%; left: 20%; animation-delay: 1s;"></div>
    <div class="particle" style="width: 35px; height: 35px; top: 30%; left: 50%; animation-delay: 3s;"></div>

    <div class="welcome-container">
        <!-- Logo -->
        <div class="logo-container">
            <i class="bi bi-lightning-charge-fill"></i>
        </div>

        <!-- Título principal -->
        <h1>
            Bienvenido a <span class="brand">FitBoost</span>
        </h1>
        
        <p class="tagline">
            Tu compañero ideal para alcanzar tus metas fitness
        </p>

        <!-- Features -->
        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <span class="feature-text">Seguimiento</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <span class="feature-text">Entrenamientos</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="bi bi-apple"></i>
                </div>
                <span class="feature-text">Nutrición</span>
            </div>
            
        </div>

        <!-- Botones -->
        <div class="button-group">
            <a href="{{ route('login') }}" class="btn-custom btn-primary-custom">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar sesión
            </a>
            <a href="{{ route('registro') }}" class="btn-custom btn-secondary-custom">
                <i class="bi bi-person-plus"></i>
                Crear cuenta
            </a>
        </div>
    </div>

    <!-- Indicador de scroll -->
    <div class="scroll-indicator">
        <i class="bi bi-chevron-down text-white" style="font-size: 2rem; opacity: 0.7;"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>