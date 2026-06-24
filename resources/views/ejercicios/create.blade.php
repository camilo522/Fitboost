@extends('layouts.app')

@section('title', 'Crear Ejercicio | FitBoost')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-success">
        <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Ejercicio
    </h1>
@endsection

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para el Formulario de Ejercicios --}}
<style>
    /* Tarjeta principal estilo Cristal */
    .glass-card-form {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.06);
    }

    /* Estilización avanzada de los controles de formulario */
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

    /* Inputs tipo File (Subida de archivos) */
    .glass-input[type="file"]::-webkit-file-upload-button {
        background: #0f172a;
        color: white;
        border: none;
        border-radius: 30px;
        padding: 0.25rem 1rem;
        margin-right: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: background 0.2s;
    }
    .glass-input[type="file"]:hover::-webkit-file-upload-button {
        background: #1e293b;
    }

    /* Botonera de acción estilo píldora */
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

    .btn-save-exercise {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-save-exercise:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }

    /* Iconos secundarios de los labels */
    .form-label i {
        color: #64748b;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10">

            <div class="card glass-card-form border-0">
                <div class="card-body p-4 p-sm-5">

                    {{-- Bloque de Alertas Generales por errores de Validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-4 shadow-sm border-0 bg-danger bg-opacity-10 text-danger p-3 mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i>
                                <strong>¡Error de validación!</strong>
                            </div>
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Mensaje manual de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success rounded-4 shadow-sm border-0 bg-success bg-opacity-10 text-success p-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('ejercicios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- FILA 1: Nombre y Categoría -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-tag me-1"></i> Nombre del Ejercicio
                                </label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                       class="form-control glass-input rounded-pill px-3 py-2 shadow-sm @error('nombre') is-invalid @enderror"
                                       placeholder="Ej. Flexiones de pecho">
                                @error('nombre')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="categoria" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-grid me-1"></i> Categoría
                                </label>
                                <select name="categoria" id="categoria" 
                                        class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('categoria') is-invalid @enderror">
                                    <option value="">Seleccionar categoría</option>
                                    <option value="Calentamiento" {{ old('categoria') == 'Calentamiento' ? 'selected' : '' }}>Calentamiento</option>
                                    <option value="Fuerza" {{ old('categoria') == 'Fuerza' ? 'selected' : '' }}>Fuerza</option>
                                    <option value="Cardio" {{ old('categoria') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                                    <option value="Estiramiento" {{ old('categoria') == 'Estiramiento' ? 'selected' : '' }}>Estiramiento</option>
                                    <option value="Resistencia" {{ old('categoria') == 'Resistencia' ? 'selected' : '' }}>Resistencia</option>
                                </select>
                                @error('categoria')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- FILA 2: Descripción Completa -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold small text-secondary">
                                <i class="bi bi-justify-left me-1"></i> Descripción técnica de ejecución
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="3" 
                                      class="form-control glass-input rounded-4 px-3 py-2 shadow-sm @error('descripcion') is-invalid @enderror"
                                      placeholder="Describa brevemente la postura correcta y el rango de movimiento del ejercicio...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- FILA 3: Grupo muscular, Dificultad y Duración -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="grupoMuscular" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-person-arms-up me-1"></i> Grupo Muscular
                                </label>
                                <select name="grupoMuscular" id="grupoMuscular" 
                                        class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('grupoMuscular') is-invalid @enderror">
                                    <option value="">Seleccionar grupo</option>
                                    <option value="Pecho" {{ old('grupoMuscular') == 'Pecho' ? 'selected' : '' }}>Pecho</option>
                                    <option value="Espalda" {{ old('grupoMuscular') == 'Espalda' ? 'selected' : '' }}>Espalda</option>
                                    <option value="Hombros" {{ old('grupoMuscular') == 'Hombros' ? 'selected' : '' }}>Hombros</option>
                                    <option value="Brazos" {{ old('grupoMuscular') == 'Brazos' ? 'selected' : '' }}>Brazos</option>
                                    <option value="Abdomen" {{ old('grupoMuscular') == 'Abdomen' ? 'selected' : '' }}>Abdomen</option>
                                    <option value="Piernas" {{ old('grupoMuscular') == 'Piernas' ? 'selected' : '' }}>Piernas</option>
                                    <option value="Full Body" {{ old('grupoMuscular') == 'Full Body' ? 'selected' : '' }}>Cuerpo completo</option>
                                </select>
                                @error('grupoMuscular')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="dificultad" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-speedometer2 me-1"></i> Dificultad
                                </label>
                                <select name="dificultad" id="dificultad" 
                                        class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('dificultad') is-invalid @enderror">
                                    <option value="">Seleccionar nivel</option>
                                    <option value="Baja" {{ old('dificultad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="Media" {{ old('dificultad') == 'Media' ? 'selected' : '' }}>Media</option>
                                    <option value="Alta" {{ old('dificultad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                                @error('dificultad')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="duracionEstimada" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-hourglass-split me-1"></i> Duración (minutos)
                                </label>
                                <input type="number" name="duracionEstimada" id="duracionEstimada" value="{{ old('duracionEstimada') }}"
                                       class="form-control glass-input rounded-pill px-3 py-2 shadow-sm @error('duracionEstimada') is-invalid @enderror" min="1" placeholder="Ej. 5">
                                @error('duracionEstimada')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- FILA 4: Intensidad y Equipo necesario -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="intensidad" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-lightning-charge me-1"></i> Nivel de Intensidad
                                </label>
                                <select name="intensidad" id="intensidad" 
                                        class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('intensidad') is-invalid @enderror">
                                    <option value="">Seleccionar intensidad</option>
                                    <option value="Baja" {{ old('intensidad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="Moderada" {{ old('intensidad') == 'Moderada' ? 'selected' : '' }}>Moderada</option>
                                    <option value="Alta" {{ old('intensidad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                    <option value="Extrema" {{ old('intensidad') == 'Extrema' ? 'selected' : '' }}>Extrema</option>
                                </select>
                                @error('intensidad')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="equipoNecesario" class="form-label fw-bold small text-secondary">
                                    <i class="bi bi-tools me-1"></i> Equipo Requerido
                                </label>
                                <select name="equipoNecesario" id="equipoNecesario" 
                                        class="form-select glass-input rounded-pill px-3 py-2 shadow-sm @error('equipoNecesario') is-invalid @enderror">
                                    <option value="">Ninguno (Peso Corporal)</option>
                                    <option value="Mancuernas" {{ old('equipoNecesario') == 'Mancuernas' ? 'selected' : '' }}>Mancuernas</option>
                                    <option value="Banda elástica" {{ old('equipoNecesario') == 'Banda elástica' ? 'selected' : '' }}>Banda elástica</option>
                                    <option value="Barra" {{ old('equipoNecesario') == 'Barra' ? 'selected' : '' }}>Barra</option>
                                    <option value="Máquina" {{ old('equipoNecesario') == 'Máquina' ? 'selected' : '' }}>Máquina</option>
                                    <option value="Colchoneta" {{ old('equipoNecesario') == 'Colchoneta' ? 'selected' : '' }}>Colchoneta</option>
                                    <option value="Banco" {{ old('equipoNecesario') == 'Banco' ? 'selected' : '' }}>Banco</option>
                                </select>
                                @error('equipoNecesario')
                                    <div class="invalid-feedback ps-2 mt-1 fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- SECCIÓN MULTIMEDIA 1: Carga de Imagen -->
                        <div class="bg-light bg-opacity-50 rounded-4 p-3 mb-3 border border-dashed">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="imagen_file" class="form-label fw-bold small text-secondary">
                                        <i class="bi bi-image me-1"></i> Imagen Ilustrativa (Subir Local)
                                    </label>
                                    <input type="file" name="imagen_file" id="imagen_file" 
                                           class="form-control glass-input rounded-pill shadow-sm" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="imagen_url" class="form-label fw-bold small text-secondary">
                                        <i class="bi bi-link-45deg me-1"></i> O pegar URL de la Imagen
                                    </label>
                                    <input type="url" name="imagen_url" id="imagen_url" value="{{ old('imagen_url') }}"
                                           class="form-control glass-input rounded-pill shadow-sm" placeholder="https://ejemplo.com/imagen.jpg">
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN MULTIMEDIA 2: Carga de Video o Animaciones GIF -->
                        <div class="bg-light bg-opacity-50 rounded-4 p-3 mb-4 border border-dashed">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="video_file" class="form-label fw-bold small text-secondary">
                                        <i class="bi bi-film me-1"></i> Video o GIF guía (Subir Local)
                                    </label>
                                    <input type="file" name="video_file" id="video_file" 
                                           class="form-control glass-input rounded-pill shadow-sm" accept="video/*,.gif">
                                </div>
                                <div class="col-md-6">
                                    <label for="video_url" class="form-label fw-bold small text-secondary">
                                        <i class="bi bi-camera-video me-1"></i> O pegar URL del Video / GIF
                                    </label>
                                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                                           class="form-control glass-input rounded-pill shadow-sm" placeholder="https://ejemplo.com/ejercicio.mp4">
                                </div>
                            </div>
                        </div>

                        <!-- BOTONERA INFERIOR -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-2">
                            <a href="{{ route('ejercicios.index') }}" 
                               class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                                <i class="bi bi-arrow-left-circle me-2"></i> Cancelar y Volver
                            </a>
                            <button type="submit" 
                                    class="btn text-white btn-panel-pill btn-save-exercise shadow-sm">
                                <i class="bi bi-save me-2"></i> Registrar Ejercicio
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection