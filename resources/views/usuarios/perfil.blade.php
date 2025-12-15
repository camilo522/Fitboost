@extends('layouts.app')

@section('title', 'Perfil de ' . $usuario->nombre)

@section('content')

    {{-- ========================================= --}}
    {{-- ESTILOS PREMIUM DIRECTAMENTE EN EL INDEX --}}
    {{-- ========================================= --}}
    <style>
        /* ---------- TARJETAS ---------- */
        .card-custom {
            border-radius: 18px;
            border: none;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.25s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        /* ---------- TITULOS ---------- */
        .section-title {
            font-weight: 800;
            font-size: 1.1rem;
            color: #222;
            border-left: 4px solid #1f8f3a;
            padding-left: 8px;
            margin-bottom: 12px;
        }

        /* ---------- IMC BAR ---------- */
        .imc-bar-container {
            width: 100%;
            height: 10px;
            border-radius: 10px;
            background: #efe9e9;
            overflow: hidden;
            margin: 8px 0 12px 0;
        }

        .imc-bar-fill {
            height: 100%;
            background: #1f8f3a;
            transition: width 0.6s;
        }

        /* ---------- BADGES ---------- */
        .badge-imc {
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-normal {
            background: #d4edda;
            color: #1f8f3a;
        }

        .badge-sobre {
            background: #fff3cd;
            color: #b88600;
        }

        .badge-obeso {
            background: #f8d7da;
            color: #b50000;
        }

        .badge-bajo {
            background: #dbf0ff;
            color: #005d8f;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: bold;
            font-size: .85rem;
        }

        /* ---------- BOTONES ---------- */
        .btn-pill {
            border-radius: 30px;
            padding: 8px 22px;
            font-weight: 600 !important;
            transition: 0.25s ease;
        }

        .btn-pill:hover {
            transform: translateY(-2px);
        }

        /* ---------- MINI GRAFICA ---------- */
        .mini-chart {
            width: 100%;
            height: 70px;
        }

        hr {
            opacity: 0.2;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>



    <div class="container mt-4">

        <div class="card card-custom">
            <div class="card-body">

                <div class="row align-items-center mb-4">

                    {{-- COLUMNA IZQUIERDA --}}
                    <div class="col-md-6">
                        <h2 class="fw-bold text-success">{{ $usuario->nombre }}</h2>
                        <p class="mb-1">{{ $usuario->email }}</p>

                        <span class="badge bg-success-subtle text-success">
                            ● Activo
                        </span>
                    </div>

                    {{-- COLUMNA DERECHA (TUS 3 BLOQUES) --}}
                    <div class="col-md-6">
                        <div class="row text-center">

                            <div class="col">
                                <h5 class="fw-bold">{{ $usuario->valoraciones->count() }}</h5>
                                <p class="text-muted">Valoraciones</p>
                            </div>

                            <div class="col">
                                <h5 class="fw-bold">{{ $ultimaValoracion ? $ultimaValoracion->imc : '—' }}</h5>
                                <p class="text-muted">IMC actual</p>
                            </div>

                            <div class="col">
                                <h5 class="fw-bold">{{ $planNutricional ? 'Activo' : 'Sin plan' }}</h5>
                                <p class="text-muted">Plan nutricional</p>
                            </div>

                        </div>

                        @if ($ultimaValoracion)
                            <a href="{{ route('valoraciones.historial', $ultimaValoracion->id) }}"
                                class="btn btn-outline-dark btn-pill mt-2">
                                <i class="bi bi-clock-history"></i> Ver historial
                            </a>
                        @else
                            <p class="text-muted mt-2">Aún no hay valoraciones registradas.</p>
                        @endif

                    </div>

                </div>



                <hr>

                <div class="row g-4">

                    {{-- ========================================= --}}
                    {{-- ÚLTIMA VALORACIÓN                        --}}
                    {{-- ========================================= --}}
                    <div class="col-md-6">
                        <h4 class="section-title">Última valoración</h4>

                        @if ($ultimaValoracion)
                            @php
                                $imc = $ultimaValoracion->imc;

                                if ($imc < 18.5) {
                                    $clasificacion = 'Bajo peso';
                                    $badge = 'badge-bajo';
                                } elseif ($imc < 25) {
                                    $clasificacion = 'Normal';
                                    $badge = 'badge-normal';
                                } elseif ($imc < 30) {
                                    $clasificacion = 'Sobrepeso';
                                    $badge = 'badge-sobre';
                                } else {
                                    $clasificacion = 'Obesidad';
                                    $badge = 'badge-obeso';
                                }

                                $porcentajeIMC = min(($imc / 30) * 100, 100);

                                // Mini gráfica SVG sin JS
                                $imcHistorico = $usuario->valoraciones->pluck('imc')->take(-6);
                            @endphp

                            <p><strong>Peso:</strong> {{ $ultimaValoracion->peso }} kg</p>
                            <p><strong>Altura:</strong> {{ $ultimaValoracion->altura }} cm</p>
                            <p><strong>Fecha:</strong> {{ $ultimaValoracion->created_at->format('d/m/Y') }}</p>

                            <p>
                                <strong>IMC:</strong> {{ $imc }}
                                <span class="badge-imc {{ $badge }}">{{ $clasificacion }}</span>
                            </p>

                            {{-- Barra de progreso --}}
                            <div class="imc-bar-container">
                                <div class="imc-bar-fill" style="width: {{ $porcentajeIMC }}%;"></div>
                            </div>

                            {{-- MINI GRAFICA IMC (SVG SIN JS) --}}
                            <svg class="mini-chart">
                                <polyline fill="none" stroke="black" stroke-width="2"
                                    points="
                                    @foreach ($imcHistorico as $index => $valor)
                                        {{ $index * 40 }},{{ 70 - $valor * 2 }} @endforeach
                                " />
                            </svg>
                        @else
                            <p class="text-muted">No hay valoraciones registradas.</p>
                            <a href="{{ route('valoraciones.create', $usuario->id) }}"
                                class="btn btn-outline-success btn-pill">
                                <i class="bi bi-plus-circle"></i> Crear primera valoración
                            </a>
                        @endif

                    </div>



                    {{-- ========================================= --}}
                    {{-- PLAN NUTRICIONAL                          --}}
                    {{-- ========================================= --}}
                    <div class="col-md-6">
                        <h4 class="section-title">Plan Nutricional</h4>

                        @if ($planNutricional)
                            <p><strong>Calorías diarias:</strong> {{ $planNutricional->calorias_diarias }} kcal</p>
                            <p><strong>Proteínas:</strong> {{ $planNutricional->proteinas_gramos }} g</p>
                            <p><strong>Carbohidratos:</strong> {{ $planNutricional->carbohidratos_gramos }} g</p>
                            <p><strong>Grasas:</strong> {{ $planNutricional->grasas_gramos }} g</p>
                        @else
                            <p class="text-muted">No hay plan nutricional asignado.</p>
                        @endif

                        {{-- Adherencia visual --}}
                        <p class="fw-bold mt-3">Adherencia semanal:</p>
                        <div class="imc-bar-container">
                            <div class="imc-bar-fill" style="width: 72%;"></div>
                        </div>
                        <small class="text-muted">72% esta semana</small>

                        <a href="{{ route('planes-nutricionales.index') }}" class="btn btn-outline-success btn-pill mt-3">
                            <i class="bi bi-plus-circle"></i> Gestionar Plan
                        </a>
                    </div>

                </div>

                <hr>

                {{-- ========================================= --}}
                {{-- TARJETAS DE OPCIONES EXTRA               --}}
                {{-- ========================================= --}}
                <div class="row g-4 mt-3">

                    <div class="col-md-6">
                        <div class="card card-custom p-4">
                            <h5 class="fw-bold">Valoraciones</h5>
                            <a href="{{ route('valoraciones.index') }}" class="btn btn-outline-dark btn-pill mt-2">
                                <i class="bi bi-activity"></i> Ver valoraciones
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-custom p-4">
                            <h5 class="fw-bold">Rutina asignada</h5>

                            @if ($usuario->rutina)
                                <p><strong>Nombre:</strong> {{ $usuario->rutina->nombre }}</p>
                                <p><strong>Descripción:</strong> {{ $usuario->rutina->descripcion }}</p>
                                <p><strong>Horario:</strong> {{ $usuario->rutina->horario }}</p>
                            @else
                                <p class="text-muted">Este usuario no tiene rutina asignada.</p>
                            @endif

                            <a href="{{ route('rutinas.index') }}" class="btn btn-outline-success btn-pill mt-2">
                                <i class="bi bi-plus-circle"></i> Asignar o cambiar rutina
                            </a>
                        </div>
                    </div>







                </div>

                <div class="mt-4">
                    <a href="{{ route('usuario.index') }}" class="btn btn-dark btn-pill px-4">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('usuario.exportar', $usuario->id) }}" class="btn btn-outline-dark btn-pill mt-2">
                        <i class="bi bi-download"></i> Exportar Perfil (PDF)
                    </a>


                </div>

            </div>
        </div>

    </div>
@endsection
