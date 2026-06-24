@extends('layouts.app')

@section('title', 'Listado de Ejercicios | FitBoost')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-success">
        <i class="bi bi-bicycle me-2"></i>Gestión de Ejercicios
    </h1>
@endsection

@section('content')

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar',
                timer: 3000
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '¡Atención!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Aceptar',
            });
        });
    </script>
@endif

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

    /* Contenedor interno de la tabla */
    .table-container-custom {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
        background: #ffffff;
    }

    /* Personalización de la tabla - Ahora más limpia y espaciosa */
    .table-custom th {
        background-color: #0f172a !important;
        color: #ffffff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem !important;
        border: none !important;
    }

    .table-custom td {
        font-size: 0.88rem;
        padding: 1rem 0.75rem !important;
        color: #334155;
    }

    /* Estilos para los Badges informativos */
    .badge-pill-custom {
        font-weight: 700;
        font-size: 0.72rem;
        padding: 0.35rem 0.7rem;
        border-radius: 30px;
        display: inline-block;
        white-space: nowrap;
    }
    .badge-diff-easy { background: rgba(3, 201, 55, 0.1); color: #03c937; border: 1px solid rgba(3, 201, 55, 0.2); }
    .badge-diff-medium { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }
    .badge-diff-hard { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
    .badge-general { background: rgba(15, 23, 42, 0.06); color: #0f172a; }

    /* Miniaturas de medios en móvil */
    .media-thumb {
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 2px solid #ffffff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
    }
    .media-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(3, 201, 55, 0.2) !important;
    }

    /* Botones píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.45rem 1rem;
        font-weight: 700;
        font-size: 0.78rem;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
    .btn-add-exercise {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-add-exercise:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }

    /* Tarjetas adaptativas para móviles */
    .exercise-mobile-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        transition: transform 0.2s ease;
    }
</style>

<div class="container-fluid py-4">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-exercise rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-bicycle me-2"></i>Biblioteca de Ejercicios
                    </h2>
                    <p class="text-muted mb-0 small">
                        Manejo centralizado de movimientos, intensidades y configuración deportiva.
                    </p>
                </div>
                <div>
                    <a href="{{ route('ejercicios.create') }}" 
                       class="btn text-white btn-panel-pill btn-add-exercise shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> Crear nuevo ejercicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENEDOR CENTRAL --}}
    <div class="card glass-card-exercise border-0">
        <div class="card-body p-3 p-md-4">
            
            @if($ejercicios->isNotEmpty())
                {{-- 1. VISTA ESCRITORIO OPTIMIZADA (TABLA COMPACTA DE 7 COLUMNAS) --}}
                <div class="table-responsive table-container-custom shadow-sm mb-3 d-none d-lg-block">
                    <table class="table table-hover table-custom align-middle text-center mb-0">
                        <thead>
                            <tr>
                                <th style="width: 8%">ID</th>
                                <th style="width: 25%">Nombre</th>
                                <th style="width: 17%">Categoría</th>
                                <th style="width: 17%">Grupo Muscular</th>
                                <th style="width: 13%">Dificultad</th>
                                <th style="width: 10%">Duración</th>
                                <th style="width: 10%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ejercicios as $ejercicio)
                                <tr>
                                    <td class="fw-bold text-secondary">#{{ $ejercicio->id }}</td>
                                    <td class="fw-bold text-dark text-start ps-4">{{ $ejercicio->nombre }}</td>
                                    <td><span class="badge-pill-custom badge-general">{{ $ejercicio->categoria }}</span></td>
                                    <td class="fw-semibold text-secondary">{{ $ejercicio->grupoMuscular }}</td>
                                    <td>
                                        @php
                                            $diff = Str::lower($ejercicio->dificultad);
                                            $diffClass = 'badge-general';
                                            if(str_contains($diff, 'principiante') || str_contains($diff, 'baja') || str_contains($diff, 'fácil')) $diffClass = 'badge-diff-easy';
                                            elseif(str_contains($diff, 'intermedio') || str_contains($diff, 'media')) $diffClass = 'badge-diff-medium';
                                            elseif(str_contains($diff, 'avanzado') || str_contains($diff, 'alta') || str_contains($diff, 'difícil')) $diffClass = 'badge-diff-hard';
                                        @endphp
                                        <span class="badge-pill-custom {{ $diffClass }}">{{ $ejercicio->dificultad }}</span>
                                    </td>
                                    <td class="text-nowrap">
                                        <i class="bi bi-stopwatch text-muted me-1"></i>{{ $ejercicio->duracionEstimada }} min
                                    </td>
                                    {{-- ACCIONES REDUCIDAS --}}
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('ejercicios.show', $ejercicio->id) }}" 
                                               class="btn btn-sm btn-outline-info btn-panel-pill px-2" title="Ver detalle">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('ejercicios.edit', $ejercicio->id) }}" 
                                               class="btn btn-sm btn-outline-primary btn-panel-pill px-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('ejercicios.destroy', $ejercicio->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger btn-panel-pill px-2"
                                                        onclick="confirmarEliminacion(event)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- 2. VISTA MÓVIL (TARJETAS COMPLETAS) --}}
                <div class="row g-3 d-lg-none mb-4">
                    @foreach ($ejercicios as $ejercicio)
                        <div class="col-12 col-md-6">
                            <div class="card exercise-mobile-card shadow-sm p-3">
                                <div class="d-flex align-items-start gap-3">
                                    {{-- Multimedia móvil --}}
                                    <div class="d-flex flex-column gap-2 flex-shrink-0">
                                        @if($ejercicio->imagenURL)
                                            <img src="{{ $ejercicio->imagenURL }}" width="65" height="50" class="media-thumb" onclick="abrirModalImagen(`{{ $ejercicio->imagenURL }}`)">
                                        @endif
                                        @if($ejercicio->videoURL)
                                            @if(str_contains($ejercicio->videoURL, '.gif'))
                                                <img src="{{ $ejercicio->videoURL }}" width="65" height="50" class="media-thumb" onclick="abrirModalImagen('{{ $ejercicio->videoURL }}')">
                                            @else
                                                <video src="{{ $ejercicio->videoURL }}" width="65" height="50" autoplay loop muted playsinline class="media-thumb" data-video="{{ $ejercicio->videoURL }}" onclick="abrirModal(this.dataset.video)"></video>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    {{-- Info móvil --}}
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="text-secondary fw-bold small">#{{ $ejercicio->id }}</span>
                                            @php
                                                $diff = Str::lower($ejercicio->dificultad);
                                                $diffClass = 'badge-general';
                                                if(str_contains($diff, 'principiante') || str_contains($diff, 'baja') || str_contains($diff, 'fácil')) $diffClass = 'badge-diff-easy';
                                                elseif(str_contains($diff, 'intermedio') || str_contains($diff, 'media')) $diffClass = 'badge-diff-medium';
                                                elseif(str_contains($diff, 'avanzado') || str_contains($diff, 'alta') || str_contains($diff, 'difícil')) $diffClass = 'badge-diff-hard';
                                            @endphp
                                            <span class="badge-pill-custom {{ $diffClass }}">{{ $ejercicio->dificultad }}</span>
                                        </div>
                                        <h5 class="fw-bold text-dark text-truncate mb-1">{{ $ejercicio->nombre }}</h5>
                                        <p class="text-muted small mb-2">
                                            {{ Str::limit($ejercicio->descripcion, 60, '...') }}
                                        </p>
                                        
                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                            <span class="badge-pill-custom badge-general">{{ $ejercicio->categoria }}</span>
                                            <span class="badge-pill-custom badge-general">{{ $ejercicio->grupoMuscular }}</span>
                                        </div>

                                        {{-- Acciones móvil --}}
                                        <div class="d-flex justify-content-end gap-1 pt-2 border-top">
                                            <a href="{{ route('ejercicios.show', $ejercicio->id) }}" class="btn btn-sm btn-outline-info btn-panel-pill px-2 py-1">
                                                <i class="bi bi-eye"></i> Ver
                                            </a>
                                            <a href="{{ route('ejercicios.edit', $ejercicio->id) }}" class="btn btn-sm btn-outline-primary btn-panel-pill px-2 py-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('ejercicios.destroy', $ejercicio->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-panel-pill px-2 py-1" onclick="confirmarEliminacion(event)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-muted shadow-sm rounded-4 bg-white border border-light">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-folder-x fs-1 text-secondary opacity-50 mb-2"></i>
                        <span class="fw-semibold">No se encontraron ejercicios registrados en la biblioteca.</span>
                    </div>
                </div>
            @endif

            {{-- BOTÓN REGRESAR --}}
            <div class="d-flex justify-content-start mt-3">
                <a href="{{ route('welcome') }}" 
                   class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver al Inicio
                </a>
            </div>

        </div>
    </div>
