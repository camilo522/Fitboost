@extends('layouts.app')

@section('title', 'Calculadora de Macronutrientes | FitBoost')

@section('content')

<style>
    /* Cabecera estilo Cristal */
    .glass-header-calc {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal con efecto Cristal */
    .glass-card-calc {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Inputs, Selects y Contenedores de Radio botones */
    .form-control-custom {
        border-radius: 12px !important;
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 0.65rem 1rem;
        background-color: #ffffff;
        color: #334155;
        font-size: 0.92rem;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        border-color: #11cb64;
        box-shadow: 0 0 0 3px rgba(17, 203, 100, 0.15);
        background-color: #ffffff;
    }
    
    /* Variación cuando el input es inválido */
    .form-control-custom.is-invalid {
        border-color: #ef4444 !important;
        background-image: none;
    }
    .form-control-custom.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
    }

    /* Contenedores personalizados para opciones de radio */
    .radio-card-group {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 14px;
        padding: 0.75rem 1.2rem;
    }

    /* Botones estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
    .btn-calc-action {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-calc-action:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }
</style>

<div class="container-fluid py-4" style="max-width: 900px;">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-calc rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div>
                <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                    <i class="bi bi-calculator me-2"></i>Calculadora de Macronutrientes
                </h2>
                <p class="text-muted mb-0 small">
                    Introduce los datos corporales correspondientes para estructurar el plan ideal del usuario de manera automatizada.
                </p>
            </div>
        </div>
    </div>

    {{-- TARJETA DEL FORMULARIO --}}
    <div class="card glass-card-calc border-0 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 1.15rem;">
                <i class="bi bi-gear-fill me-2 text-secondary"></i>Calcula tu Plan Ideal
            </h4>

            @php
                $selectedUserId = old('id_usuario', $selectedUsuario->id ?? '');
                $prefillPeso = old('peso', $lastValoracion->peso ?? '');
                $prefillAltura = old('altura', $lastValoracion->altura ?? '');
            @endphp

            <form action="{{ route('calculadora.calcular') }}" method="POST">
                @csrf

                <div class="row g-4">
                    {{-- Asignar a Usuario --}}
                    <div class="col-12">
                        <label for="id_usuario" class="form-label fw-bold text-dark small">Asignar a Usuario</label>
                        <select class="form-select form-control-custom" id="id_usuario" name="id_usuario" required>
                            <option value="" disabled {{ $selectedUserId ? '' : 'selected' }}>Selecciona un usuario...</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $selectedUserId == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($selectedUsuario && $lastValoracion)
                        <div class="col-12">
                            <div class="alert alert-success rounded-4 py-3 px-4">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Valores cargados desde la última valoración de <strong>{{ $selectedUsuario->nombre }}</strong>: 
                                <strong>{{ $lastValoracion->peso }} kg</strong> y <strong>{{ $lastValoracion->altura }} cm</strong>.
                            </div>
                        </div>
                    @elseif($selectedUsuario)
                        <div class="col-12">
                            <div class="alert alert-warning rounded-4 py-3 px-4">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>{{ $selectedUsuario->nombre }}</strong> no tiene una valoración registrada para completar peso y altura automáticamente.
                                Ingresa esos valores antes de calcular.
                            </div>
                        </div>
                    @endif

                    {{-- Género --}}
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark small">Género</label>
                        <div class="radio-card-group d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre" {{ old('genero', 'hombre') == 'hombre' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-semibold small" for="hombre">
                                    <i class="bi bi-gender-male me-1 text-primary"></i> Hombre
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer" {{ old('genero') == 'mujer' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-semibold small" for="mujer">
                                    <i class="bi bi-gender-female me-1 text-danger"></i> Mujer
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Edad --}}
                    <div class="col-md-4">
                        <label for="edad" class="form-label fw-bold text-dark small">Edad (años)</label>
                        <input type="number" class="form-control form-control-custom @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad') }}" placeholder="Ej: 25">
                        @error('edad')
                            <div class="text-danger mt-1 small fw-semibold"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Peso --}}
                    <div class="col-md-4">
                        <label for="peso" class="form-label fw-bold text-dark small">Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control form-control-custom @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso', $prefillPeso) }}" placeholder="Ej: 70.5">
                        @error('peso')
                            <div class="text-danger mt-1 small fw-semibold"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Altura --}}
                    <div class="col-md-4">
                        <label for="altura" class="form-label fw-bold text-dark small">Altura (cm)</label>
                        <input type="number" class="form-control form-control-custom @error('altura') is-invalid @enderror" id="altura" name="altura" value="{{ old('altura', $prefillAltura) }}" placeholder="Ej: 175">
                        @error('altura')
                            <div class="text-danger mt-1 small fw-semibold"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nivel de Actividad --}}
                    <div class="col-12">
                        <label for="nivel_actividad" class="form-label fw-bold text-dark small">Nivel de Actividad</label>
                        <select class="form-select form-control-custom" id="nivel_actividad" name="nivel_actividad">
                            <option value="sedentario" {{ old('nivel_actividad') == 'sedentario' ? 'selected' : '' }}>Sedentario (poco o ningún ejercicio)</option>
                            <option value="ligero" {{ old('nivel_actividad') == 'ligero' ? 'selected' : '' }}>Ligeramente activo (ejercicio ligero 1-3 días/semana)</option>
                            <option value="moderado" {{ old('nivel_actividad', 'moderado') == 'moderado' ? 'selected' : '' }}>Moderadamente activo (ejercicio moderado 3-5 días/semana)</option>
                            <option value="muy_activo" {{ old('nivel_actividad') == 'muy_activo' ? 'selected' : '' }}>Muy activo (ejercicio intenso 6-7 días/semana)</option>
                            <option value="extremadamente_activo" {{ old('nivel_actividad') == 'extremadamente_activo' ? 'selected' : '' }}>Extremadamente activo (atleta de élite)</option>
                        </select>
                    </div>

                    {{-- Objetivo --}}
                    <div class="col-12">
                        <label class="form-label fw-bold text-dark small">Objetivo Estratégico</label>
                        <div class="radio-card-group d-flex flex-wrap gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="objetivo" id="perdida_grasa" value="perdida_grasa" {{ old('objetivo', 'perdida_grasa') == 'perdida_grasa' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-semibold small" for="perdida_grasa">
                                    <i class="bi bi-arrow-down-circle me-1 text-success"></i> Pérdida de Grasa
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="objetivo" id="mantenimiento" value="mantenimiento" {{ old('objetivo') == 'mantenimiento' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-semibold small" for="mantenimiento">
                                    <i class="bi bi-dash-circle me-1 text-warning"></i> Mantenimiento
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="objetivo" id="ganancia_musculo" value="ganancia_musculo" {{ old('objetivo') == 'ganancia_musculo' ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary fw-semibold small" for="ganancia_musculo">
                                    <i class="bi bi-arrow-up-circle me-1 text-primary"></i> Ganancia de Músculo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTÓN SUBMIT --}}
                <div class="mt-5">
                    <button type="submit" class="btn text-white btn-panel-pill btn-calc-action w-100 shadow-sm">
                        <i class="bi bi-calculator me-2"></i> Calcular Mis Macros
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ENLACE VOLVER --}}
    <div>
        <a href="{{ route('planes-nutricionales.index') }}"
           class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
           <i class="bi bi-arrow-left-circle me-2"></i> Volver al Listado
        </a>
    </div>
</div>

@endsection