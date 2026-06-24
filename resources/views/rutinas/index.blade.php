@extends('layouts.app')

@section('title', 'Listado de Rutinas | FitBoost')

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

{{-- Estilos dedicados a la estética Glassmorphism para Rutinas --}}
<style>
    /* Cabecera de sección estilo Cristal */
    .glass-header-routine {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal de la Tabla */
    .glass-card-routine {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Encabezado interno de la tarjeta */
    .glass-card-subheader {
        background: rgba(248, 250, 252, 0.8);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px 24px 0 0 !important;
    }

    /* Estructura limpia de la Tabla */
    .table-container-custom {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
        background: #ffffff;
    }

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

    /* Badges estilizados */
    .badge-training {
        background: rgba(3, 201, 55, 0.1);
        color: #03c937;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 30px;
        border: 1px solid rgba(3, 201, 55, 0.2);
    }

    .badge-schedule {
        background: rgba(15, 23, 42, 0.06);
        color: #0f172a;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 30px;
    }

    /* Botones con estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.5rem 1.2rem;
        font-weight: 700;
        font-size: 0.8rem;
        transition: all 0.25s ease;
    }
    
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }

    .btn-add-routine {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-add-routine:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }
</style>

<div class="container-fluid py-4">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-routine rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-journal-text me-2"></i>Gestión de Rutinas
                    </h2>
                    <p class="text-muted mb-0 small">
                        Administra y planifica los bloques de entrenamiento estructurados de la plataforma.
                    </p>
                </div>
                <div>
                    <a href="{{ route('rutinas.create') }}" 
                       class="btn text-white btn-panel-pill btn-add-routine shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> Crear una nueva rutina
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENEDOR CENTRAL DE RUTINAS --}}
    <div class="card glass-card-routine border-0">
        {{-- Sub-encabezado informativo --}}
        <div class="card-header glass-card-subheader p-4 border-0">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
                    <i class="bi bi-list-task fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark">Listado Base</h5>
                    <p class="mb-0 text-muted small">Asignación horaria y asociación de entrenamientos</p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            {{-- TABLA RESPONSIVA --}}
            <div class="table-responsive table-container-custom shadow-sm mb-2">
                <table class="table table-hover table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>Nombre de la Rutina</th>
                            <th>Horario asignado</th>
                            <th>Descripción</th>
                            <th>Entrenamiento vinculado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rutinas as $rutina)
                            <tr>
                                <td class="fw-bold text-dark">{{ $rutina->nombre }}</td>
                                <td>
                                    <span class="badge badge-schedule">
                                        <i class="bi bi-clock me-1 text-secondary"></i>{{ $rutina->horario }}
                                    </span>
                                </td>
                                <td class="text-start text-muted text-wrap" style="max-width: 250px;">
                                    {{ $rutina->descripcion }}
                                </td>
                                <td>
                                    @if($rutina->entrenamiento)
                                        <span class="badge badge-training">
                                            <i class="bi bi-lightning-charge-fill me-1"></i>{{ $rutina->entrenamiento->nombre }}
                                        </span>
                                    @else
                                        <span class="text-muted fs-7 italic">Sin entrenamiento</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('rutinas.edit', $rutina->id) }}" 
                                           class="btn btn-sm btn-outline-primary btn-panel-pill">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>
                                        
                                        <form action="{{ route('rutinas.destroy', $rutina->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger btn-panel-pill"
                                                    onclick="confirmarEliminacion(event)">
                                                <i class="bi bi-trash me-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-muted">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-folder-x fs-1 text-secondary opacity-50 mb-2"></i>
                                        <span class="fw-semibold">No hay rutinas registradas en el sistema actualmente.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BOTÓN REGRESAR --}}
            <div class="d-flex justify-content-start mt-4">
                <a href="{{ route('welcome') }}" 
                   class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver al Inicio
                </a>
            </div>
        </div>
    </div>

</div>

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir este cambio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03c937',
            cancelButtonColor: '#ea5455',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: 'rgba(255, 255, 255, 0.95)',
            backdrop: `rgba(15, 23, 42, 0.2)`
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection