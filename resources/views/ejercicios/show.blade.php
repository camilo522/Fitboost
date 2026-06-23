@extends('layouts.app')

@section('title', $ejercicio->nombre . ' | Detalle')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-success">
        <i class="bi bi-eye me-2"></i>Detalle del Ejercicio
    </h1>
@endsection

@section('content')
{{-- Estilos Glassmorphism adaptados para la vista de detalle --}}
<style>
    .glass-card-detail {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    .media-container {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .media-display {
        width: 100%;
        height: auto;
        max-height: 350px;
        object-fit: contain;
        background-color: #f8fafc;
    }

    .badge-pill-custom {
        font-weight: 700;
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 30px;
        display: inline-block;
    }
    
    .badge-general { background: rgba(15, 23, 42, 0.06); color: #0f172a; }

    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.5rem 1.2rem;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container py-4">
    <div class="card glass-card-detail border-0 max-width-md mx-auto">
        <div class="card-body p-4 p-md-5">
            
            {{-- Encabezado del Ejercicio --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark mb-2">{{ $ejercicio->nombre }}</h2>
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <span class="badge-pill-custom badge-general">
                        <i class="bi bi-tags-fill me-1"></i>{{ $ejercicio->categoria }}
                    </span>
                    <span class="badge-pill-custom badge-general">
                        <i class="bi bi-person-fill me-1"></i>{{ $ejercicio->grupoMuscular }}
                    </span>
                    @if($ejercicio->intensidad)
                        <span class="badge-pill-custom badge-general">
                            <i class="bi bi-speedometer2 me-1"></i>{{ $ejercicio->intensidad }}
                        </span>
                    @endif
                    @if($ejercicio->duracionEstimada)
                        <span class="badge-pill-custom badge-general">
                            <i class="bi bi-stopwatch me-1"></i>{{ $ejercicio->duracionEstimada }} min
                        </span>
                    @endif
                </div>
            </div>

            <hr class="opacity-25 my-4">

            {{-- Contenido Multimedia (Imagen y Video/GIF) --}}
            <div class="row g-4 mb-4">
                {{-- Columna de Imagen --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3 text-center text-md-start">
                        <i class="bi bi-image me-1"></i> Imagen Ilustrativa
                    </h5>
                    <div class="media-container d-flex align-items-center justify-content-center p-2 h-100" style="min-height: 250px;">
                        @if($ejercicio->imagenURL)
                            <img src="{{ $ejercicio->imagenURL }}" 
                                 alt="Imagen de {{ $ejercicio->nombre }}" 
                                 class="media-display rounded">
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-image-alt fs-1 opacity-50"></i>
                                <p class="small mb-0 mt-2">Sin imagen disponible</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Columna de Video / GIF --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3 text-center text-md-start">
                        <i class="bi bi-play-circle me-1"></i> Guía en Video / GIF
                    </h5>
                    <div class="media-container d-flex align-items-center justify-content-center p-2 h-100" style="min-height: 250px;">
                        @if($ejercicio->videoURL)
                            @if(str_contains($ejercicio->videoURL, '.gif'))
                                <img src="{{ $ejercicio->videoURL }}" 
                                     alt="GIF guía de {{ $ejercicio->nombre }}" 
                                     class="media-display rounded">
                            @else
                                <video src="{{ $ejercicio->videoURL }}" 
                                       controls 
                                       autoplay 
                                       loop 
                                       muted 
                                       playsinline 
                                       class="media-display rounded">
                                    Tu navegador no soporta la reproducción de video.
                                </video>
                            @endif
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-camera-video-off fs-1 opacity-50"></i>
                                <p class="small mb-0 mt-2">Sin video o GIF disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Descripción del Ejercicio --}}
            @if($ejercicio->descripcion)
                <div class="mb-4 bg-white p-3 rounded-4 border border-light shadow-sm">
                    <h5 class="fw-bold text-dark mb-2">
                        <i class="bi bi-file-text me-1"></i> Instrucciones / Descripción
                    </h5>
                    <p class="text-muted mb-0 justify-text" style="line-height: 1.6;">
                        {{ $ejercicio->descripcion }}
                    </p>
                </div>
            @endif

            {{-- Equipo Necesario --}}
            <div class="mb-5">
                <p class="text-muted small">
                    <i class="bi bi-tools me-1"></i> <strong>Equipo requerido:</strong> 
                    {{ $ejercicio->equipoNecesario ?? 'Ninguno (Peso corporal)' }}
                </p>
            </div>

            {{-- Acciones del Panel --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a href="{{ route('ejercicios.index') }}" 
                   class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver al listado
                </a>

                <a href="{{ route('ejercicios.edit', $ejercicio->id) }}" 
                   class="btn btn-primary btn-panel-pill shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i> Editar Ejercicio
                </a>
            </div>

        </div>
    </div>
</div>
@endsection