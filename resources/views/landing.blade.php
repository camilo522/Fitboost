<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitBoost - Bienvenido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('/images/fitboost.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Capa oscura */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .welcome-container {
            z-index: 2;
            text-align: center;
            color: #fff;
            animation: fadeIn 2s ease-in-out;
        }

        .welcome-container h1 {
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .welcome-container p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn-custom {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 30px;
            background: #ff4d4d;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #ff1a1a;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>Bienvenido a <span style="color:#ff4d4d;">FitBoost</span></h1>
        <p>Tu compañero ideal para alcanzar tus metas fitness</p>

        <!-- BOTÓN QUE REDIRIGE AL LOGIN -->
        <a href="{{ route('login') }}" class="btn btn-custom">Iniciar sesión</a>
    </div>
</body>
</html>