</div>

{{-- MODALES DE PREVISUALIZACIÓN MULTIMEDIA (Se conservan para las miniaturas móviles) --}}
<div id="modalGIF" class="modal-fade d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 1050;">
    <div class="position-relative" onclick="event.stopPropagation()">
        <video id="modalVideo" autoplay loop muted playsinline style="max-width: 90vw; max-height: 90vh;" class="rounded shadow"></video>
        <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle fw-bold shadow-sm" onclick="cerrarModal()">✕</button>
    </div>
</div>

<div id="modalImagen" class="modal-fade d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 1050;">
    <div class="position-relative" onclick="event.stopPropagation()">
        <img id="modalImagenSrc" src="" alt="Imagen" style="max-width: 90vw; max-height: 90vh;" class="rounded shadow">
        <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle fw-bold shadow-sm" onclick="cerrarModalImagen()">✕</button>
    </div>
</div>

@endsection

@section('custom_css')
    <style>
        .modal-fade { opacity: 0; transition: opacity 0.3s ease; }
        .modal-fade.show { opacity: 1; }
        .cursor-pointer { cursor: pointer; }
    </style>
@endsection

@section('custom_js')
    <script>
        const modal = document.getElementById('modalGIF');
        const modalVideo = document.getElementById('modalVideo');
        const modalImagen = document.getElementById('modalImagen');
        const modalImagenSrc = document.getElementById('modalImagenSrc');

        function abrirModal(videoSrc) {
            modalVideo.src = videoSrc;
            modal.classList.remove('d-none');
            void modal.offsetWidth; 
            modal.classList.add('show');
        }

        function cerrarModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                modalVideo.pause();
                modalVideo.src = '';
                modal.classList.add('d-none');
            }, 300);
        }

        function abrirModalImagen(src) {
            modalImagenSrc.src = src;
            modalImagen.classList.remove('d-none');
            void modalImagen.offsetWidth; 
            modalImagen.classList.add('show');
        }

        function cerrarModalImagen() {
            modalImagen.classList.remove('show');
            setTimeout(() => {
                modalImagenSrc.src = '';
                modalImagen.classList.add('d-none');
            }, 300);
        }

        modal.addEventListener('click', cerrarModal);
        modalImagen.addEventListener('click', cerrarModalImagen);
    </script>

    <script>
        function confirmarEliminacion(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir este cambio de la biblioteca!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#03c937',
                cancelButtonColor: '#ea5455',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: 'rgba(255, 255, 255, 0.95)',
                backdrop: `rgba(15, 23, 42, 0.2)`
            }).then((result) => {
                if (result.isConfirmed) { form.submit(); }
            });
        }
    </script>
@endsection