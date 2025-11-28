@extends('layouts.app')

@section('title', 'Perfil de ' . $usuario->nombre)

@section('content')
<div class="container mt-4">

    {{-- ============================ --}}
    {{-- PORTADA ESTILO FACEBOOK     --}}
    {{-- ============================ --}}
    <div class="card shadow border-0">
        <div class="position-relative">

            {{-- Imagen de portada (estática o editable si quieres) --}}
            
            {{-- Foto de perfil --}}
            <div class="position-absolute" style="bottom: -60px; left: 30px;">
                <img src="{{ $usuario->foto ? asset('imagenes/perfiles/imagen1perfil.jpg' . $usuario->foto) : asset('imagenes/perfiles/imagen1perfil.jpg') }}"
                     class="rounded-circle border border-3 border-white shadow"
                     style="width:120px; height:120px; object-fit:cover;">
            </div>

            {{-- Botón para subir foto --}}
            <div class="position-absolute" style="bottom: -10px; left: 165px;">
                <form action="{{ route('usuario.subirFoto', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-camera-fill"></i> Cambiar foto
                        <input type="file" name="foto" class="d-none" onchange="this.form.submit()">
                    </label>
                </form>
            </div>
        </div>

        {{-- ============================ --}}
        {{-- INFORMACIÓN DEL USUARIO     --}}
        {{-- ============================ --}}
        <div class="card-body mt-5">

            <h2 class="fw-bold">{{ $usuario->nombre }}</h2>
            <p class="text-muted">{{ $usuario->email }}</p>

            <hr>

            <div class="row g-4 mt-3">

                {{-- ============================ --}}
                {{-- ÚLTIMA VALORACIÓN            --}}
                {{-- ============================ --}}
                <div class="col-md-6">
                    <div class="card shadow rounded-4 p-4">
                        <h5 class="fw-bold">Última valoración</h5>
                        
                        <a href="{{ route('valoraciones.index') }}" 
                           class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                            <i class="bi bi-clock-history"></i> Ver valoraciones
                        </a>
                    </div>
                </div>

                {{-- ============================ --}}
                {{-- RUTINA ASIGNADA              --}}
                {{-- ============================ --}}
                <div class="col-md-6">
                    <div class="card shadow rounded-4 p-4">
                        <h5 class="fw-bold">Rutina asignada</h5>

                        <a href="{{ route('rutinas.index') }}" 
                           class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                            <i class="bi bi-plus-circle"></i> Asignar rutina
                        </a>
                    </div>
                </div>

                {{-- ============================ --}}
                {{-- PLAN NUTRICIONAL             --}}
                {{-- ============================ --}}
                <div class="col-md-6">
                    <div class="card shadow rounded-4 p-4">
                        <h5 class="fw-bold">Plan nutricional</h5>

                        <a href="{{ route('planes-nutricionales.index') }}" 
                           class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                            <i class="bi bi-plus-circle"></i> Asignar plan
                        </a>
                    </div>
                </div>

            </div>

            <div class="mt-4">
                <a href="{{ route('usuario.index') }}" 
                   class="btn btn-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
