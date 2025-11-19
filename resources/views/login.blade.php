<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login FitBoost</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        /* Fondo gris estilo FitBoost */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: #2b2b2b; /* gris oscuro */
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
    background: rgba(0, 0, 0, 0.55);
    z-index: 1;
    pointer-events: none; /* 🔹 Permite interactuar con los elementos debajo */
}

        /* Card estilizada */
        .login-card {
            z-index: 2;
            background: rgba(255, 255, 255, 0.12);
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 25px rgba(255, 0, 0, 0.2);
            animation: fadeIn 1.2s ease-in-out;
            color: white;
        }

        .login-card h3 {
            color: #ff4d4d;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Botón rojo FitBoost */
        .btn-fitboost {
            width: 100%;
            padding: 10px;
            border-radius: 30px;
            background: #ff4d4d;
            border: none;
            transition: 0.3s;
            color: white;
        }

        .btn-fitboost:hover {
            background: #ff1a1a;
            transform: scale(1.05);
        }

        /* Animación */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Inputs */
        .form-control {
            border-radius: 10px;
        }

        /* Mensajes */
        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="login-card">

                <div class="text-center mb-3">
                    <h3>Iniciar Sesión</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif 

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                        
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn-fitboost">Ingresar</button>
                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>
