@extends('layouts.app')

@section('title', 'Detalle de Plan Nutricional | FitBoost')

@section('content')

<style>
    .glass-header-nutrition {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    .glass-card-nutrition {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    .plan-detail-badge {
        border-radius: 14px;
        padding: 0.85rem 1rem;
        background: #f8fafc;
        border: 1px solid rgba(226, 232, 240, 0.9);
    }

    .badge-status {
        font-weight: 700;
        font-size: 0.78rem;
        padding: 0.35rem 0.85rem;
        border-radius: 30px;
    }
    .badge-active { background: rgba(3, 201, 55, 0.12); color: #047857; border: 1px solid rgba(3, 201, 55, 0.2); }
    .badge-inactive { background: rgba(148, 163, 184, 0.12); color: #334155; border: 1px solid rgba(148, 163, 184, 0.2); }

    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.3rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }

    .btn-back-plan {
        background: linear-gradient(90deg, #0d6efd, #3b82f6);
        border: none;
    }
    .btn-back-plan:hover {
        background: linear-gradient(90deg, #0b5ed7, #2563eb);
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.24);
    }
</style>

<div class="container-fluid py-4" style="max-width: 980px;">

    <div class="card glass-header-nutrition rounded-4 border-0 mb-4 p-3">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                    <i class="bi bi-journal-text me-2"></i>Detalle del Plan Nutricional
                </h2>
                <p class="text-muted mb-0 small">
                    Revisa la meta calórica y la distribución de macronutrientes para este usuario.
                </p>
            </div>
            <div class="text-end d-flex flex-column gap-2">
                <span class="badge-status {{ $plan->activo ? 'badge-active' : 'badge-inactive' }}">
                    {{ $plan->activo ? 'Activo' : 'Inactivo' }}
                </span>
                <a href="{{ route('planes-nutricionales.index') }}" class="btn btn-white btn-panel-pill btn-back-plan text-white">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver a Planes
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card glass-card-nutrition border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Información del Usuario</h5>
                    <div class="mb-3 plan-detail-badge">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary small">Usuario</span>
                            <strong class="text-dark">{{ $plan->usuario->nombre ?? 'Usuario eliminado' }}</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary small">Correo</span>
                            <span class="text-dark small">{{ $plan->usuario->email ?? 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">Plan ID</span>
                            <span class="text-dark small">#{{ $plan->id }}</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-4 p-3 border">
                        <h6 class="fw-semibold text-secondary mb-3">Macros Objetivo</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                    <span class="text-muted">Calorías</span>
                                    <strong class="text-success">{{ number_format($plan->calorias_diarias) }} kcal</strong>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <span class="d-block text-muted small mb-1">Proteínas</span>
                                <strong class="text-dark">{{ $plan->proteinas_gramos }}g</strong>
                            </div>
                            <div class="col-4 text-center">
                                <span class="d-block text-muted small mb-1">Carbohidratos</span>
                                <strong class="text-dark">{{ $plan->carbohidratos_gramos }}g</strong>
                            </div>
                            <div class="col-4 text-center">
                                <span class="d-block text-muted small mb-1">Grasas</span>
                                <strong class="text-dark">{{ $plan->grasas_gramos }}g</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card glass-card-nutrition border-0 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-3">Notas del plan</h5>
                        @if($plan->consejos_adicionales)
                            <div class="bg-white rounded-4 p-3 border">
                                <p class="text-secondary small mb-0" style="line-height: 1.75;">{{ $plan->consejos_adicionales }}</p>
                            </div>
                        @else
                            <div class="bg-light rounded-4 p-4 text-center text-muted">
                                <i class="bi bi-info-circle-fill fs-2 mb-3 text-secondary"></i>
                                <p class="mb-0">No hay recomendaciones adicionales registradas.</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">Creado</span>
                            <strong class="text-dark small">{{ $plan->created_at->format('d/m/Y') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-secondary small">Última actualización</span>
                            <strong class="text-dark small">{{ $plan->updated_at->format('d/m/Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
