@extends('layouts.app')

@section('title', 'Editar Usuario') <!-- Cambié el título -->

@section('titleContent')
    <h1 class="fw-bold text-gradient"><i class="bi bi-person-gear"></i> Editar Usuario</h1>
@endsection

@section('content')

    <!-- AÑADE ESTE BLOQUE PARA VER ERRORES -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Por favor, corrige los siguientes errores!</h4>
            <hr>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ... el resto de tu código ... -->
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                @csrf
                 <!-- <-- ¡LÍNEA AÑADIDA! -->

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control rounded-pill shadow-sm" id="nombre" name="nombre" placeholder="Escribe el nombre" required value="{{$usuario->nombre}}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                    <input type="email" class="form-control rounded-pill shadow-sm" id="email" name="email" placeholder="ejemplo@correo.com" required value="{{$usuario->email}}">
                </div>

                <div class="mb-3">
                <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                <small class="text-muted d-block mb-2">(Déjalo en blanco si no deseas cambiarla)</small>
                
                <div class="input-group">
                    <input type="password" class="form-control rounded-pill shadow-sm" id="password" name="password" placeholder="Escribe una nueva contraseña">
                    
                    <button class="btn btn-outline-secondary rounded-pill" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control rounded-pill shadow-sm" id="password_confirmation" name="password_confirmation" placeholder="Confirma la nueva contraseña">
                </div>
                
                <div class="mb-3">
                    <label for="fechaRegistro" class="form-label fw-bold">Fecha Registro</label>
                    <input type="date" class="form-control rounded-pill shadow-sm" id="fechaRegistro" name="fechaRegistro" value="{{$usuario->fechaRegistro}}">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('usuario.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                       <i class="bi bi-arrow-left-circle me-2"></i> Volver
                    </a>
                    <button type="submit" 
                            class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                            style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                        <i class="bi bi-check-circle me-2"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>
@endsection