@extends('layouts.app')

@section('title', 'Crear Ejercicio')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-gradient">
        <i class="bi bi-plus-circle"></i> Crear Nuevo Ejercicio
    </h1>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <form action="{{ route('ejercicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nombre y Categoría -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categoria" class="form-label fw-bold">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select rounded-pill" required>
                            <option value="">Seleccionar</option>
                            <option value="Calentamiento">Calentamiento</option>
                            <option value="Fuerza">Fuerza</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Estiramiento">Estiramiento</option>
                            <option value="Resistencia">Resistencia</option>
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control rounded-4" required></textarea>
                </div>

                <!-- Grupo muscular, Dificultad y Duración -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="grupoMuscular" class="form-label fw-bold">Grupo Muscular</label>
                        <select name="grupoMuscular" id="grupoMuscular" class="form-select rounded-pill" required>
                            <option value="">Seleccionar</option>
                            <option value="Pecho">Pecho</option>
                            <option value="Espalda">Espalda</option>
                            <option value="Hombros">Hombros</option>
                            <option value="Brazos">Brazos</option>
                            <option value="Abdomen">Abdomen</option>
                            <option value="Piernas">Piernas</option>
                            <option value="Full Body">Cuerpo completo</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="dificultad" class="form-label fw-bold">Dificultad</label>
                        <select name="dificultad" id="dificultad" class="form-select rounded-pill" required>
                            <option value="">Seleccionar</option>
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="duracionEstimada" class="form-label fw-bold">Duración Estimada (minutos)</label>
                        <input type="number" name="duracionEstimada" id="duracionEstimada" class="form-control rounded-pill" min="1" required>
                    </div>
                </div>

                <!-- Intensidad y Equipo necesario -->
                <div class="row mb-3">
                        <div class="col-md-6">
                                <label for="intensidad" class="form-label fw-bold">Intensidad</label>
                                <select name="intensidad" id="intensidad" class="form-select rounded-pill" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Baja">Baja</option>
                                    <option value="Moderada">Moderada</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Extrema">Extrema</option>
                                </select>
                            </div>    
                            
                        <div class="col-md-6">
                                <label for="equipoNecesario" class="form-label fw-bold">Equipo Necesario</label>
                                <select name="equipoNecesario" id="equipoNecesario" class="form-select rounded-pill">
                                    <option value="">Ninguno</option>
                                    <option value="Mancuernas">Mancuernas</option>
                                    <option value="Banda elástica">Banda elástica</option>
                                    <option value="Barra">Barra</option>
                                    <option value="Máquina">Máquina</option>
                                    <option value="Colchoneta">Colchoneta</option>
                                    <option value="Banco">Banco</option>
                                </select>
                            </div>
                        </div>
                    </div>   

                <!-- Archivos -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="imagenURL" class="form-label fw-bold">Imagen</label>
                        <input type="file" name="imagenURL" id="imagenURL" class="form-control rounded-pill" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label for="videoURL" class="form-label fw-bold">Video (GIF o MP4)</label>
                        <input type="file" name="videoURL" id="videoURL" class="form-control rounded-pill" accept="video/*,.gif">
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('ejercicios.index') }}" 
                               class="btn rounded-pill shadow-sm px-4 py-2 fw-bold text-white" 
                            style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                               <i class="bi bi-arrow-left-circle me-2"></i> Volver
                            </a>
                            <button type="submit" 
                                    class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
                                    style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                                <i class="bi bi-save me-2"></i> Guardar
                            </button>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection
