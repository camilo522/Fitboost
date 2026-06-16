@extends('layouts.app')

@section('title', 'Dashboard | FitBoost')

@section('content')

<div class="container-fluid">

{{-- HEADER --}}
<div class="row mb-4">

    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between flex-wrap">

                    <div>
                        <h2 class="fw-bold text-success mb-1">
                            Bienvenido a FitBoost
                        </h2>

                        <p class="text-muted mb-0">
                            Plataforma de entrenamiento y seguimiento físico - SENA
                        </p>
                    </div>

                    <div class="mt-3 mt-md-0">

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="btn btn-success">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Cerrar Sesión
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- CARD INFO --}}
    <div class="col-md-4">
        <div class="small-box bg-success shadow">

            <div class="inner">
                <h3>FitBoost</h3>

                <p>Sistema de gestión fitness</p>
            </div>

            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>

        </div>
    </div>

</div>

{{-- MODULOS --}}
<div class="row">

    {{-- USUARIOS --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-success">
                    <i class="fas fa-users"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Usuarios
                </h4>

                <p class="text-muted">
                    Gestiona los usuarios registrados en el sistema.
                </p>

                <a href="{{ route('usuario.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

    {{-- ENTRENAMIENTOS --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-primary">
                    <i class="fas fa-dumbbell"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Entrenamientos
                </h4>

                <p class="text-muted">
                    Administra los entrenamientos y objetivos físicos.
                </p>

                <a href="{{ route('entrenamientos.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

    {{-- VALORACIONES --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-warning">
                    <i class="fas fa-chart-line"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Valoraciones
                </h4>

                <p class="text-muted">
                    Consulta el progreso físico y mediciones corporales.
                </p>

                <a href="{{ route('valoraciones.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

    {{-- RUTINAS --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-danger">
                    <i class="fas fa-clipboard-list"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Rutinas
                </h4>

                <p class="text-muted">
                    Organiza rutinas y planes de entrenamiento.
                </p>

                <a href="{{ route('rutinas.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

    {{-- EJERCICIOS --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-info">
                    <i class="fas fa-running"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Ejercicios
                </h4>

                <p class="text-muted">
                    Gestiona ejercicios y actividades físicas.
                </p>

                <a href="{{ route('ejercicios.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

    {{-- PLANES --}}
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100 dashboard-card">

            <div class="card-body text-center">

                <div class="dashboard-icon bg-secondary">
                    <i class="fas fa-utensils"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Plan Nutricional
                </h4>

                <p class="text-muted">
                    Controla y administra los planes alimenticios.
                </p>

                <a href="{{ route('planes-nutricionales.index') }}"
                   class="btn btn-success mt-2">
                    Ingresar
                </a>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
