@extends('layouts.app')

@section('title', 'Gestión de Planes Nutricionales | FitBoost')

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

{{-- Estilos dedicados a la estética Glassmorphism para Planes Nutricionales --}}
<style>
    /* Cabecera estilo Cristal */
    .glass-header-nutrition {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal con efecto Cristal */
    .glass-card-nutrition {
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

    /* Personalización avanzada de la tabla */
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

    /* Badges de Estado */
    .badge-status {
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
    }
    .badge-active { background: rgba(3, 201, 55, 0.1); color: #03c937; border: 1px solid rgba(3, 201, 55, 0.2); }
    .badge-inactive { background: rgba(148, 163, 184, 0.1); color: #64748b; border: 1px solid rgba(148, 163, 184, 0.2); }

    /* Indicadores de Macros */
    .macro-tag {
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        background: #f8fafc;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* Botones estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.45rem 1.2rem;
        font-weight: 700;
        font-size: 0.78rem;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
    .btn-add-plan {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-add-plan:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }

    /* Tarjetas adaptativas móviles */
    .plan-mobile-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
    }
</style>

<div class="container-fluid py-4">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-nutrition rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-journal-check me-2"></i>Planes Nutricionales
                    </h2>
                    <p class="text-muted mb-0 small">
                        Administre los objetivos calóricos y la distribución de macronutrientes de los usuarios.
                    </p>
                </div>
                <div>
                    <a href="{{ route('calculadora.index') }}" 
                       class="btn text-white btn-panel-pill btn-add-plan shadow-sm">
                        <i class="bi bi-calculator me-2"></i> Nuevo plan con calculadora
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENEDOR CENTRAL --}}
    <div class="card glass-card-nutrition border-0">
        <div class="card-body p-3 p-md-4">
            
            @if($planes->isNotEmpty())
                {{-- VISTA ESCRITORIO (TABLA ADAPTADA) --}}
                <div class="table-responsive table-container-custom shadow-sm mb-3 d-none d-lg-block">
                    <table class="table table-hover table-custom align-middle text-center mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-start ps-4">Usuario</th>
                                <th>Calorías</th>
                                <th>Proteínas</th>
                                <th>Carbohidratos</th>
                                <th>Grasas</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($planes as $plan)
                                <tr>
                                    <td class="fw-bold text-secondary">#{{ $plan->id }}</td>
                                    <td class="fw-bold text-dark text-start ps-4">
                                        <i class="bi bi-person-circle text-secondary me-2"></i>{{ $plan->usuario->nombre ?? 'Usuario eliminado' }}
                                    </td>
                                    <td class="fw-bold text-success">{{ number_format($plan->calorias_diarias) }} kcal</td>
                                    <td><span class="macro-tag">{{ $plan->proteinas_gramos }}g</span></td>
                                    <td><span class="macro-tag">{{ $plan->carbohidratos_gramos }}g</span></td>
                                    <td><span class="macro-tag">{{ $plan->grasas_gramos }}g</span></td>
                                    <td>
                                        @if($plan->activo)
                                            <span class="badge-status badge-active">Activo</span>
                                        @else
                                            <span class="badge-status badge-inactive">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('planes-nutricionales.show', $plan->id) }}" 
                                               class="btn btn-sm btn-outline-info btn-panel-pill px-3">
                                                <i class="bi bi-eye me-1"></i> Ver plan
                                            </a>
                                            <a href="{{ route('planes-nutricionales.edit', $plan->id) }}" 
                                               class="btn btn-sm btn-outline-primary btn-panel-pill px-3">
                                                <i class="bi bi-pencil-square me-1"></i> Editar
                                            </a>
                                            <form action="{{ route('planes-nutricionales.destroy', $plan->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger btn-panel-pill px-3"
                                                        onclick="confirmarEliminacion(event)">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- VISTA MÓVIL (TARJETAS DISTRIBUIDAS) --}}
                <div class="row g-3 d-lg-none mb-4">
                    @foreach ($planes as $plan)
                        <div class="col-12 col-md-6">
                            <div class="card plan-mobile-card shadow-sm p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <span class="text-secondary fw-bold small">#{{ $plan->id }}</span>
                                    @if($plan->activo)
                                        <span class="badge-status badge-active">Activo</span>
                                    @else
                                        <span class="badge-status badge-inactive">Inactivo</span>
                                    @endif
                                </div>
                                
                                <h5 class="fw-bold text-dark mb-3">
                                    <i class="bi bi-person-circle text-muted me-2"></i>{{ $plan->usuario->nombre ?? 'Usuario eliminado' }}
                                </h5>

                                <div class="bg-light bg-opacity-70 p-2 rounded-3 mb-3 text-center">
                                    <span class="small text-muted d-block">Meta Energética</span>
                                    <span class="fw-bold text-success fs-5">{{ number_format($plan->calorias_diarias) }} kcal</span>
                                </div>

                                <div class="row g-2 text-center mb-3">
                                    <div class="col-4">
                                        <div class="p-2 border rounded-3 bg-white">
                                            <span class="d-block small text-muted">Prot</span>
                                            <span class="fw-bold text-dark">{{ $plan->proteinas_gramos }}g</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-2 border rounded-3 bg-white">
                                            <span class="d-block small text-muted">Carbs</span>
                                            <span class="fw-bold text-dark">{{ $plan->carbohidratos_gramos }}g</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-2 border rounded-3 bg-white">
                                            <span class="d-block small text-muted">Grasa</span>
                                            <span class="fw-bold text-dark">{{ $plan->grasas_gramos }}g</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 pt-2 border-top flex-wrap">
                                    <a href="{{ route('planes-nutricionales.show', $plan->id) }}" class="btn btn-sm btn-outline-info btn-panel-pill px-3 py-1">
                                        <i class="bi bi-eye me-1"></i> Ver plan
                                    </a>
                                    <a href="{{ route('planes-nutricionales.edit', $plan->id) }}" class="btn btn-sm btn-outline-primary btn-panel-pill px-3 py-1">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('planes-nutricionales.destroy', $plan->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-panel-pill px-3 py-1" onclick="confirmarEliminacion(event)">
                                            <i class="bi bi-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- ESTADO VACÍO --}}
                <div class="py-5 text-muted shadow-sm rounded-4 bg-white border border-light text-center">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-folder-x fs-1 text-secondary opacity-50 mb-2"></i>
                        <span class="fw-semibold">No se encontraron planes nutricionales registrados.</span>
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

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir este plan nutricional!",
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