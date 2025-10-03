@extends('layouts.app')

@section('title', 'Listado de Rutinas')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Rutinas</h2>
        <a href="{{ route('rutinas.create') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-plus-circle me-2"></i> Crear una nueva rutina
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-hover text-center align-middle mb-0">
                <thead class="table-dark rounded-top">
                    <tr>
                        <th>Nombre</th>
                        <th>Horario</th>
                        <th>Descripción</th>
                        <th>Entrenamiento</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rutinas as $rutina)
                        <tr>
                            <td>{{ $rutina->nombre }}</td>
                            <td>{{ $rutina->horario }}</td>
                            <td>{{ $rutina->descripcion }}</td>
                            <td>{{ $rutina->entrenamiento->nombre ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('rutinas.edit', $rutina->id) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill fw-bold me-2">
                                   <i class="bi bi-pencil-square"></i>editar
                                </a>
                                <form action="{{ route('rutinas.destroy', $rutina->id) }}" method="POST" 
                                      style="display:inline-block;">
                                    @csrf
                                  
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger rounded-pill fw-bold"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta rutina?')">
                                        <i class="bi bi-trash"></i>Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No hay rutinas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('welcome') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-arrow-left-circle me-2"></i> Volver
        </a>
    </div>
</div>
@endsection
