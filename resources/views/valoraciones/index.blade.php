@extends('layouts.app')

@section('title', 'Gestión de Valoraciones | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para listados y tablas --}}

<style>
    /* Cabecera estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor principal de la tabla */
    .glass-card-table {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px !important;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Estilización avanzada e idéntica para la cabecera de la tabla */
    .custom-table thead {
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table thead th {
        /* Se aplica el fondo directamente al TH anulando la propiedad nativa de Bootstrap */
        background-color: rgba(15, 23, 42, 0.06) !important;
        box-shadow: none !important; /* Quita el sombreado interno grisáceo de Bootstrap */
        color: #1e293b !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        border: none !important;
    }

    /* Animación Hover en las filas */
    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .custom-table tbody tr:hover {
        background-color: rgba(57, 169, 0, 0.04) !important;
    }

    /* Botón píldora interactivo */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.5rem 1.3rem;
        font-weight: 600;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }

    /* Badges Modernos */
    .badge-pill-custom {
        border-radius: 20px;
        padding: 0.4rem 0.75rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>
<style>
    /* Cabecera estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor principal de la tabla */
    .glass-card-table {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px !important;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Estilización avanzada para tablas (Idéntica a Entrenamientos) */
    .custom-table thead th {
        background-color: rgba(241, 245, 249, 0.9) !important;
        color: #334155 !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
        border: none !important;
    }

    /* Forzar esquinas redondeadas en el thead de la tabla */
    .custom-table thead tr th:first-child {
        border-radius: 12px 0 0 12px !important;
    }
    .custom-table thead tr th:last-child {
        border-radius: 0 12px 12px 0 !important;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .custom-table tbody tr:hover {
        background-color: rgba(57, 169, 0, 0.04) !important;
    }

    /* Botón píldora interactivo */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.5rem 1.3rem;
        font-weight: 600;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }

    /* Badges Modernos */
    .badge-pill-custom {
        border-radius: 20px;
        padding: 0.4rem 0.75rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>

{{-- NOTIFICACIONES DE SWEETALERT2 --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#39A900',
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
            confirmButtonColor: '#ea580c',
            confirmButtonText: 'Aceptar',
        });
    });
</script>
@endif

<div class="container-fluid py-2">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-clipboard-heart me-2"></i>Gestión de Valoraciones
                    </h2>
                    <p class="text-muted mb-0 small">
                        Historial de control antropométrico, pliegues corporales y mediciones de los atletas.
                    </p>
                </div>
                <div>
                    <a href="{{ route('valoraciones.create') }}" class="btn btn-success btn-panel-pill shadow-sm text-white">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Valoración
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA DE VALORACIONES --}}
    <div class="card glass-card-table border-0">
        <div class="card-body p-0">
            <div class="p-4 d-flex align-items-center justify-content-between border-bottom border-light">
                <h5 class="fw-bold text-dark mb-0">Valoraciones Registradas</h5>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Peso</th>
                            <th>Altura</th>
                            <th>Pecho</th>
                            <th>Cintura</th>
                            <th>Cadera</th>
                            <th>B. Izq.</th>
                            <th>B. Der.</th>
                            <th>P. Izq.</th>
                            <th>P. Der.</th>
                            <th>Pan. Izq.</th>
                            <th>Pan. Der.</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($valoraciones as $valoracion)
                            <tr class="text-center">
                                <td class="fw-bold text-secondary" style="font-size: 0.85rem;">
                                    #{{ $valoracion->id }}
                                </td>
                                <td class="fw-semibold text-dark">
                                    {{ $valoracion->usuario->nombre ?? 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 small fw-medium">
                                        {{ $valoracion->fecha }}
                                    </span>
                                </td>
                                <td class="text-success fw-bold">
                                    {{ $valoracion->peso }} kg
                                </td>
                                <td class="text-secondary small">
                                    {{ $valoracion->altura }} cm
                                </td>
                                <td class="small">{{ $valoracion->pecho }} cm</td>
                                <td class="small">{{ $valoracion->cintura }} cm</td>
                                <td class="small">{{ $valoracion->cadera }} cm</td>
                                <td class="small">{{ $valoracion->brazoIzquierdo }} cm</td>
                                <td class="small">{{ $valoracion->brazoDerecho }} cm</td>
                                <td class="small">{{ $valoracion->piernaIzquierda }} cm</td>
                                <td class="small">{{ $valoracion->piernaDerecha }} cm</td>
                                <td class="small">{{ $valoracion->pantorrillaIzquierda }} cm</td>
                                <td class="small">{{ $valoracion->pantorrillaDerecha }} cm</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('valoraciones.edit', $valoracion->id) }}" 
                                           class="btn btn-xs btn-outline-success rounded-pill px-2 shadow-sm d-inline-flex align-items-center" style="font-size: 0.8rem;">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>

                                        <a href="{{ route('valoraciones.historial', $valoracion->id) }}" 
                                           class="btn btn-xs btn-outline-info rounded-pill px-2 shadow-sm d-inline-flex align-items-center" style="font-size: 0.8rem;">
                                            <i class="bi bi-clock-history me-1"></i> Historial
                                        </a>
                                        
                                        <form action="{{ route('valoraciones.destroy', $valoracion->id) }}" 
                                              method="POST" 
                                              class="d-inline-block m-0">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-xs btn-outline-danger rounded-pill px-2 shadow-sm d-inline-flex align-items-center" style="font-size: 0.8rem;"
                                                    onclick="confirmarEliminacion(event)">
                                                <i class="bi bi-trash me-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-2 d-block mb-2 text-secondary"></i>
                                    No hay valoraciones corporales registradas en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- BOTÓN DE REGRESO INFERIOR --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
            <i class="bi bi-arrow-left-circle me-2"></i> Volver al Inicio
        </a>
    </div>

</div>

{{-- SCRIPT PARA CONFIRMACIÓN DE SWEETALERT2 --}}
<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta valoración e historial biométrico se borrarán permanentemente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#39A900',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection