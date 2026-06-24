<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FitBoost | Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

</head>

<body class="login-page-custom">

<div class="login-overlay"></div>

<div class="container">

<div class="row min-vh-100 justify-content-center align-items-center">

    <div class="col-lg-5 col-md-8">

        <div class="login-glass-card">

            {{-- HEADER --}}
            <div class="text-center mb-4">

                <img src="{{ asset('imagenes/logo.png') }}"
                     alt="FitBoost"
                     class="login-logo-img mb-3">

                <h2 class="fw-bold text-white">
                    FITBOOST
                </h2>

                <p class="text-light opacity-75">
                    Plataforma Fitness - SENA
                </p>

            </div>

            {{-- ALERTAS --}}
            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $e)

                            <li>{{ $e }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('login.submit') }}" method="POST">

                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">

                    <label class="form-label text-white fw-semibold">
                        Correo Electrónico
                    </label>

                    <div class="input-group">

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
                <div class="mb-4">

                    <label class="form-label text-white fw-semibold">
                        Contraseña
                    </label>

                    <div class="input-group">

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

                {{-- BOTON --}}
                <button type="submit"
                        class="btn btn-success w-100 login-btn">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Iniciar Sesión

                </button>

            </form>

            {{-- REGISTER --}}
            <div class="text-center mt-4">

                <p class="text-light opacity-75 mb-0">

                    ¿No tienes cuenta?

                    <a href="{{ route('registro') }}"
                       class="login-link">

                        Registrarse

                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

</div>

</body>

</html>
