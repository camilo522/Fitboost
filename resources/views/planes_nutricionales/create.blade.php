@extends('layouts.app')

@section('title', 'Crear Plan Nutricional | FitBoost')

@section('content')

<style>
    /* Cabecera estilo Cristal */
    .glass-header-nutrition {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor Principal con efecto Cristal */
    .glass-card-nutrition {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Inputs, Selects y Textareas Estilizados */
    .form-control-custom {
        border-radius: 12px !important;
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 0.65rem 1rem;
        background-color: #ffffff;
        color: #334155;
        font-size: 0.92rem;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        border-color: #11cb64;
        box-shadow: 0 0 0 3px rgba(17, 203, 100, 0.15);
        background-color: #ffffff;
    }

    /* Botones estilo píldora */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.55rem 1.5rem;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
    .btn-save-nutrition {
        background: linear-gradient(90deg, #11cb64, #03c937);
        border: none;
    }
    .btn-save-nutrition:hover {
        background: linear-gradient(90deg, #0eb357, #02b02f);
        box-shadow: 0 4px 15px rgba(3, 201, 55, 0.3);
    }
</style>

<div class="container-fluid py-4" style="max-width: 900px;">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header-nutrition rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Plan Nutricional
                    </h2>
                    <p class="text-muted mb-0 small">
                        Configure la meta calórica y los macronutrientes correspondientes para el usuario seleccionado.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO PRINCIPAL --}}
    <div class="card glass-card-nutrition border-0">
        <div class="card-body p-4">
            
            <form action="{{ route('planes-nutricionales.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 p-3 mb-4" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                            <strong>¡Error! Por favor corrige los siguientes campos:</strong>
                        </div>
                        <ul class="mb-0 ps-4 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-4">
                    {{-- Selección de Usuario --}}
                    <div class="col-12">
                        <label for="id_usuario" class="form-label fw-bold text-dark small">Asignar a Usuario</label>
                        <select name="id_usuario" id="id_usuario" class="form-select form-control-custom" required>
                            <option value="">Selecciona un usuario...</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Calorías Diarias --}}
                    <div class="col-md-6">
                        <label for="calorias_diarias" class="form-label fw-bold text-dark small">Calorías Diarias</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: rgba(226, 232, 240, 0.8);"><i class="bi bi-fire"></i></span>
                            <input type="number" name="calorias_diarias" id="calorias_diarias" class="form-control form-control-custom ps-2" style="border-radius: 0 12px 12px 0 !important;" value="{{ old('calorias_diarias') }}" placeholder="Ej: 2000" required>
                        </div>
                    </div>

                    {{-- Proteínas --}}
                    <div class="col-md-6">
                        <label for="proteinas_gramos" class="form-label fw-bold text-dark small">Proteínas (gramos)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: rgba(226, 232, 240, 0.8);"><i class="bi bi-egg-fried"></i></span>
                            <input type="number" name="proteinas_gramos" id="proteinas_gramos" class="form-control form-control-custom ps-2" style="border-radius: 0 12px 12px 0 !important;" value="{{ old('proteinas_gramos') }}" placeholder="g" required>
                        </div>
                    </div>

                    {{-- Carbohidratos --}}
                    <div class="col-md-6">
                        <label for="carbohidratos_gramos" class="form-label fw-bold text-dark small">Carbohidratos (gramos)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: rgba(226, 232, 240, 0.8);"><i class="bi bi-wheat"></i></span>
                            <input type="number" name="carbohidratos_gramos" id="carbohidratos_gramos" class="form-control form-control-custom ps-2" style="border-radius: 0 12px 12px 0 !important;" value="{{ old('carbohidratos_gramos') }}" placeholder="g" required>
                        </div>
                    </div>

                    {{-- Grasas --}}
                    <div class="col-md-6">
                        <label for="grasas_gramos" class="form-label fw-bold text-dark small">Grasas (gramos)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: rgba(226, 232, 240, 0.8);"><i class="bi bi-droplet"></i></span>
                            <input type="number" name="grasas_gramos" id="grasas_gramos" class="form-control form-control-custom ps-2" style="border-radius: 0 12px 12px 0 !important;" value="{{ old('grasas_gramos') }}" placeholder="g" required>
                        </div>
                    </div>

                    {{-- Consejos Adicionales --}}
                    <div class="col-12">
                        <label for="consejos_adicionales" class="form-label fw-bold text-dark small">Consejos Adicionales</label>
                        <textarea name="consejos_adicionales" id="consejos_adicionales" class="form-control form-control-custom" rows="4" placeholder="Recomendaciones sobre agua, distribución de comidas o suplementación...">{{ old('consejos_adicionales') }}</textarea>
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                    <a href="{{ route('planes-nutricionales.index') }}" 
                       class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                        <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                    </a>

                    <button type="submit" 
                            class="btn text-white btn-panel-pill btn-save-nutrition shadow-sm px-4">
                        <i class="bi bi-save me-2"></i> Guardar Plan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection