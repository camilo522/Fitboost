@extends('layouts.app')

@section('title', 'Crear Rutina')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold mb-4 text-primary">
                        <i class="bi bi-plus-circle me-2"></i> Nueva Rutina
                    </h3>

                    <form action="{{ route('rutinas.store') }}" method="POST">
                        @csrf

                        {{-- Mensaje de éxito --}}
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        {{-- Entrenamiento --}}
                        <div class="mb-3">
                            <label for="idEntrenamiento" class="form-label fw-bold">Entrenamiento</label>
                            <select name="idEntrenamiento" id="idEntrenamiento" 
                                    class="form-control rounded-pill px-3 py-2 shadow-sm @error('idEntrenamiento')is-invalid  @enderror" >
                                <option value="" disabled selected>Seleccione un entrenamiento</option>
                                @foreach ($entrenamientos as $entrenamiento)
                                    <option value="{{ $entrenamiento->id }}">
                                        {{ $entrenamiento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                             @error('idEntrenamiento')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre de la Rutina</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control rounded-pill px-3 py-2 shadow-sm @error('nombre')is-invalid  @enderror" 
                                   placeholder="Ejemplo: Fuerza Avanzada" >
                                   @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Horario --}}
                        <div class="mb-3">
                            <label for="horario" class="form-label fw-bold">Horario</label>
                            <input type="time" name="horario" id="horario" 
                                   class="form-control rounded-pill px-3 py-2 shadow-sm @error('horario')is-invalid  @enderror">
                                   @error('horario')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" 
                                      class="form-control rounded-4 px-3 py-2 shadow-sm @error('descripcion')is-invalid  @enderror"
                                      placeholder="Ingrese una breve descripción..."></textarea>
                                      @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('rutinas.index') }}" 
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
    </div>
</div>
@endsection