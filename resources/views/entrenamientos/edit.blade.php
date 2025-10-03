@extends('layouts.app')

@section('title')
    Crear Entrenamiento
@endsection

@section('titleContent')
    <h1 class="fw-bold text-center text-gradient">Crear un nuevo Entrenamiento</h1>
@endsection

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <form action="{{ route('entrenamientos.update', $entrenamiento->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-semibold" >Nombre</label>
                        <input type="text" name="nombre" class="form-control rounded-3 shadow-sm" required value="{{$entrenamiento->nombre}}">
                    </div>

                    <div class="col-md-6"> 
                        <label for="objetivo" class="form-label fw-semibold" >Objetivo</label>
                        <input type="text" name="objetivo" class="form-control rounded-3 shadow-sm" required value="{{$entrenamiento->objetivo}}">
                    </div>

                    <div class="col-md-12">
                        <label for="descripcion" class="form-label fw-semibold" >Descripción</label>
                        <input name="descripcion" class="form-control rounded-3 shadow-sm" rows="3" required value="{{$entrenamiento->descripcion}}"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="duracion" class="form-label fw-semibold" >Duración (minutos)</label>
                        <input type="number" name="duracion" class="form-control rounded-3 shadow-sm" required value="{{$entrenamiento->duracion}}">
                    </div>

                    <div class="col-md-4">
                        <label for="nivel" class="form-label fw-semibold" >Nivel</label>
                        <select name="nivel" class="form-select rounded-3 shadow-sm" required value="{{$entrenamiento->nivel}}">
                            <option value="Principiante">Principiante</option>
                            <option value="Intermedio">Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="diasSemana" class="form-label fw-semibold" >Días por Semana</label>
                        <input type="number" name="diasSemana" class="form-control rounded-3 shadow-sm" required value="{{$entrenamiento->diasSemana}}">
                    </div>

                    <div class="col-md-6">
                        <label for="estado" class="form-label fw-semibold" >Estado</label>
                        <select name="estado" class="form-select rounded-3 shadow-sm" value="{{$entrenamiento->estado}}">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('entrenamientos.index') }}" 
                       class="btn rounded-pill shadow-sm px-4 py-2 fw-bold text-white" 
                       style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                       <i class="bi bi-arrow-left-circle me-2"></i> Volver
                    </a>
                    <button type="submit" 
                            class="btn rounded-pill shadow-sm px-4 py-2 fw-bold text-white" 
                            style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                        <i class="bi bi-check-circle me-2"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

@endsection
