@extends('adminlte::page')

@section('title', 'Historial de Valoraciones')

@section('content_header')
    <h1 class="text-center fw-bold mt-3">
        Historial de Valoración #{{ $valoracion->id }}
    </h1>
@endsection

@section('content')
<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detalles del historial</h5>
        <span class="fw-semibold">Usuario: 
            <span class="badge bg-light text-dark">
                {{ $valoracion->usuario->nombre ?? 'No disponible' }}
            </span>
        </span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
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
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->usuario->nombre ?? 'No registrado' }}</td>
                            <td>
                                @if($registro->tipo_accion == 'CREACIÓN')
                                    <span class="badge bg-success">{{ $registro->tipo_accion }}</span>
                                @elseif($registro->tipo_accion == 'ACTUALIZACIÓN')
                                    <span class="badge bg-warning text-dark">{{ $registro->tipo_accion }}</span>
                                @elseif($registro->tipo_accion == 'ELIMINACIÓN')
                                    <span class="badge bg-danger">{{ $registro->tipo_accion }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $registro->tipo_accion }}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($registro->fecha_historial)->format('d/m/Y H:i') }}</td>
                            <td>{{ $registro->peso ?? '-' }}</td>
                            <td>{{ $registro->altura ?? '-' }}</td>
                            <td>{{ $registro->pecho ?? '-' }}</td>
                            <td>{{ $registro->cintura ?? '-' }}</td>
                            <td>{{ $registro->cadera ?? '-' }}</td>
                            <td>{{ $registro->brazoIzquierdo ?? '-' }}</td>
                            <td>{{ $registro->brazoDerecho ?? '-' }}</td>
                            <td>{{ $registro->piernaIzquierda ?? '-' }}</td>
                            <td>{{ $registro->piernaDerecha ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-muted">No hay registros en el historial.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-end">
            <a href="{{ route('valoraciones.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection
