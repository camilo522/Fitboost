@extends('layouts.app')

@section('title', 'Historial de Valoraciones | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para tablas masivas --}}
<style>
    /* Cabecera de sección estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor del Historial */
    .glass-card-history {
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

    /* Tabla con scroll suave y bordes redondeados */
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
        font-size: 0.85rem;
        padding: 0.85rem 0.75rem !important;
        color: #334155;
    }

    /* Badges con degradado para las acciones de auditoría */
    .badge-action {
        font-weight: 700;
        font-size: 0.7rem;
        padding: 0.4rem 0.75rem;
        border-radius: 30px;
        letter-spacing: 0.5px;
    }
    .badge-create { background: linear-gradient(135deg, #11cb64, #03c937); color: white; }
    .badge-update { background: linear-gradient(135deg, #ff9f43, #ff6b6b); color: white; }
    .badge-delete { background: linear-gradient(135deg, #ea5455, #b52a2a); color: white; }

    /* Botón de navegación */
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
                        <i class="bi bi-clock-history me-2"></i>Historial de Valoración #{{ $valoracion->id }}
                    </h2>
                    <p class="text-muted mb-0 small">
                        Registro de auditoría y traza de cambios métricos para este control físico.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENEDOR CENTRAL DEL HISTORIAL --}}
    <div class="card glass-card-history border-0">
        {{-- Sub-encabezado informativo --}}
        <div class="card-header glass-card-subheader p-4 border-0 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
                    <i class="bi bi-info-circle-fill fs-5"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark">Detalles del Historial</h5>
                    <p class="mb-0 text-muted small">Línea de tiempo del seguimiento antropométrico</p>
                </div>
            </div>
            <div class="bg-white px-3 py-2 rounded-pill shadow-sm border border-light">
                <span class="text-secondary fw-semibold small me-1">Usuario:</span>
                <span class="fw-bold text-dark fs-6">{{ $valoracion->usuario->nombre ?? 'No disponible' }}</span>
            </div>
        </div>

        <div class="card-body p-4">
            {{-- TABLA RESPONSIVA --}}
            <div class="table-responsive table-container-custom shadow-sm mb-4">
                <table class="table table-hover table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>ID Historial</th>
                            <th>Usuario</th>
                            <th>Tipo de Acción</th>
                            <th>Fecha del Historial</th>
                            <th>Peso (kg)</th>
                            <th>Altura (cm)</th>
                            <th>Pecho</th>
                            <th>Cintura</th>
                            <th>Cadera</th>
                            <th>Brazo Izq.</th>
                            <th>Brazo Der.</th>
                            <th>Pierna Izq.</th>
                            <th>Pierna Der.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($valoracion->historial as $registro)
                            <tr>
                                <td class="fw-bold text-secondary">#{{ $registro->id }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ $registro->usuario->nombre ?? 'No registrado' }}
                                    </div>
                                </td>
                                <td>
                                    @if($registro->tipo_accion == 'CREACIÓN')
                                        <span class="badge badge-action badge-create">{{ $registro->tipo_accion }}</span>
                                    @elseif($registro->tipo_accion == 'ACTUALIZACIÓN')
                                        <span class="badge badge-action badge-update">{{ $registro->tipo_accion }}</span>
                                    @elseif($registro->tipo_accion == 'ELIMINACIÓN')
                                        <span class="badge badge-action badge-delete">{{ $registro->tipo_accion }}</span>
                                    @else
                                        <span class="badge bg-secondary text-white rounded-pill small">{{ $registro->tipo_accion }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap fw-semibold text-muted">
                                    <i class="bi bi-calendar3 me-1 text-success"></i>
                                    {{ \Carbon\Carbon::parse($registro->fecha_historial)->format('d/m/Y H:i') }}
                                </td>
                                <td class="fw-bold">{{ $registro->peso ?? '-' }}</td>
                                <td>{{ $registro->altura ?? '-' }} cm</td>
                                <td>{{ $registro->pecho ?? '-' }} cm</td>
                                <td>{{ $registro->cintura ?? '-' }} cm</td>
                                <td>{{ $registro->cadera ?? '-' }} cm</td>
                                <td>{{ $registro->brazoIzquierdo ?? '-' }} cm</td>
                                <td>{{ $registro->brazoDerecho ?? '-' }} cm</td>
                                <td>{{ $registro->piernaIzquierda ?? '-' }} cm</td>
                                <td>{{ $registro->piernaDerecha ?? '-' }} cm</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="py-5 text-muted">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-folder-x fs-1 text-secondary opacity-50 mb-2"></i>
                                        <span class="fw-semibold">No se encontraron registros en la bitácora de historial.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BOTÓN REGRESAR --}}
            <div class="d-flex justify-content-start mt-4">
                <a href="{{ route('valoraciones.index') }}" 
                   class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>

</div>

@endsection