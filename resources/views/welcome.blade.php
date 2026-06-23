@extends('layouts.app')

@section('title', 'Dashboard | FitBoost')

@section('content')

{{-- Estilos integrados dedicados a la estética Glassmorphism en el Panel --}}
<style>
    /* Tarjeta de Cristal adaptada para fondo claro o paneles */
    .glass-card-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* Efecto Hover para los módulos interactivos */
    .dashboard-card-interactive {
        cursor: pointer;
    }
    .dashboard-card-interactive:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 12px 40px 0 rgba(57, 169, 0, 0.15);
        border-color: rgba(57, 169, 0, 0.3);
    }

    /* Rediseño de los contenedores de iconos */
    .panel-icon-shape {
        width: 60px;
        height: 60px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.6rem;
        transition: transform 0.3s ease;
    }
    .dashboard-card-interactive:hover .panel-icon-shape {
        transform: scale(1.1) rotate(5deg);
    }

    /* Variantes translúcidas basadas en la paleta oficial */
    .bg-glass-success { background: rgba(57, 169, 0, 0.15); color: #2d8200; }
    .bg-glass-primary { background: rgba(13, 110, 253, 0.15); color: #0a58ca; }
    .bg-glass-warning { background: rgba(255, 193, 7, 0.15); color: #9a7004; }
    .bg-glass-danger { background: rgba(220, 53, 69, 0.15); color: #a51d24; }
    .bg-glass-info { background: rgba(13, 202, 240, 0.15); color: #087990; }
    .bg-glass-secondary { background: rgba(108, 117, 125, 0.15); color: #495057; }

    /* Botones más suaves y estéticos estilo píldora */
    .btn-panel-pill {
        border-radius: 30px;
        padding: 0.4rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="container-fluid py-3">

    {{-- HEADER Y RESUMEN GENERAL --}}
    <div class="row g-3 mb-4 align-items-stretch">
        
        {{-- BIENVENIDA --}}
        <div class="col-12 col-md-8">
            <div class="card glass-card-panel h-100 border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-between flex-wrap w-100 gap-3">
                        <div>
                            <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                                Bienvenido a FitBoost
                            </h2>
                            <p class="text-muted mb-0 small">
                                <i class="bi bi-mortarboard-fill text-success me-1"></i> 
                                Plataforma de entrenamiento y seguimiento físico - SENA
                            </p>
                        </div>
                        <div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger btn-panel-pill small">
                                    <i class="bi bi-box-arrow-right me-1"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RESUMEN CENTRAL --}}
        <div class="col-12 col-md-4">
            <div class="card glass-card-panel h-100 border-0" style="background: linear-gradient(135deg, rgba(57, 169, 0, 0.25) 0%, rgba(45, 130, 0, 0.1) 100%);">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="fw-bold text-success mb-0">FitBoost</h4>
                        <p class="text-secondary small mb-0">Gestión Fitness Integral</p>
                    </div>
                    <div class="fs-1 text-success opacity-50 pe-2">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CUADRÍCULA DE MÓDULOS --}}
    <div class="row g-4">

        {{-- USUARIOS --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-success mb-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Usuarios</h5>
                        <p class="text-muted small px-2">
                            Gestiona los usuarios registrados en el sistema, roles e ingresos.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('usuario.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ENTRENAMIENTOS --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-primary mb-3">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Entrenamientos</h5>
                        <p class="text-muted small px-2">
                            Administra los entrenamientos activos y objetivos físicos de los usuarios.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('entrenamientos.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- VALORACIONES --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-warning mb-3">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Valoraciones</h5>
                        <p class="text-muted small px-2">
                            Consulta el progreso físico, IMC e historiales de mediciones corporales.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('valoraciones.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- RUTINAS --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-danger mb-3">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Rutinas</h5>
                        <p class="text-muted small px-2">
                            Organiza rutinas personalizadas por niveles y planes de entrenamiento semanales.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('rutinas.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- EJERCICIOS --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-info mb-3">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Ejercicios</h5>
                        <p class="text-muted small px-2">
                            Gestiona el banco de ejercicios, grupos musculares y guías multimedia.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('ejercicios.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- PLANES NUTRICIONALES --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 glass-card-panel dashboard-card-interactive border-0 p-2">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-icon-shape bg-glass-secondary mb-3">
                            <i class="bi bi-egg-fried"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Plan Nutricional</h5>
                        <p class="text-muted small px-2">
                            Controla, asigna y administra los planes alimenticios y de hidratación.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('planes-nutricionales.index') }}" class="btn btn-success btn-panel-pill w-100 login-btn">
                            Ingresar <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection