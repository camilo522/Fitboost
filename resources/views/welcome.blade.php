@extends('layouts.app')

@section('title', 'FitBoost')

@section('content')
<div class="container my-5">
    <!-- Logo del proyecto -->
    <div class="text-center mb-5">
        <img src="{{ asset('imagenes/logo.pgn.jpeg') }}" alt="Logo FitBoost" style="width: 150px; height: auto;">
        <h1 class="fw-bold mt-3">Panel principal</h1>
    </div>

    <div  class="row justify-content-center g-4 mb-4">
        
        <!-- Usuarios -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="{{ asset('imagenes/usuairos.png') }}" alt="Usuarios" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Gestiona todos los usuarios de la aplicación.</p>
                    <a href="{{ route('usuario.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);" >Ir</a>
                </div>
            </div>
        </div>

        <!-- Entrenamientos -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="{{ asset('imagenes/entrenamientos.png') }}" alt="Entrenamientos" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Entrenamientos</h5>
                    <p class="card-text">Administra sesiones de entrenamiento.</p>
                    <a href="{{ route('entrenamientos.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Valoraciones -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="{{ asset('imagenes/valoraciones.png') }}" alt="Valoraciones" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Valoraciones</h5>
                    <p class="card-text">Consulta el progreso físico y mediciones.</p>
                    <a href="{{ route('valoraciones.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

    </div>

<div class="row justify-content-center g-4">

        <!-- Rutinas -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="{{ asset('imagenes/rutinas.png') }}" alt="Rutinas" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Rutinas</h5>
                    <p class="card-text">Administra rutinas de entrenamiento.</p>
                    <a href="{{ route('rutinas.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- Ejercicios -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="{{ asset('imagenes/ejercicios.png') }}" alt="Ejercicios" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Ejercicios</h5>
                    <p class="card-text">Consulta tu rutina para ver qué lleva.</p>
                    <a href="{{ route('ejercicios.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>

        <!-- plan nutricional -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg border-0 rounded-4 card-hover">
                <div class="card-body">
                    <img src="" alt="Ejercicios" class="card-img-top mb-3 custom-img">
                    <h5 class="card-title">Plan nutrici onal</h5>
                    <p class="card-text">Plan nutrici onal</p>
                    <a href="{{ route('planes-nutricionales.index') }}" class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">Ir</a>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Estilos personalizados -->
<style>
    /* Tamaño más grande de las imágenes */
    .custom-img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    /* Cards más grandes */
    .card {
        padding: 20px;
        min-height: 280px;
    }

    /* Efecto hover */
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }
</style>
@endsection
