@extends('layouts.app')

@section('title', 'Editar Plan Nutricional')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-gradient">
        <i class="bi bi-pencil-square"></i> Editar Plan Nutricional
    </h1>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tarjeta principal que contiene el formulario -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <form action="{{ route('planes-nutricionales.update', $planNutricional->id) }}" method="POST">
                        @csrf
                       
                         @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Por favor, corrige los siguientes errores!</h4>
            <hr>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                        <!-- Selección de Usuario -->
                        <div class="mb-3">
                            <label for="id_usuario" class="form-label fw-bold">Asignar a Usuario</label>
                            <select name="id_usuario" id="id_usuario" class="form-select rounded-pill" required>
                                <option value="">Selecciona un usuario</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ $planNutricional->id_usuario == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} ({{ $usuario->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Datos Nutricionales en una fila -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="calorias_diarias" class="form-label fw-bold">Calorías Diarias</label>
                                <input type="number" name="calorias_diarias" class="form-control rounded-pill" value="{{ $planNutricional->calorias_diarias }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="proteinas_gramos" class="form-label fw-bold">Proteínas (gramos)</label>
                                <input type="number" name="proteinas_gramos" class="form-control rounded-pill" value="{{ $planNutricional->proteinas_gramos }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="carbohidratos_gramos" class="form-label fw-bold">Carbohidratos (gramos)</label>
                                <input type="number" name="carbohidratos_gramos" class="form-control rounded-pill" value="{{ $planNutricional->carbohidratos_gramos }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="grasas_gramos" class="form-label fw-bold">Grasas (gramos)</label>
                                <input type="number" name="grasas_gramos" class="form-control rounded-pill" value="{{ $planNutricional->grasas_gramos }}" required>
                            </div>
                        </div>

                        <!-- Consejos Adicionales -->
                        <div class="mb-3 mt-3">
                            <label for="consejos_adicionales" class="form-label fw-bold">Consejos Adicionales</label>
                            <textarea name="consejos_adicionales" class="form-control rounded-4" rows="3">{{ $planNutricional->consejos_adicionales }}</textarea>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('planes-nutricionales.index') }}" class="btn btn-secondary rounded-pill">
                                <i class="bi bi-arrow-left-circle me-2"></i> Volver
                            </a>
                            <button type="submit" class="btn text-white fw-bold rounded-pill px-4 shadow-sm" style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                                <i class="bi bi-save me-2"></i> Actualizar Plan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection