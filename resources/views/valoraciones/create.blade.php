@extends('layouts.app')

@section('title', 'Crear Valoración | FitBoost')

@section('content')

{{-- Estilos dedicados a la estética Glassmorphism para formularios masivos --}}
<style>
    /* Cabecera de sección estilo Cristal */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.04);
    }

    /* Contenedor del Formulario */
    .glass-card-form {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px !important;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    /* Separadores de subsecciones en el formulario */
    .form-section-divider {
        color: var(--sena-dark);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(57, 169, 0, 0.15);
        padding-bottom: 0.5rem;
        margin-top: 1rem;
    }

    /* Icono estilizado a la izquierda en inputs y selects */
    .input-group-text-custom {
        background: rgba(241, 245, 249, 0.9) !important;
        border: 1px solid #d1d5db !important;
        border-radius: 14px 0 0 14px !important;
        color: #64748b;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    /* Ajuste para inputs y selects estandarizados con icono */
    .input-custom-with-icon {
        border-radius: 0 14px 14px 0 !important;
    }

    /* Botón píldora personalizado */
    .btn-panel-pill {
        border-radius: 30px !important;
        padding: 0.6rem 1.6rem;
        font-weight: 700;
        transition: all 0.25s ease;
    }
    .btn-panel-pill:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-2">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-clipboard-plus me-2"></i>Nueva Valoración
                    </h2>
                    <p class="text-muted mb-0 small">
                        Registrar un nuevo control biométrico y medidas antropométricas del usuario
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERTA DE ÉXITO ESTÁNDAR --}}
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 p-3 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span class="fw-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- FORMULARIO PRINCIPAL --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <div class="card glass-card-form border-0">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('valoraciones.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            
                            {{-- SUBSECCIÓN 1: ASIGNACIÓN GENERAL --}}
                            <div class="col-12">
                                <h5 class="form-section-divider mb-1"><i class="bi bi-person-badge me-1"></i> Información General</h5>
                            </div>

                            {{-- SELECCIÓN DE USUARIO --}}
                            <div class="col-12 col-md-6">
                                <label for="idUsuario" class="form-label fw-bold text-secondary mb-2">Usuario / Atleta</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <select name="idUsuario" id="idUsuario" class="form-select input-custom-with-icon" required>
                                        <option value="" disabled selected>Selecciona un usuario...</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}" {{ old('idUsuario') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- FECHA DE LA VALORACIÓN --}}
                            <div class="col-12 col-md-6">
                                <label for="fecha" class="form-label fw-bold text-secondary mb-2">Fecha del Control</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date" 
                                           name="fecha" 
                                           id="fecha"
                                           class="form-control input-custom-with-icon @error('fecha') is-invalid @enderror"
                                           value="{{ old('fecha', date('Y-m-d')) }}" required>
                                </div>
                                @error('fecha')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- SUBSECCIÓN 2: DATOS PRIMARIOS --}}
                            <div class="col-12">
                                <h5 class="form-section-divider mb-1"><i class="bi bi-heart-pulse me-1"></i> Composición Corporal Principal</h5>
                            </div>

                            {{-- PESO --}}
                            <div class="col-12 col-md-4">
                                <label for="peso" class="form-label fw-bold text-secondary mb-2">Peso (kg)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-speedometer2"></i></span>
                                    <input type="number" step="0.01" name="peso" id="peso" placeholder="Ej. 72.5" class="form-control input-custom-with-icon @error('peso') is-invalid @enderror" value="{{ old('peso') }}" required>
                                </div>
                                @error('peso') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- ALTURA --}}
                            <div class="col-12 col-md-4">
                                <label for="altura" class="form-label fw-bold text-secondary mb-2">Altura (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-ruler"></i></span>
                                    <input type="number" name="altura" id="altura" placeholder="Ej. 175" class="form-control input-custom-with-icon @error('altura') is-invalid @enderror" value="{{ old('altura') }}" required>
                                </div>
                                @error('altura') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- PECHO --}}
                            <div class="col-12 col-md-4">
                                <label for="pecho" class="form-label fw-bold text-secondary mb-2">Pecho (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-pci-card"></i></span>
                                    <input type="number" step="0.1" name="pecho" id="pecho" placeholder="Ej. 95" class="form-control input-custom-with-icon @error('pecho') is-invalid @enderror" value="{{ old('pecho') }}">
                                </div>
                                @error('pecho') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- CINTURA --}}
                            <div class="col-12 col-md-6">
                                <label for="cintura" class="form-label fw-bold text-secondary mb-2">Cintura (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-circle"></i></span>
                                    <input type="number" step="0.1" name="cintura" id="cintura" placeholder="Ej. 80" class="form-control input-custom-with-icon @error('cintura') is-invalid @enderror" value="{{ old('cintura') }}">
                                </div>
                                @error('cintura') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- CADERA --}}
                            <div class="col-12 col-md-6">
                                <label for="cadera" class="form-label fw-bold text-secondary mb-2">Cadera (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-gender-ambiguous"></i></span>
                                    <input type="number" step="0.1" name="cadera" id="cadera" placeholder="Ej. 98" class="form-control input-custom-with-icon @error('cadera') is-invalid @enderror" value="{{ old('cadera') }}">
                                </div>
                                @error('cadera') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- SUBSECCIÓN 3: TREN SUPERIOR --}}
                            <div class="col-12">
                                <h5 class="form-section-divider mb-1"><i class="bi bi-symmetry-vertical me-1"></i> Extremidades Superiores</h5>
                            </div>

                            {{-- BRAZO IZQUIERDO --}}
                            <div class="col-12 col-md-3">
                                <label for="brazoIzquierdo" class="form-label fw-bold text-secondary mb-2">Brazo Izq. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-left"></i></span>
                                    <input type="number" step="0.1" name="brazoIzquierdo" id="brazoIzquierdo" placeholder="Ej. 32" class="form-control input-custom-with-icon @error('brazoIzquierdo') is-invalid @enderror" value="{{ old('brazoIzquierdo') }}">
                                </div>
                                @error('brazoIzquierdo') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- BRAZO DERECHO --}}
                            <div class="col-12 col-md-3">
                                <label filter="brazoDerecho" class="form-label fw-bold text-secondary mb-2">Brazo Der. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-right"></i></span>
                                    <input type="number" step="0.1" name="brazoDerecho" id="brazoDerecho" placeholder="Ej. 32.5" class="form-control input-custom-with-icon @error('brazoDerecho') is-invalid @enderror" value="{{ old('brazoDerecho') }}">
                                </div>
                                @error('brazoDerecho') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- ANTEBRAZO IZQUIERDO --}}
                            <div class="col-12 col-md-3">
                                <label for="antebrazoIzquierdo" class="form-label fw-bold text-secondary mb-2">Antebrazo Izq. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-left-short"></i></span>
                                    <input type="number" step="0.1" name="antebrazoIzquierdo" id="antebrazoIzquierdo" placeholder="Ej. 24" class="form-control input-custom-with-icon @error('antebrazoIzquierdo') is-invalid @enderror" value="{{ old('antebrazoIzquierdo') }}">
                                </div>
                                @error('antebrazoIzquierdo') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- ANTEBRAZO DERECHO --}}
                            <div class="col-12 col-md-3">
                                <label for="antebrazoDerecho" class="form-label fw-bold text-secondary mb-2">Antebrazo Der. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-right-short"></i></span>
                                    <input type="number" step="0.1" name="antebrazoDerecho" id="antebrazoDerecho" placeholder="Ej. 24.2" class="form-control input-custom-with-icon @error('antebrazoDerecho') is-invalid @enderror" value="{{ old('antebrazoDerecho') }}">
                                </div>
                                @error('antebrazoDerecho') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- SUBSECCIÓN 4: TREN INFERIOR --}}
                            <div class="col-12">
                                <h5 class="form-section-divider mb-1"><i class="bi bi-activity me-1"></i> Extremidades Inferiores</h5>
                            </div>

                            {{-- PIERNA IZQUIERDA --}}
                            <div class="col-12 col-md-3">
                                <label for="piernaIzquierda" class="form-label fw-bold text-secondary mb-2">Pierna Izq. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-chevron-bar-left"></i></span>
                                    <input type="number" step="0.1" name="piernaIzquierda" id="piernaIzquierda" placeholder="Ej. 52" class="form-control input-custom-with-icon @error('piernaIzquierda') is-invalid @enderror" value="{{ old('piernaIzquierda') }}">
                                </div>
                                @error('piernaIzquierda') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- PIERNA DERECHA --}}
                            <div class="col-12 col-md-3">
                                <label for="piernaDerecha" class="form-label fw-bold text-secondary mb-2">Pierna Der. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-chevron-bar-right"></i></span>
                                    <input type="number" step="0.1" name="piernaDerecha" id="piernaDerecha" placeholder="Ej. 52.5" class="form-control input-custom-with-icon @error('piernaDerecha') is-invalid @enderror" value="{{ old('piernaDerecha') }}">
                                </div>
                                @error('piernaDerecha') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- PANTORRILLA IZQUIERDA --}}
                            <div class="col-12 col-md-3">
                                <label for="pantorrillaIzquierda" class="form-label fw-bold text-secondary mb-2">Pantorrilla Izq. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-down-left"></i></span>
                                    <input type="number" step="0.1" name="pantorrillaIzquierda" id="pantorrillaIzquierda" placeholder="Ej. 36" class="form-control input-custom-with-icon @error('pantorrillaIzquierda') is-invalid @enderror" value="{{ old('pantorrillaIzquierda') }}">
                                </div>
                                @error('pantorrillaIzquierda') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- PANTORRILLA DERECHA --}}
                            <div class="col-12 col-md-3">
                                <label for="pantorrillaDerecha" class="form-label fw-bold text-secondary mb-2">Pantorrilla Der. (cm)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-arrow-down-right"></i></span>
                                    <input type="number" step="0.1" name="pantorrillaDerecha" id="pantorrillaDerecha" placeholder="Ej. 36.4" class="form-control input-custom-with-icon @error('pantorrillaDerecha') is-invalid @enderror" value="{{ old('pantorrillaDerecha') }}">
                                </div>
                                @error('pantorrillaDerecha') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                            {{-- SUBSECCIÓN 5: CONTROL DEL REGISTRO --}}
                            <div class="col-12">
                                <h5 class="form-section-divider mb-1"><i class="bi bi-hdd-network me-1"></i> Sistema</h5>
                            </div>

                            {{-- FECHA DE REGISTRO SISTEMA --}}
                            <div class="col-12 col-md-6">
                                <label for="fechaRegistro" class="form-label fw-bold text-secondary mb-2">Fecha de Guardado Técnico</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="bi bi-calendar-check"></i></span>
                                    <input type="date" name="fechaRegistro" id="fechaRegistro" class="form-control input-custom-with-icon @error('fechaRegistro') is-invalid @enderror" value="{{ old('fechaRegistro', date('Y-m-d')) }}">
                                </div>
                                @error('fechaRegistro') <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div> @enderror
                            </div>

                        </div>

                        {{-- BOTONES DE ACCIÓN --}}
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-light">
                            <a href="{{ route('valoraciones.index') }}" 
                               class="btn btn-outline-secondary btn-panel-pill bg-white shadow-sm">
                                <i class="bi bi-arrow-left-circle me-2"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-success btn-panel-pill shadow-sm text-white">
                                <i class="bi bi-check-circle me-2"></i> Guardar Valoración
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection