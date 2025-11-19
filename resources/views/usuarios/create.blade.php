@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('titleContent')
    <h1 class="fw-bold text-gradient"><i class="bi bi-person-plus-fill"></i> Nuevo Usuario</h1>
@endsection


@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('usuario.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control rounded-pill shadow-sm" id="nombre" name="nombre" placeholder="Escribe el nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                    <input type="email" class="form-control rounded-pill shadow-sm" id="email" name="email" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="mb-3">
                <label for="password" class="form-label fw-bold">Contraseña</label>
                
                <!-- Contenedor para el input y el ojito -->
                <div class="input-group">
                    <input type="password" class="form-control rounded-pill shadow-sm" id="password" name="password" placeholder="****" required>
                    
                    <!-- Botón para mostrar/ocultar la contraseña -->
                    <button class="btn btn-outline-secondary rounded-pill" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                </div>
                
                <div class="mb-3">
                    <label for="fechaRegistro" class="form-label fw-bold">fechaRegistro</label>
                    <input type="date" class="form-control rounded-pill shadow-sm" id="fechaRegistro" name="fechaRegistro" placeholder >
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
                        <i class="bi bi-check-circle me-2"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('contrasena');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
        // Cambia el tipo del input entre 'password' y 'text'
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Cambia el icono del ojo
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>
@endsection