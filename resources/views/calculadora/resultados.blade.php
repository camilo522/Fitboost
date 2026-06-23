@extends('layouts.app')

@section('title', 'Tu Plan Nutricional Calculado | FitBoost')

@section('content')

<style>
    /* Cabecera estilo Cristal */
    .glass-header-results {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal con efecto Cristal */
    .glass-card-results {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Tarjetas de Macronutrientes Individuales */
    .macro-badge-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        transition: all 0.25s ease;
    }
    .macro-badge-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }

    /* Botones estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.5rem;
        font-weight: 700;
        font-size: 0.88rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
    .btn-results-save {
        background: linear-gradient(90deg, #28a745, #20c997);
        border: none;
    }
    .btn-results-save:hover {
        background: linear-gradient(90deg, #218838, #1aa17a);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    .btn-results-home {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-results-home:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }
</style>

<div class="container-fluid py-4" style="max-width: 1100px;">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-results rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                <i class="bi bi-check2-circle me-2"></i>Tu Plan Nutricional Personalizado
            </h2>
            <p class="text-muted mb-0 small">
                Análisis estructurado y distribución ideal de macronutrientes calculados con base en el perfil metabólico del usuario.
            </p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tarjeta de Resumen de Datos --}}
        <div class="col-lg-5">
            <div class="card glass-card-results border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4" style="font-size: 1.05rem;">
                        <i class="bi bi-person-bounding-box text-secondary me-2"></i>Basado en tus datos
                    </h5>
                    
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Usuario:</span>
                            <strong class="text-dark small">{{ $resultados['usuario_nombre'] }}</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Género:</span>
                            <strong class="text-dark small">{{ ucfirst($resultados['datos']['genero']) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Edad:</span>
                            <strong class="text-dark small">{{ $resultados['datos']['edad'] }} años</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Peso Corporal:</span>
                            <strong class="text-dark small">{{ $resultados['datos']['peso'] }} kg</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Altura:</span>
                            <strong class="text-dark small">{{ $resultados['datos']['altura'] }} cm</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Nivel de Actividad:</span>
                            <strong class="text-dark small text-end">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $resultados['datos']['nivel_actividad'])) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between p-2 rounded-3 bg-white border border-light-subtle">
                            <span class="text-secondary small fw-medium">Objetivo:</span>
                            <strong class="text-success small">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $resultados['datos']['objetivo'])) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Resultados de Macronutrientes --}}
        <div class="col-lg-7">
            <div class="card glass-card-results border-0 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-4" style="font-size: 1.05rem;">
                            <i class="bi bi-pie-chart-fill text-success me-2"></i>Tus Macronutrientes Diarios
                        </h5>
                        
                        <div class="row g-3 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 macro-badge-card border-primary-subtle">
                                    <h4 class="text-primary fw-extrabold mb-1 fs-3">{{ $resultados['calorias'] }}</h4>
                                    <p class="mb-0 text-muted fw-bold" style="font-size: 0.75rem; uppercase;">Kcal</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 macro-badge-card border-danger-subtle">
                                    <h4 class="text-danger fw-extrabold mb-1 fs-3">{{ $resultados['proteinas'] }}g</h4>
                                    <p class="mb-0 text-muted fw-bold" style="font-size: 0.75rem; uppercase;">Proteínas</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 macro-badge-card border-warning-subtle">
                                    <h4 class="text-warning fw-extrabold mb-1 fs-3">{{ $resultados['carbohidratos'] }}g</h4>
                                    <p class="mb-0 text-muted fw-bold" style="font-size: 0.75rem; uppercase;">Carbos</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-3 macro-badge-card border-info-subtle">
                                    <h4 class="text-info fw-extrabold mb-1 fs-3">{{ $resultados['grasas'] }}g</h4>
                                    <p class="mb-0 text-muted fw-bold" style="font-size: 0.75rem; uppercase;">Grasas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario para Guardar el Plan --}}
                    <div class="pt-4 border-top mt-4">
                        <form action="{{ route('planes-nutricionales.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="calorias_diarias" value="{{ $resultados['calorias'] }}">
                            <input type="hidden" name="proteinas_gramos" value="{{ $resultados['proteinas'] }}">
                            <input type="hidden" name="carbohidratos_gramos" value="{{ $resultados['carbohidratos'] }}">
                            <input type="hidden" name="grasas_gramos" value="{{ $resultados['grasas'] }}">
                            <input type="hidden" name="id_usuario" value="{{ $resultados['datos']['id_usuario'] }}">

                            <button type="submit" class="btn text-white btn-panel-pill btn-results-save w-100 shadow-sm">
                               <i class="bi bi-cloud-arrow-up-fill me-2"></i> Guardar como Plan Nutricional
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GUÍA DE ALIMENTOS AMPLIADA --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card glass-card-results border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">
                        <i class="bi bi-egg-fried text-info me-2"></i>Guía de Alimentos Sugeridos
                    </h5>
                    <p class="text-muted small mb-4">
                        Combina estratégicamente estas fuentes de alta calidad biológica para completar los objetivos del plan diario.
                    </p>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded-4 border h-100">
                                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-shield-check me-2"></i>Proteínas</h6>
                                <ul class="list-unstyled d-flex flex-column gap-2 small text-secondary">
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Pechuga de pollo o pavo</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Pescados (salmón, atún, merluza)</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Mariscos y crustáceos</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Huevos enteros y claras</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Cortes magros de res y cerdo</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Tofu, tempeh y edamames</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Yogur griego natural o Skyr</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Queso cottage bajo en grasa</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded-4 border h-100">
                                <h6 class="fw-bold text-warning mb-3"><i class="bi bi-lightning-charge me-2"></i>Carbohidratos</h6>
                                <ul class="list-unstyled d-flex flex-column gap-2 small text-secondary">
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Avena integral en hojuelas</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Arroz integral o basmati</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Quinoa y amaranto</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Patata dulce o boniato</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Pan de centeno o masa madre</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Frutas frescas de temporada</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Verduras fibrosas (brócoli, espinaca)</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Legumbres (lentejas, garbanzos)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded-4 border h-100">
                                <h6 class="fw-bold text-info mb-3"><i class="bi bi-heart-pulse me-2"></i>Grasas Saludables</h6>
                                <ul class="list-unstyled d-flex flex-column gap-2 small text-secondary">
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Aguacate fresco (palta)</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Frutos secos (nueces, almendras)</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Semillas de chía y lino</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Aceite de oliva virgen extra</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Pescado azul y sardinas</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Chocolate negro (>85% cacao)</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Aceitunas enteras</li>
                                    <li><i class="bi bi-dot text-success fs-5 align-middle"></i> Cremas naturales de frutos secos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BOTONES INFERIORES DE DIRECCIONAMIENTO --}}
    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('calculadora.index') }}" 
           class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
           <i class="bi bi-arrow-clockwise me-2"></i> Recalcular
        </a>
        <a href="{{ route('planes-nutricionales.index') }}"
           class="btn text-white btn-panel-pill btn-results-home shadow-sm">
           <i class="bi bi-house me-2"></i> Volver al Inicio
        </a>
    </div>
</div>

@endsection