@extends('layouts.app')

@section('title', 'Calculadora de Macronutrientes')

@section('content')



<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Calculadora de Macronutrientes</h2>
       
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Calcula tu Plan Ideal</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('calculadora.calcular') }}" method="POST">
                @csrf


                <!-- Usuario (Para quién es el plan) -->
                <div class="mb-3">
                    <label for="id_usuario" class="form-label fw-bold">Asignar a Usuario</label>
                    <select class="form-select" id="id_usuario" name="id_usuario" >
                        <option value="" disabled selected>Selecciona un usuario...</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Género -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Género</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre" checked>
                            <label class="form-check-label" for="hombre">Hombre</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer">
                            <label class="form-check-label" for="mujer">Mujer</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Edad -->
                    <div class="col-md-4 mb-3">
                        <label for="edad" class="form-label fw-bold">Edad (años)</label>
                        <input type="number" class="form-control @error('edad')is-invalid  @enderror" id="edad" name="edad" >
                         @error('edad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <!-- Peso -->
                    <div class="col-md-4 mb-3">
                        <label for="peso" class="form-label fw-bold">Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control @error('peso')is-invalid  @enderror" id="peso" name="peso" >
                         @error('peso')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <!-- Altura -->
                    <div class="col-md-4 mb-3">
                        <label for="altura" class="form-label fw-bold">Altura (cm)</label>
                        <input type="number" class="form-control @error('altura')is-invalid  @enderror" id="altura" name="altura" >
                         @error('altura')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>

                <!-- Nivel de Actividad -->
                <div class="mb-3">
                    <label for="nivel_actividad" class="form-label fw-bold">Nivel de Actividad</label>
                    <select class="form-select" id="nivel_actividad" name="nivel_actividad" >
                        <option value="sedentario">Sedentario (poco o ningún ejercicio)</option>
                        <option value="ligero">Ligeramente activo (ejercicio ligero 1-3 días/semana)</option>
                        <option value="moderado" selected>Moderadamente activo (ejercicio moderado 3-5 días/semana)</option>
                        <option value="muy_activo">Muy activo (ejercicio intenso 6-7 días/semana)</option>
                        <option value="extremadamente_activo">Extremadamente activo (atleta de élite)</option>
                    </select>
                </div>

                <!-- Objetivo -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Objetivo</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="objetivo" id="perdida_grasa" value="perdida_grasa" checked>
                            <label class="form-check-label" for="perdida_grasa">Pérdida de Grasa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="objetivo" id="mantenimiento" value="mantenimiento">
                            <label class="form-check-label" for="mantenimiento">Mantenimiento</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="objetivo" id="ganancia_musculo" value="ganancia_musculo">
                            <label class="form-check-label" for="ganancia_musculo">Ganancia de Músculo</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn text-white fw-bold rounded-pill px-4 shadow-sm w-100" 
                        style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                   <i class="bi bi-calculator me-2"></i> Calcular Mis Macros
                </button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('planes-nutricionales.index') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-arrow-left-circle me-2"></i> Volver 
        </a>
    </div>
</div>


@endsection