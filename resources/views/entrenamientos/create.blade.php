@extends('layouts.app')

@section('title', 'Crear Entrenamiento | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para formularios --}}
<style>
    /* Cabecera de sección estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor del Formulario */
    .glass-card-form {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Icono estilizado a la izquierda en inputs y selects */
    .input-group-text-custom {
        background: rgba(241, 245, 249, 0.9) !important;
        border: 1px solid #d1d5db !important;
        border-radius: 14px 0 0 14px !important;
        color: #64748b;
        padding-left: 1.1rem;
        padding-right: 1.1rem;
    }

    /* Ajuste para inputs y selects estandarizados con icono */
    .input-custom-with-icon {
        border-radius: 0 14px 14px 0 !important;
    }

    /* Botón píldora personalizado */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.6rem;
        font-weight: 700;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-2">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-activity me-2"></i>Crear Entrenamiento
                    </h2>
                    <p class="text-muted mb-0 small">
                        Estructura un nuevo plan de acondicionamiento físico o rutina guiada
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERTA DE ÉXITO ESTÁNDAR --}}
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 p-3 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span class="fw-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- FORMULARIO PRINCIPAL --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card glass-card-form border-0">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('entrenamientos.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            
                            {{-- NOMBRE --}}
                            <div class="col-12 col-md-6">
                                <label for="nombre" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-tag me-1"></i> Nombre del Entrenamiento
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <input type="text" 
                                           name="nombre" 
                                           id="nombre"
                                           class="form-control input-custom-with-icon @error('nombre') is-invalid @enderror"
                                           placeholder="Ej. Hipertrofia de Piernas"
                                           value="{{ old('nombre') }}" required>
                                </div>
                                @error('nombre')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- OBJETIVO --}}
                            <div class="col-12 col-md-6">
                                <label for="objetivo" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-trophy me-1"></i> Objetivo
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-target"></i>
                                    </span>
                                    <input type="text" 
                                           name="objetivo" 
                                           id="objetivo"
                                           class="form-control input-custom-with-icon @error('objetivo') is-invalid @enderror"
                                           placeholder="Ej. Quema de grasa / Ganancia muscular"
                                           value="{{ old('objetivo') }}" required>
                                </div>
                                @error('objetivo')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- DESCRIPCIÓN (CORREGIDA ESTRUCTURA TEXTAREA) --}}
                            <div class="col-12">
                                <label for="descripcion" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-justify-left me-1"></i> Descripción del Programa
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom" style="border-radius: 14px 0 0 14px !important;">
                                        <i class="bi bi-info-circle"></i>
                                    </span>
                                    <textarea name="descripcion" 
                                              id="descripcion"
                                              class="form-control input-custom-with-icon @error('descripcion') is-invalid @enderror" 
                                              rows="3" 
                                              placeholder="Describe detalladamente los grupos musculares involucrados o el enfoque del entrenamiento...">{{ old('descripcion') }}</textarea>
                                </div>
                                @error('descripcion')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- DURACIÓN --}}
                            <div class="col-12 col-md-4">
                                <label for="duracion" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-clock me-1"></i> Duración (minutos)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-hourglass-split"></i>
                                    </span>
                                    <input type="number" 
                                           name="duracion" 
                                           id="duracion"
                                           class="form-control input-custom-with-icon @error('duracion') is-invalid @enderror"
                                           placeholder="Ej. 60"
                                           value="{{ old('duracion') }}" required>
                                </div>
                                @error('duracion')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- NIVEL --}}
                            <div class="col-12 col-md-4">
                                <label for="nivel" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-bar-chart-steps me-1"></i> Nivel de Dificultad
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-lightning"></i>
                                    </span>
                                    <select name="nivel" id="nivel" class="form-select input-custom-with-icon">
                                        <option value="Principiante" {{ old('nivel') == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                                        <option value="Intermedio" {{ old('nivel') == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                                        <option value="Avanzado" {{ old('nivel') == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                                    </select>
                                </div>
                            </div>

                            {{-- DÍAS POR SEMANA --}}
                            <div class="col-12 col-md-4">
                                <label for="diasSemana" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-calendar-range me-1"></i> Frecuencia Semanal
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>
                                    <input type="number" 
                                           name="diasSemana" 
                                           id="diasSemana"
                                           class="form-control input-custom-with-icon @error('diasSemana') is-invalid @enderror"
                                           placeholder="Ej. 4"
                                           value="{{ old('diasSemana') }}" required>
                                </div>
                                @error('diasSemana')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- ESTADO --}}
                            <div class="col-12 col-md-6">
                                <label for="estado" class="form-label fw-bold text-secondary mb-2">
                                    <i class="bi bi-toggle-on me-1"></i> Estado Inicial
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-flag"></i>
                                    </span>
                                    <select name="estado" id="estado" class="form-select input-custom-with-icon">
                                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{-- BOTONES DE ACCIÓN --}}
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-light">
                            <a href="{{ route('entrenamientos.index') }}" 
                               class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                                <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-success btn-panel-pill shadow-sm text-white">
                                <i class="bi bi-check-circle me-2"></i> Guardar Entrenamiento
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection