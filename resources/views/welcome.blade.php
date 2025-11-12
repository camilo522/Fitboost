@extends('layouts.app')

@section('title', 'FitBoost')

@section('content')
<div class="container my-5">
    
    <div class="text-center mb-5">
        <h1 class="fw-bold mt-6">Panel principal</h1>
    </div>

    <div class="row justify-content-center g-4 mb-4">
        
        <!-- Usuarios -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/image.png') }}" alt="Usuarios" class="custom-img mb-3">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Gestiona todos los usuarios de la aplicación.</p>
                    <a href="{{ route('usuario.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Entrenamientos -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/2.png') }}" alt="Entrenamientos" class="custom-img mb-3">
                    <h5 class="card-title">Entrenamientos</h5>
                    <p class="card-text">Administra sesiones de entrenamiento.</p>
                    <a href="{{ route('entrenamientos.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Valoraciones -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/7.jpg') }}" alt="Valoraciones" class="custom-img mb-3">
                    <h5 class="card-title">Valoraciones</h5>
                    <p class="card-text">Consulta el progreso físico y mediciones.</p>
                    <a href="{{ route('valoraciones.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center g-4">

        <!-- Rutinas -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/5.png') }}" alt="Rutinas" class="custom-img mb-3">
                    <h5 class="card-title">Rutinas</h5>
                    <p class="card-text">Administra rutinas de entrenamiento.</p>
                    <a href="{{ route('rutinas.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Ejercicios -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/6.png') }}" alt="Ejercicios" class="custom-img mb-3">
                    <h5 class="card-title">Ejercicios</h5>
                    <p class="card-text">Consulta tu rutina para ver qué lleva.</p>
                    <a href="{{ route('ejercicios.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Plan nutricional -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <img src="{{ asset('imagenes/8.png') }}" alt="Plan nutricional" class="custom-img mb-3">
                    <h5 class="card-title">Plan nutricional</h5>
                    <p class="card-text">Administra tus planes alimenticios.</p>
                    <a href="{{ route('planes-nutricionales.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold mt-2"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Tamaño uniforme de imágenes */
    .custom-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }

    /* Cards del mismo tamaño */
    .card {
        min-height: 350px;
    }

    /* Hover animado */
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }
</style>
@endsection
