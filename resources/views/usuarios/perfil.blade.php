@extends('layouts.app')

@section('title', 'Perfil de ' . $usuario->nombre . ' | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para perfiles --}}
<style>
    /* Tarjeta superior del perfil principal */
    .glass-profile-hero {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.6));
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 24px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.04);
    }

    /* Subtarjetas de módulos internos */
    .glass-card-sub {
        background: rgba(255, 255, 255, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        transition: all 0.25s ease;
    }
    .glass-card-sub:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.05);
    }

    /* Avatar gigante del perfil */
    .avatar-circle-lg {
        width: 70px;
        height: 70px;
        background: rgba(57, 169, 0, 0.12);
        color: #2d8200;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    /* Lista estilizada de datos métricos */
    .metric-item {
        padding: 0.6rem 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.08);
    }
    .metric-item:last-child {
        border-bottom: none;
    }

    /* Píldoras de botones de control */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.5rem 1.4rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-2">

    {{-- BLOQUE HÉROE: INFORMACIÓN DE USUARIO --}}
    <div class="card glass-profile-hero border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center flex-wrap gap-4">
                <div class="avatar-circle-lg shadow-sm">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">{{ $usuario->nombre }}</h2>
                    <p class="text-secondary mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-at text-success"></i> {{ $usuario->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECCIÓN CENTRAL: VALORACIÓN + NUTRICIÓN --}}
    <div class="row g-4 mb-4">

        {{-- COLUMNA: ÚLTIMA VALORACIÓN FÍSICA --}}
        <div class="col-12 col-md-6">
            <div class="card glass-card-sub border-0 h-100 p-3">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-heart-pulse-fill text-danger fs-4"></i>
                            <h4 class="fw-bold text-dark mb-0">Última Valoración</h4>
                        </div>

                        @if($ultimaValoracion)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Peso Actual:</span>
                                    <span class="fw-bold text-dark">{{ $ultimaValoracion->peso }} kg</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Estatura:</span>
                                    <span class="fw-bold text-dark">{{ $ultimaValoracion->altura }} cm</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Índice de Masa Corporal (IMC):</span>
                                    <span class="badge bg-success rounded-pill px-2 py-1">{{ $ultimaValoracion->imc }}</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Fecha de Captura:</span>
                                    <span class="text-muted fw-medium small">{{ $ultimaValoracion->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 my-auto">
                                <p class="text-muted small mb-0">No se registran mediciones antropométricas activas.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-3">
                        @if($ultimaValoracion)
                            <a href="{{ route('valoraciones.historial', $ultimaValoracion->id) }}"
                               class="btn btn-outline-success btn-panel-pill w-100">
                                <i class="bi bi-clock-history me-1"></i> Ver Historial Completo
                            </a>
                        @else
                            <a href="{{ route('valoraciones.create', $usuario->id) }}" 
                               class="btn btn-success btn-panel-pill w-100 text-white">
                                <i class="bi bi-plus-circle me-1"></i> Crear Primera Valoración
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA: PLAN NUTRICIONAL ACTIVO --}}
        <div class="col-12 col-md-6">
            <div class="card glass-card-sub border-0 h-100 p-3">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-egg-fried text-warning fs-4"></i>
                            <h4 class="fw-bold text-dark mb-0">Plan Nutricional</h4>
                        </div>

                        @if($planNutricional)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Calorías Diarias:</span>
                                    <span class="fw-bold text-success">{{ $planNutricional->calorias_diarias }} kcal</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Proteínas:</span>
                                    <span class="fw-bold text-dark">{{ $planNutricional->proteinas_gramos }} g</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Carbohidratos:</span>
                                    <span class="fw-bold text-dark">{{ $planNutricional->carbohidratos_gramos }} g</span>
                                </div>
                                <div class="d-flex justify-content-between metric-item">
                                    <span class="text-secondary fw-semibold">Grasas Totales:</span>
                                    <span class="fw-bold text-dark">{{ $planNutricional->grasas_gramos }} g</span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 my-auto">
                                <p class="text-muted small mb-0">No se ha estructurado un régimen de macronutrientes todavía.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('planes-nutricionales.index') }}" 
                           class="btn btn-outline-success btn-panel-pill w-100">
                            <i class="bi bi-gear-fill me-1"></i> Gestionar Plan Nutricional
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SECCIÓN INFERIOR: ACCESOS COMPLEMENTARIOS DE SEGUIMIENTO --}}
    <div class="row g-4 mb-4">

        {{-- ACCESO COMPLEMENTARIO VALORACIONES --}}
        <div class="col-12 col-md-6">
            <div class="card glass-card-sub border-0 p-2">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="fs-3 text-secondary"><i class="bi bi-activity"></i></div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Módulo de Valoraciones</h5>
                            <span class="text-muted small">Consultar reportes previos</span>
                        </div>
                    </div>
                    <a href="{{ route('valoraciones.index') }}" class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                        <i class="bi bi-eye-fill me-1"></i> Abrir
                    </a>
                </div>
            </div>
        </div>

        {{-- ACCESO COMPLEMENTARIO RUTINAS --}}
        <div class="col-12 col-md-6">
            <div class="card glass-card-sub border-0 p-2">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="fs-3 text-secondary"><i class="bi bi-lightning-charge"></i></div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Planificación de Rutinas</h5>
                            <span class="text-muted small">Asignación de ejercicios semanales</span>
                        </div>
                    </div>
                    <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Asignar
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ACCIÓN DE REGRESO --}}
    <div class="mt-4">
        <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
            <i class="bi bi-arrow-left-circle me-2"></i>Volver al listado
        </a>
    </div>

</div>

@endsection