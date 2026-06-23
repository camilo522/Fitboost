@extends('layouts.app')

@section('title', 'Gestión de Entrenamientos | FitBoost')

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
    }

    /* Estilización avanzada para tablas */
    .custom-table thead {
        background-color: rgba(15, 23, 42, 0.06) !important;
        color: #1e293b !important;
        border-bottom: 2px solid #e2e8f0;
    }
    .custom-table th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
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
                        <i class="bi bi-activity me-2"></i>Gestión de Entrenamientos
                    </h2>
                    <p class="text-muted mb-0 small">
                        Administra y planifica los programas de acondicionamiento físico de la plataforma.
                    </p>
                </div>
                <div>
                    <a href="{{ route('entrenamientos.create') }}" class="btn btn-success btn-panel-pill shadow-sm text-white">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Entrenamiento
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA DE ENTRENAMIENTOS --}}
    <div class="card glass-card-table border-0">
        <div class="card-body p-0">
            <div class="p-4 d-flex align-items-center justify-content-between border-bottom border-light">
                <h5 class="fw-bold text-dark mb-0">Programas de Entrenamiento Registrados</h5>
            </div>

            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th class="text-start">Nombre</th>
                            <th class="text-start">Descripción</th>
                            <th>Objetivo</th>
                            <th>Duración</th>
                            <th>Nivel</th>
                            <th>Días/Semana</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($entrenamientos as $entrenamiento)
                            <tr>
                                <td class="text-center fw-bold text-secondary" style="font-size: 0.85rem;">
                                    #{{ $entrenamiento->id }}
                                </td>
                                <td class="text-start fw-semibold text-dark">
                                    {{ $entrenamiento->nombre }}
                                </td>
                                <td class="text-start text-muted small" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $entrenamiento->descripcion }}
                                </td>
                                <td class="text-center small fw-medium">
                                    {{ $entrenamiento->objetivo }}
                                </td>
                                <td class="text-center text-secondary small">
                                    <i class="bi bi-clock me-1"></i> {{ $entrenamiento->duracion }} min
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border rounded-pill px-2 py-1 small fw-semibold">
                                        {{ $entrenamiento->nivel }}
                                    </span>
                                </td>
                                <td class="text-center fw-medium">
                                    {{ $entrenamiento->diasSemana }} días
                                </td>
                                <td class="text-center">
                                    @if($entrenamiento->estado == 'Activo')
                                        <span class="badge bg-success-subtle text-success badge-pill-custom">Activo</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary badge-pill-custom">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('entrenamientos.edit', $entrenamiento->id) }}" 
                                           class="btn btn-sm btn-outline-success rounded-pill px-3 shadow-sm d-inline-flex align-items-center">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>
                                        
                                        <form action="{{ route('entrenamientos.destroy', $entrenamiento->id) }}" 
                                              method="POST" 
                                              class="d-inline-block m-0">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm d-inline-flex align-items-center"
                                                    onclick="confirmarEliminacion(event)">
                                                <i class="bi bi-trash me-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-cone-striped fs-2 d-block mb-2 text-secondary"></i>
                                    No hay programas de entrenamiento creados todavía.
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
            text: "El entrenamiento se eliminará de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#39A900', // Color Verde SENA principal
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