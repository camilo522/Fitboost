@extends('layouts.app')

@section('title', 'Editar Usuario | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para formularios --}}
<style>
    /* Cabecera de sección estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor del Formulario */
    .glass-card-form {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Icono estilizado a la izquierda en inputs */
    .input-group-text-custom {
        background: rgba(241, 245, 249, 0.9) !important;
        border: 1px solid #d1d5db !important;
        border-radius: 14px 0 0 14px !important;
        color: #64748b;
        padding-left: 1.1rem;
        padding-right: 1.1rem;
    }

    /* Ajuste para inputs estándar con icono a la izquierda */
    .input-custom-with-icon {
        border-radius: 0 14px 14px 0 !important;
    }

    /* Control de contraseña en grupo */
    .input-password-custom {
        border-radius: 0 !important;
    }
    .btn-toggle-password-custom {
        border: 1px solid #d1d5db !important;
        border-left: none !important;
        background: rgba(241, 245, 249, 0.9) !important;
        border-radius: 0 14px 14px 0 !important;
        color: #64748b;
        transition: all 0.2s ease;
    }
    .btn-toggle-password-custom:hover {
        color: var(--sena-primary);
    }

    /* Botón píldora personalizado */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.6rem;
        font-weight: 700;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-2">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-person-gear me-2"></i>Editar Usuario
                    </h2>
                    <p class="text-muted mb-0 small">
                        Modificar los datos generales o actualizar credenciales del usuario
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO PRINCIPAL --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card glass-card-form border-0">
                <div class="card-body p-4 p-md-5">

                    {{-- Formulario configurado nativamente con POST tal como estaba --}}
                    <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- FOTO DE PERFIL --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-bold text-secondary mb-2">
                                <i class="bi bi-image me-1"></i> Foto de Perfil
                            </label>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                @if($usuario->foto)
                                    <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de {{ $usuario->nombre }}" class="rounded-circle" width="80" height="80">
                                @else
                                    <div class="avatar-circle-lg shadow-sm">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>
                            <input type="file"
                                   class="form-control mt-3 @error('foto') is-invalid @enderror"
                                   id="foto"
                                   name="foto"
                                   accept="image/jpeg,image/png">
                            @error('foto')
                                <div class="text-danger small mt-1 fw-semibold">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold text-secondary mb-2">
                                <i class="bi bi-card-text me-1"></i> Nombre Completo
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text"
                                       class="form-control input-custom-with-icon @error('nombre') is-invalid @enderror"
                                       id="nombre"
                                       name="nombre"
                                       placeholder="Escribe el nombre"
                                       value="{{ old('nombre', $usuario->nombre) }}"
                                       required>
                            </div>
                            @error('nombre')
                                <div class="text-danger small mt-1 fw-semibold">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-secondary mb-2">
                                <i class="bi bi-envelope me-1"></i> Correo Electrónico
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-envelope-at"></i>
                                </span>
                                <input type="email"
                                       class="form-control input-custom-with-icon @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       placeholder="ejemplo@correo.com"
                                       value="{{ old('email', $usuario->email) }}"
                                       required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1 fw-semibold">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="password" class="form-label fw-bold text-secondary mb-0">
                                    <i class="bi bi-shield-lock me-1"></i> Nueva Contraseña
                                </label>
                                <span class="text-muted small fw-medium">(Dejar en blanco para no cambiar)</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password"
                                       class="form-control input-password-custom @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Escribe una nueva contraseña si deseas actualizarla">
                                <button class="btn btn-toggle-password-custom"
                                        type="button"
                                        id="togglePassword">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1 fw-semibold">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CONFIRMAR PASSWORD --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold text-secondary mb-2">
                                <i class="bi bi-shield-check me-1"></i> Confirmar Nueva Contraseña
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password"
                                       class="form-control input-custom-with-icon"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Confirma la nueva contraseña">
                            </div>
                        </div>

                        {{-- FECHA DE REGISTRO --}}
                        <div class="mb-4">
                            <label for="fechaRegistro" class="form-label fw-bold text-secondary mb-2">
                                <i class="bi bi-calendar-event me-1"></i> Fecha Registro
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-custom">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="date"
                                    class="form-control input-custom-with-icon @error('fechaRegistro') is-invalid @enderror"
                                    id="fechaRegistro"
                                    name="fechaRegistro"
                                    value="{{ old('fechaRegistro', htmlspecialchars(\Carbon\Carbon::parse($usuario->fechaRegistro)->format('Y-m-d'))) }}">
                            </div>
                            @error('fechaRegistro')
                                <div class="text-danger small mt-1 fw-semibold">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BOTONES DE ACCIÓN --}}
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-light">
                            <a href="{{ route('usuario.index') }}"
                               class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                                <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-success btn-panel-pill shadow-sm">
                                <i class="bi bi-check-circle me-2"></i> Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- SCRIPT INTERACTIVO MOSTRAR / OCULTAR PASSWORD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                // Cambiar el ícono dinámicamente
                eyeIcon.classList.toggle('bi-eye');
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        }
    });
</script>

@endsection