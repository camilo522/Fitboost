@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('titleContent')
    <h1 class="fw-bold text-gradient">
        <i class="bi bi-person-plus-fill"></i> Nuevo Usuario
    </h1>
@endsection

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            {{-- ALERTA ÉXITO --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            <form action="{{ route('usuario.store') }}" method="POST">
                @csrf

                {{-- NOMBRE --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">
                        Nombre
                    </label>

                    <input type="text"
                           class="form-control rounded-pill shadow-sm @error('nombre') is-invalid @enderror"
                           id="nombre"
                           name="nombre"
                           placeholder="Escribe el nombre"
                           value="{{ old('nombre') }}">

                    @error('nombre')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">
                        Correo Electrónico
                    </label>

                    <input type="email"
                        class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        placeholder="ejemplo@correo.com">

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">

                    <label for="password" class="form-label fw-bold">
                        Contraseña
                    </label>

                    <div class="input-group">

                        <input type="password"
                               class="form-control rounded-start-pill shadow-sm @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="********"
                               required>

                        <button class="btn btn-outline-secondary rounded-end-pill"
                                type="button"
                                id="togglePassword">

                            <i class="bi bi-eye" id="eyeIcon"></i>

                        </button>
                    </div>

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- FECHA --}}
                <div class="mb-3">

                    <label for="fechaRegistro" class="form-label fw-bold">
                        Fecha Registro
                    </label>

                    <input type="date"
                        class="form-control rounded-pill shadow-sm @error('fechaRegistro') is-invalid @enderror"
                        id="fechaRegistro"
                        name="fechaRegistro">

                    @error('fechaRegistro')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('usuario.index') }}"
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold"
                       style="background: linear-gradient(90deg, #11cb64, #03c937);">

                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Volver

                    </a>

                    <button type="submit"
                            class="btn rounded-pill shadow-sm px-4 text-white fw-bold"
                            style="background: linear-gradient(90deg, #11cb64, #03c937);">

                        <i class="bi bi-check-circle me-2"></i>
                        Guardar

                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

{{-- SCRIPT MOSTRAR PASSWORD --}}
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {

        const type = passwordInput.getAttribute('type') === 'password'
            ? 'text'
            : 'password';

        passwordInput.setAttribute('type', type);

        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>

@endsection