@extends('layouts.app')

@section('title')
    Crear Valoración
@endsection

@section('titleContent')
    <h1 class="fw-bold text-center text-gradient">
        <i class="bi bi-clipboard-plus"></i> Crear Nueva Valoración
    </h1>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <form action="{{ route('valoraciones.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="idUsuario" class="form-label fw-semibold">Usuario</label>
                        <select name="idUsuario" class="form-select rounded-3 shadow-sm" required>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="fecha" class="form-label fw-semibold">Fecha</label>
                        <input type="date" name="fecha" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="peso" class="form-label fw-semibold">Peso (kg)</label>
                        <input type="number" step="0.01" name="peso" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="altura" class="form-label fw-semibold">Altura (cm)</label>
                        <input type="number" name="altura" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="pecho" class="form-label fw-semibold">Pecho (cm)</label>
                        <input type="number" name="pecho" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="cintura" class="form-label fw-semibold">Cintura (cm)</label>
                        <input type="number" name="cintura" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="cadera" class="form-label fw-semibold">Cadera (cm)</label>
                        <input type="number" name="cadera" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="brazoIzquierdo" class="form-label fw-semibold">Brazo Izq. (cm)</label>
                        <input type="number" name="brazoIzquierdo" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="brazoDerecho" class="form-label fw-semibold">Brazo Der. (cm)</label>
                        <input type="number" name="brazoDerecho" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="antebrazoIzquierdo" class="form-label fw-semibold">Antebrazo Izq. (cm)</label>
                        <input type="number" name="antebrazoIzquierdo" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="antebrazoDerecho" class="form-label fw-semibold">Antebrazo Der. (cm)</label>
                        <input type="number" name="antebrazoDerecho" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="piernaIzquierda" class="form-label fw-semibold">Pierna Izq. (cm)</label>
                        <input type="number" name="piernaIzquierda" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="piernaDerecha" class="form-label fw-semibold">Pierna Der. (cm)</label>
                        <input type="number" name="piernaDerecha" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="pantorrillaIzquierda" class="form-label fw-semibold">Pantorrilla Izq. (cm)</label>
                        <input type="number" name="pantorrillaIzquierda" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    <div class="col-md-4">
                        <label for="pantorrillaDerecha" class="form-label fw-semibold">Pantorrilla Der. (cm)</label>
                        <input type="number" name="pantorrillaDerecha" class="form-control rounded-3 shadow-sm" required>
                    </div>

                    
                <div class="mb-3">
                    <label for="fechaRegistro" class="form-label fw-bold">Fecha Registro</label>
                    <input type="date" class="form-control rounded-pill shadow-sm" id="fechaRegistro" name="fechaRegistro" placeholder   >
                </div>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('valoraciones.index') }}" 
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
