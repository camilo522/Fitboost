@extends('layouts.app')

@section('title', 'Editar Rutina')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 700px;">
        <div class="card-body p-5">
            <h2 class="fw-bold mb-4 text-center">Editar Rutina</h2>

            <form action="{{ route('rutinas.update', $rutinas->id) }}" method="POST">
                @csrf
                
                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" 
                           name="nombre" 
                           id="nombre" 
                           value="{{ $rutinas->nombre }}"
                           class="form-control rounded-pill" 
                           placeholder="Escribe el nombre de la rutina">
                </div>

                <!-- Horario -->
                <div class="mb-4">
                    <label for="horario" class="form-label fw-bold">Horario</label>
                    <input type="time" 
                           name="horario" 
                           id="horario" 
                           value="{{ $rutinas->horario }}"
                           class="form-control rounded-pill">
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" 
                              id="descripcion" 
                              rows="3" 
                              class="form-control rounded-4"
                              placeholder="Escribe una descripción">{{ $rutinas->descripcion }}</textarea>
                </div>

                <!-- Entrenamiento -->
                <div class="mb-4">
                    <label for="idEntrenamiento" class="form-label fw-bold">Entrenamiento</label>
                    <select name="idEntrenamiento" 
                            id="idEntrenamiento" 
                            class="form-select rounded-pill">
                        <option value="">-- Selecciona un entrenamiento --</option>
                        @foreach($entrenamientos as $entrenamiento)
                            <option value="{{ $entrenamiento->id }}" 
                                    {{ $rutinas->idEntrenamiento == $entrenamiento->id ? 'selected' : '' }}>
                                {{ $entrenamiento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('rutinas.index') }}" 
                       class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                       <i class="bi bi-arrow-left-circle me-2"></i> Volver
                    </a>
                    <button type="submit" 
                            class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
                            style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                        <i class="bi bi-save me-2"></i> Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
