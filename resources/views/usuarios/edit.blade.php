@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('titleContent')
    <h1 class="fw-bold text-gradient"><i class="bi bi-person-plus-fill"></i> Nuevo Usuario</h1>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control rounded-pill shadow-sm" id="nombre" name="nombre" placeholder="Escribe el nombre" required value="{{$usuario->nombre}}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                    <input type="email" class="form-control rounded-pill shadow-sm" id="email" name="email" placeholder="ejemplo@correo.com" required value="{{$usuario->email}}">
                </div>

                <div class="mb-3">
                    <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                    <input type="text" class="form-control rounded-pill shadow-sm" id="contrasena" name="contrasena" placeholder="****" required value="{{$usuario->contrasena}}">
                </div>
                
                <div class="mb-3">
                    <label for="fechaRegistro" class="form-label fw-bold">Fecha Registro</label>
                    <input type="date" class="form-control rounded-pill shadow-sm" id="fechaRegistro" name="fechaRegistro" placeholder   value="{{$usuario->fechaRegistro}}">
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
@endsection