@extends('layouts.app')

@section('title', 'Editar Rutina | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para Formularios --}}
<style>
    /* Tarjeta principal del formulario estilo Cristal */
    .glass-card-form {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.06);
    }

    /* Estilización de Inputs, Selects y Textareas */
    .glass-input {
        background: rgba(255, 255, 255, 0.8) !important;
        border: 1px solid rgba(203, 213, 225, 0.8) !important;
        color: #334155 !important;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    .glass-input:focus {
        background: #ffffff !important;
        border-color: #03c937 !important;
        box-shadow: 0 0 0 3px rgba(3, 201, 55, 0.15) !important;
    }

    /* Botones de acción estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.6rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }

    .btn-update-routine {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-update-routine:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }

    /* Iconos dentro de las etiquetas */
    .form-label i {
        color: #64748b;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            
            <div class="card glass-card-form border-0">
                <div class="card-body p-4 p-sm-5">
                    
                    {{-- Encabezado del Formulario --}}
                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 d-inline-block p-3 rounded-circle text-success mb-2">
                            <i class="bi bi-pencil-square fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Modificar Rutina</h3>
                        <p class="text-muted small">Actualice los parámetros temporales o el entrenamiento asignado para la rutina #{{ $rutinas->id }}.</p>
                    </div>

                    {{-- Enrutamiento directo mediante POST sin método PUT --}}
                    <form action="{{ route('rutinas.update', $rutinas->id) }}" method="POST">
                        @csrf

                        {{-- Nombre de la Rutina --}}
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold small text-secondary">
                                <i class="bi bi-type me-1"></i> Nombre de la Rutina
                            </label>
                            <input type="text" name="nombre" id="nombre" 
                                   value="{{ old('nombre', $rutinas->nombre) }}"
                                   class="form-control glass-input rounded-pill px-3 py-2 shadow-sm @error('nombre') is-invalid @enderror" 
                                   placeholder="Escribe el nombre de la rutina">
                            @error('nombre')
                                <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Horario asignado --}}
                        <div class="mb-3">
                            <label for="horario" class="form-label fw-bold small text-secondary">
                                <i class="bi bi-clock me-1"></i> Horario de Ejecución
                            </label>
                            <input type="time" name="horario" id="horario" 
                                   value="{{ old('horario', $rutinas->horario) }}"
                                   class="form-control glass-input rounded-pill px-3 py-2 shadow-sm @error('horario') is-invalid @enderror">
                            @error('horario')
                                <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción detallada --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold small text-secondary">
                                <i class="bi bi-blockquote-left me-1"></i> Descripción u Observaciones
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="3" 
                                      class="form-control glass-input rounded-4 px-3 py-2 shadow-sm @error('descripcion') is-invalid @enderror"
                                      placeholder="Escribe una descripción...">{{ old('descripcion', $rutinas->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Selección de Entrenamiento --}}
                        <div class="mb-4">
                            <label for="idEntrenamiento" class="form-label fw-bold small text-secondary">
                                <i class="bi bi-lightning-charge me-1"></i> Entrenamiento Vinculado
                            </label>
                            <select name="idEntrenamiento" id="idEntrenamiento" 
                                    class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('idEntrenamiento') is-invalid @enderror">
                                <option value="">-- Selecciona un entrenamiento --</option>
                                @foreach($entrenamientos as $entrenamiento)
                                    <option value="{{ $entrenamiento->id }}" 
                                        {{ old('idEntrenamiento', $rutinas->idEntrenamiento) == $entrenamiento->id ? 'selected' : '' }}>
                                        {{ $entrenamiento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idEntrenamiento')
                                <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botonera inferior --}}
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-2">
                            <a href="{{ route('rutinas.index') }}" 
                               class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                                <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                            </a>
                            <button type="submit" 
                                    class="btn text-white btn-panel-pill btn-update-routine shadow-sm">
                                <i class="bi bi-arrow-repeat me-2"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>

@endsection