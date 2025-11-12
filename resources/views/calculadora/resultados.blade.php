@extends('layouts.app')

@section('title', 'Tu Plan Nutricional Calculado')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Tu Plan Nutricional Personalizado</h2>
    </div>

    <div class="row">
        <!-- Tarjeta de Resumen de Datos -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Basado en tus datos</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Género:</span>
                            <strong>{{ ucfirst($resultados['datos']['genero']) }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Edad:</span>
                            <strong>{{ $resultados['datos']['edad'] }} años</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Peso:</span>
                            <strong>{{ $resultados['datos']['peso'] }} kg</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Altura:</span>
                            <strong>{{ $resultados['datos']['altura'] }} cm</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Actividad:</span>
                            <strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $resultados['datos']['nivel_actividad'])) }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Objetivo:</span>
                            <strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $resultados['datos']['objetivo'])) }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                        <span>Usuario:</span>
                        <strong>{{ $resultados['usuario_nombre'] }}</strong>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- Tarjeta de Resultados de Macronutrientes -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow-lg border-0 rounded-4 h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tus Macronutrientes Diarios</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 col-md-3 mb-3">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="text-primary fw-bold">{{ $resultados['calorias'] }}</h4>
                                <p class="mb-0 small text-muted">Calorías</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="text-danger fw-bold">{{ $resultados['proteinas'] }}g</h4>
                                <p class="mb-0 small text-muted">Proteínas</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="text-warning fw-bold">{{ $resultados['carbohidratos'] }}g</h4>
                                <p class="mb-0 small text-muted">Carbohidratos</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="p-3 border rounded-3 bg-light">
                                <h4 class="text-info fw-bold">{{ $resultados['grasas'] }}g</h4>
                                <p class="mb-0 small text-muted">Grasas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario para Guardar el Plan -->
                    <hr>
                    <form action="{{ route('planes-nutricionales.store') }}" method="POST">
                        @csrf
                        
                        <!-- Enviamos los datos calculados como campos ocultos -->
                        <input type="hidden" name="calorias_diarias" value="{{ $resultados['calorias'] }}">
                        <input type="hidden" name="proteinas_gramos" value="{{ $resultados['proteinas'] }}">
                        <input type="hidden" name="carbohidratos_gramos" value="{{ $resultados['carbohidratos'] }}">
                        <input type="hidden" name="grasas_gramos" value="{{ $resultados['grasas'] }}">

                        <!-- IMPORTANTE: Por ahora, asignamos el plan a un usuario fijo (ID=1) -->
                        <!-- Cuando tengas un sistema de login, esto será dinámico -->
                        <input type="hidden" name="id_usuario" value="{{ $resultados['datos']['id_usuario'] }}">

                        <button type="submit" class="btn text-white fw-bold rounded-pill px-4 shadow-sm w-100 mt-3" 
                                style="background: linear-gradient(90deg, #28a745, #20c997);">
                           <i class="bi bi-save me-2"></i> Guardar como Plan Nutricional
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="mt-4">
        <a href="{{ route('calculadora.index') }}" 
           class="btn btn-secondary rounded-pill px-4 shadow-sm me-2">
           <i class="bi bi-arrow-clockwise me-2"></i> Recalcular
        </a>
        <a href="{{ route(planes-nutricionales.index) }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-house me-2"></i> Volver 
        </a>
    </div>

    <!-- NUEVA SECCIÓN: GUÍA DE ALIMENTOS AMPLIADA -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-egg-fried me-2"></i>Guía de Alimentos para tu Plan</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Aquí tienes una lista completa de alimentos saludables que puedes combinar para alcanzar tus objetivos diarios. ¡Usa tu creatividad en la cocina!</p>

                <div class="row">
                    <!-- Columna de Proteínas -->
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold text-info">Fuentes de Proteína</h6>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pechuga de pollo o pavo</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pescados (salmón, atún, merluza, bacalao)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Mariscos (camarones, langostinos)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Huevos (enteros y claras)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Cortes magros de res (lomo, solomillo)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Cerdo magro (lomo, filete)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Tofu, tempeh y edamames</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Legumbres (lentejas, garbanzos, judías)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Yogur griego natural y skyr</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Quesos bajos en grasa (cottage, fresco)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Proteína en polvo (suero, caseína, vegetal)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Jamón serrano o york bajo en grasa</li>
                        </ul>
                    </div>

                    <!-- Columna de Carbohidratos -->
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold text-info">Fuentes de Carbohidratos</h6>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Avena (copos y salvado)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Arroz (integral, basmati, salvaje)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Quinoa y amaranto</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Patata y boniato (batata)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pasta y fideos integrales</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pan (integral, de centeno, de espelta)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Frutas (todas, especialmente plátano, manzana, bayas)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Verduras y hortalizas (todas, especialmente brócoli, espinacas)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Legumbres (guisantes, maíz, habas)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Cebada, centeno y mijo</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Calabaza, calabacín y remolacha</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Harina de avena o de almendras</li>
                        </ul>
                    </div>

                    <!-- Columna de Grasas Saludables -->
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold text-info">Fuentes de Grasas Saludables</h6>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Aguacate (palta)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Frutos secos (nueces, almendras, anacardos)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Frutos secos (pistachos, avellanas, macadamias)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Semillas (chía, lino, girasol, calabaza)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Aceite de oliva virgen extra</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Aceite de coco (y manteca de coco)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Pescado azul (sardinas, caballa, boquerones)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Chocolate negro (>85% cacao)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Aceitunas</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Mantequillas de frutos secos (maní, almendras)</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Yema de huevo</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Tofu y tempeh (tienen grasa)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN DE LA NUEVA SECCIÓN AMPLIADA -->
</div>
@endsection