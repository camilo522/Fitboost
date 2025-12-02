@extends('layouts.app')

@section('title', 'Perfil de ' . $usuario->nombre)

@section('content')
<div class="container mt-4">

    <div class="card shadow border-0">
        <div class="card-body">

            {{-- ============================ --}}
            {{-- NOMBRE DEL USUARIO           --}}
            {{-- ============================ --}}
            <h2 class="fw-bold text-primary">{{ $usuario->nombre }}</h2>
            <p class="text-muted">{{ $usuario->email }}</p>

            <hr>

            {{-- ====================================== --}}
            {{-- SECCIÓN SUPERIOR: VALORACIÓN + PLAN     --}}
            {{-- ====================================== --}}
            <div class="row g-4">

                {{-- ============================ --}}
                {{-- ÚLTIMA VALORACIÓN            --}}
                {{-- ============================ --}}
                <div class="col-md-6">
                    <h4 class="fw-bold">Última valoración</h4>

                    @if($ultimaValoracion)
                        <p class="mb-1"><strong>Peso:</strong> {{ $ultimaValoracion->peso }} kg</p>
                        <p class="mb-1"><strong>Altura:</strong> {{ $ultimaValoracion->altura }} cm</p>
                        <p class="mb-1"><strong>IMC:</strong> {{ $ultimaValoracion->imc }}</p>
                        <p class="mb-3"><strong>Fecha:</strong> {{ $ultimaValoracion->created_at->format('d/m/Y') }}</p>

                        <a href="{{ route('valoraciones.historial', $ultimaValoracion->id) }}"
                           class="btn btn-outline-primary rounded-pill fw-bold">
                            <i class="bi bi-clock-history"></i> Ver historial completo
                        </a>
                    @else
                        <p class="text-muted">No hay valoraciones registradas.</p>

                        <a href="{{ route('valoraciones.create', $usuario->id) }}" 
                           class="btn btn-outline-primary rounded-pill fw-bold">
                            <i class="bi bi-plus-circle"></i> Crear primera valoración
                        </a>
                    @endif
                </div>


                {{-- ============================ --}}
                {{-- PLAN NUTRICIONAL ACTIVO      --}}
                {{-- ============================ --}}
                <div class="col-md-6">
                    <h4 class="fw-bold">Plan Nutricional</h4>

                    @if($planNutricional)
                        <p class="mb-1"><strong>Calorías diarias:</strong> {{ $planNutricional->calorias_diarias }} kcal</p>
                        <p class="mb-1"><strong>Proteínas:</strong> {{ $planNutricional->proteinas_gramos }} g</p>
                        <p class="mb-1"><strong>Carbohidratos:</strong> {{ $planNutricional->carbohidratos_gramos }} g</p>
                        <p class="mb-1"><strong>Grasas:</strong> {{ $planNutricional->grasas_gramos }} g</p>
                    @else
                        <p class="text-muted">No hay plan nutricional asignado.</p>
                    @endif

                    <a href="{{ route('planes-nutricionales.index') }}" 
                       class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                        <i class="bi bi-plus-circle"></i> Gestionar Plan
                    </a>
                </div>

            </div>

            <hr>

            {{-- ============================ --}}
            {{-- TARJETAS DE OPCIONES         --}}
            {{-- ============================ --}}
            <div class="row g-4 mt-3">

                {{-- VALORACIONES --}}
                <div class="col-md-6">
                    <div class="card shadow rounded-4 p-4">
                        <h5 class="fw-bold">Valoraciones</h5>
                        <a href="{{ route('valoraciones.index') }}" 
                           class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                            <i class="bi bi-clock-history"></i> Ver valoraciones
                        </a>
                    </div>
                </div>

                {{-- RUTINAS --}}
                <div class="col-md-6">
                    <div class="card shadow rounded-4 p-4">
                        <h5 class="fw-bold">Rutina asignada</h5>

                        <a href="{{ route('rutinas.index') }}" 
                           class="btn btn-outline-primary rounded-pill mt-2 fw-bold">
                            <i class="bi bi-plus-circle"></i> Asignar rutina
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
