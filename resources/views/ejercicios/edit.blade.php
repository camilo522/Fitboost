@extends('layouts.app')

@section('title', 'Editar Ejercicio | FitBoost')

@section('content')

<style>
    /* Cabecera estilo Cristal */
    .glass-header-exercise {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal con efecto Cristal */
    .glass-card-exercise {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Inputs y Selects Estilizados */
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

    /* Previsualizaciones Multimedia */
    .media-preview-box {
        background: #f8fafc;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 1rem;
    }
    .media-preview-thumb {
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #ffffff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    /* Botones estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.55rem 1.5rem;
        font-weight: 700;
        font-size: 0.85rem;
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
</style>

<div class="container-fluid py-4" style="max-width: 1000px;">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-exercise rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-pencil-square me-2"></i>Editar Ejercicio
                    </h2>
                    <p class="text-muted mb-0 small">
                        Modifica los parámetros, intensidad o archivos multimedia del ejercicio actual (#{{ $ejercicio->id }}).
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO PRINCIPAL --}}
    <div class="card glass-card-exercise border-0">
        <div class="card-body p-4">
            
            <form action="{{ route('ejercicios.update', $ejercicio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- REMOVIDA LA DIRECTIVA DE CONTROL DE MÉTODO HTTP --}}

                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 p-3 mb-4" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                            <strong>¡Error! Por favor corrige los siguientes campos:</strong>
                        </div>
                        <ul class="mb-0 ps-4 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-4">
                    {{-- Nombre --}}
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-bold text-dark small">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control form-control-custom fw-semibold" value="{{ $ejercicio->nombre }}" required>
                    </div>

                    {{-- Duración --}}
                    <div class="col-md-6">
                        <label for="duracionEstimada" class="form-label fw-bold text-dark small">Duración Estimada (min)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: rgba(226, 232, 240, 0.8);"><i class="bi bi-stopwatch"></i></span>
                            <input type="number" name="duracionEstimada" id="duracionEstimada" class="form-control form-control-custom ps-2" style="border-radius: 0 12px 12px 0 !important;" value="{{ $ejercicio->duracionEstimada }}">
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="col-12">
                        <label for="descripcion" class="form-label fw-bold text-dark small">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control form-control-custom" rows="3">{{ $ejercicio->descripcion }}</textarea>
                    </div>

                    {{-- Categoría --}}
                    <div class="col-md-4">
                        <label for="categoria" class="form-label fw-bold text-dark small">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select form-control-custom" required>
                            <option value="Fuerza" {{ $ejercicio->categoria == 'Fuerza' ? 'selected' : '' }}>Fuerza</option>
                            <option value="Cardio" {{ $ejercicio->categoria == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Flexibilidad" {{ $ejercicio->categoria == 'Flexibilidad' ? 'selected' : '' }}>Flexibilidad</option>
                            <option value="Resistencia" {{ $ejercicio->categoria == 'Resistencia' ? 'selected' : '' }}>Resistencia</option>
                        </select>
                    </div>

                    {{-- Grupo Muscular --}}
                    <div class="col-md-4">
                        <label for="grupoMuscular" class="form-label fw-bold text-dark small">Grupo Muscular</label>
                        <select name="grupoMuscular" id="grupoMuscular" class="form-select form-control-custom" required>
                            <option value="Pecho" {{ $ejercicio->grupoMuscular == 'Pecho' ? 'selected' : '' }}>Pecho</option>
                            <option value="Espalda" {{ $ejercicio->grupoMuscular == 'Espalda' ? 'selected' : '' }}>Espalda</option>
                            <option value="Piernas" {{ $ejercicio->grupoMuscular == 'Piernas' ? 'selected' : '' }}>Piernas</option>
                            <option value="Brazos" {{ $ejercicio->grupoMuscular == 'Brazos' ? 'selected' : '' }}>Brazos</option>
                            <option value="Hombros" {{ $ejercicio->grupoMuscular == 'Hombros' ? 'selected' : '' }}>Hombros</option>
                            <option value="Abdomen" {{ $ejercicio->grupoMuscular == 'Abdomen' ? 'selected' : '' }}>Abdomen</option>
                        </select>
                    </div>

                    {{-- Intensidad --}}
                    <div class="col-md-4">
                        <label for="intensidad" class="form-label fw-bold text-dark small">Intensidad</label>
                        <select name="intensidad" id="intensidad" class="form-select form-control-custom" required>
                            <option value="Baja" {{ $ejercicio->intensidad == 'Baja' ? 'selected' : '' }}>Baja</option>
                            <option value="Media" {{ $ejercicio->intensidad == 'Media' ? 'selected' : '' }}>Media</option>
                            <option value="Alta" {{ $ejercicio->intensidad == 'Alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    {{-- Equipo Necesario --}}
                    <div class="col-12">
                        <label for="equipoNecesario" class="form-label fw-bold text-dark small">Equipo Necesario</label>
                        <select name="equipoNecesario" id="equipoNecesario" class="form-select form-control-custom">
                            <option value="Ninguno" {{ $ejercicio->equipoNecesario == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                            <option value="Mancuernas" {{ $ejercicio->equipoNecesario == 'Mancuernas' ? 'selected' : '' }}>Mancuernas</option>
                            <option value="Barra" {{ $ejercicio->equipoNecesario == 'Barra' ? 'selected' : '' }}>Barra</option>
                            <option value="Máquinas" {{ $ejercicio->equipoNecesario == 'Máquinas' ? 'selected' : '' }}>Máquinas</option>
                            <option value="Banda elástica" {{ $ejercicio->equipoNecesario == 'Banda elástica' ? 'selected' : '' }}>Banda elástica</option>
                        </select>
                    </div>

                    <div class="col-12"><hr class="my-2 opacity-25"></div>

                    {{-- SECCIÓN IMAGEN --}}
                    <div class="col-12 col-lg-6">
                        <div class="media-preview-box h-100 d-flex flex-column justify-content-between">
                            <div class="mb-3 text-center">
                                <label class="form-label fw-bold text-success d-block mb-2"><i class="bi bi-image me-1"></i> Imagen del Ejercicio</label>
                                @if($ejercicio->imagenURL)
                                    <p class="small mb-1 text-muted">Imagen actual:</p>
                                    <img src="{{ $ejercicio->imagenURL }}" alt="{{ $ejercicio->nombre }}" class="media-preview-thumb img-fluid" style="max-width: 200px;" onerror="this.src='https://via.placeholder.com/200';">
                                @else
                                    <p class="small text-muted">No hay imagen.</p>
                                @endif
                            </div>
                            <div>
                                <hr class="my-2">
                                <p class="small text-muted text-center text-lg-start">Puedes reemplazarla subiendo un archivo o pegando una nueva URL.</p>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label for="imagen_file" class="form-label small text-secondary">Subir Nueva Imagen</label>
                                        <input type="file" name="imagen_file" id="imagen_file" class="form-control form-control-custom" accept="image/*">
                                    </div>
                                    <div class="col-12">
                                        <label for="imagen_url" class="form-label small text-secondary">O Pegar Nueva URL</label>
                                        <input type="url" name="imagen_url" id="imagen_url" class="form-control form-control-custom" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN VIDEO / GIF --}}
                    <div class="col-12 col-lg-6">
                        <div class="media-preview-box h-100 d-flex flex-column justify-content-between">
                            <div class="mb-3 text-center">
                                <label class="form-label fw-bold text-success d-block mb-2"><i class="bi bi-play-circle me-1"></i> Video/GIF del Ejercicio</label>
                                @if($ejercicio->videoURL)
                                    <p class="small mb-1 text-muted">Video/GIF actual:</p>
                                    @if(str_contains($ejercicio->videoURL, '.gif'))
                                        <img src="{{ $ejercicio->videoURL }}" alt="{{ $ejercicio->nombre }}" class="media-preview-thumb img-fluid" style="max-width: 200px;">
                                    @else
                                        <video width="200" controls class="media-preview-thumb img-fluid bg-dark">
                                            <source src="{{ $ejercicio->videoURL }}" type="video/mp4">
                                            Tu navegador no soporta el tag de video.
                                        </video>
                                    @endif
                                @else
                                    <p class="small text-muted">No hay video.</p>
                                @endif
                            </div>
                            <div>
                                <hr class="my-2">
                                <p class="small text-muted text-center text-lg-start">Puedes reemplazarlo subiendo un archivo o pegando una nueva URL.</p>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label for="video_file" class="form-label small text-secondary">Subir Nuevo Video/GIF</label>
                                        <input type="file" name="video_file" id="video_file" class="form-control form-control-custom" accept="video/*,.gif">
                                    </div>
                                    <div class="col-12">
                                        <label for="video_url" class="form-label small text-secondary">O Pegar Nueva URL</label>
                                        <input type="url" name="video_url" id="video_url" class="form-control form-control-custom" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                    <a href="{{ route('ejercicios.index') }}" 
                       class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                        <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                    </a>

                    <button type="submit" 
                            class="btn text-white btn-panel-pill btn-save-exercise shadow-sm px-4">
                        <i class="bi bi-save me-2"></i> Actualizar Ejercicio
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection