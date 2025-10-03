@extends('layouts.app')

@section('title', 'Editar Ejercicio')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-gradient">
        <i class="bi bi-pencil-square"></i> Editar Ejercicio
    </h1>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <form action="{{ route('ejercicios.update', $ejercicio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $ejercicio->nombre }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ $ejercicio->descripcion }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select" required>
                            <option value="Fuerza" {{ $ejercicio->categoria == 'Fuerza' ? 'selected' : '' }}>Fuerza</option>
                            <option value="Cardio" {{ $ejercicio->categoria == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Flexibilidad" {{ $ejercicio->categoria == 'Flexibilidad' ? 'selected' : '' }}>Flexibilidad</option>
                            <option value="Resistencia" {{ $ejercicio->categoria == 'Resistencia' ? 'selected' : '' }}>Resistencia</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="grupoMuscular" class="form-label">Grupo Muscular</label>
                        <select name="grupoMuscular" id="grupoMuscular" class="form-select" required>
                            <option value="Pecho" {{ $ejercicio->grupoMuscular == 'Pecho' ? 'selected' : '' }}>Pecho</option>
                            <option value="Espalda" {{ $ejercicio->grupoMuscular == 'Espalda' ? 'selected' : '' }}>Espalda</option>
                            <option value="Piernas" {{ $ejercicio->grupoMuscular == 'Piernas' ? 'selected' : '' }}>Piernas</option>
                            <option value="Brazos" {{ $ejercicio->grupoMuscular == 'Brazos' ? 'selected' : '' }}>Brazos</option>
                            <option value="Hombros" {{ $ejercicio->grupoMuscular == 'Hombros' ? 'selected' : '' }}>Hombros</option>
                            <option value="Abdomen" {{ $ejercicio->grupoMuscular == 'Abdomen' ? 'selected' : '' }}>Abdomen</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="equipoNecesario" class="form-label">Equipo Necesario</label>
                        <select name="equipoNecesario" id="equipoNecesario" class="form-select">
                            <option value="Ninguno" {{ $ejercicio->equipoNecesario == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                            <option value="Mancuernas" {{ $ejercicio->equipoNecesario == 'Mancuernas' ? 'selected' : '' }}>Mancuernas</option>
                            <option value="Barra" {{ $ejercicio->equipoNecesario == 'Barra' ? 'selected' : '' }}>Barra</option>
                            <option value="Máquinas" {{ $ejercicio->equipoNecesario == 'Máquinas' ? 'selected' : '' }}>Máquinas</option>
                            <option value="Banda elástica" {{ $ejercicio->equipoNecesario == 'Banda elástica' ? 'selected' : '' }}>Banda elástica</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="intensidad" class="form-label">Intensidad</label>
                        <select name="intensidad" id="intensidad" class="form-select" required>
                            <option value="Baja" {{ $ejercicio->intensidad == 'Baja' ? 'selected' : '' }}>Baja</option>
                            <option value="Media" {{ $ejercicio->intensidad == 'Media' ? 'selected' : '' }}>Media</option>
                            <option value="Alta" {{ $ejercicio->intensidad == 'Alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="duracionEstimada" class="form-label">Duración Estimada (min)</label>
                        <input type="number" name="duracionEstimada" id="duracionEstimada" class="form-control" value="{{ $ejercicio->duracionEstimada }}">
                    </div>

                    <div class="mb-3">
                        <label for="imagenURL" class="form-label">Imagen / GIF</label>
                        <input type="file" name="imagenURL" id="imagenURL" class="form-control" accept="image/*">
                        @if($ejercicio->imagenURL)
                            <small class="text-muted d-block mt-1">Imagen actual: {{ $ejercicio->imagenURL }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="videoURL" class="form-label">GIF URL (opcional)</label>
                        <input type="text" name="videoURL" id="videoURL" class="form-control" value="{{ $ejercicio->videoURL }}">
                    </div>
                    
                <!-- Botones -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('ejercicios.index') }}" 
                       class="btn btn-secondary rounded-pill px-4 fw-bold">
                        <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                    </a>

                    <button type="submit" 
                            class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
                            style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                        <i class="bi bi-save me-2"></i> Actualizar Ejercicio
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
