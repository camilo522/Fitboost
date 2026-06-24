@extends('layouts.app')

@section('title', 'Usuarios | FitBoost')

@section('content')

{{-- Estilos integrados dedicados a la estética Glassmorphism para la vista de listados --}}
<style>
    /* Cabecera estilizada de cristal suave */
    .glass-header {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.04);
    }

    /* Contenedor de la tabla con efecto Glass */
    .glass-card-table {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        box-shadow: 0 10px 30px 0 rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Ajuste fino para la cabecera de la tabla */
    .table-thead-custom {
        background-color: rgba(57, 169, 0, 0.08) !important;
        border-bottom: 2px solid rgba(57, 169, 0, 0.2);
    }
    .table-thead-custom th {
        color: #1e3a1e !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 16px !important;
    }

    /* Hover fluido e impecable para las filas de la tabla */
    .table-hover-custom tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover-custom tbody tr:hover {
        background-color: rgba(57, 169, 0, 0.04) !important;
    }

    /* Rediseño del avatar del usuario */
    .avatar-shape-sm {
        width: 36px;
        height: 36px;
        background: rgba(57, 169, 0, 0.12);
        color: #2d8200;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    /* Badges refinados estilo píldora */
    .pill-badge-success {
        background: rgba(57, 169, 0, 0.12);
        color: #2d8200;
        padding: 0.45rem 1rem;
        font-weight: 600;
        border-radius: 30px;
        font-size: 0.8rem;
    }

    /* Botones estilo píldora para acciones de la tabla */
    .btn-action-pill {
        border-radius: 30px;
        padding: 0.35rem 1.1rem;
        font-weight: 600;
        font-size: 0.825rem;
        transition: all 0.2s ease;
    }
    .btn-action-pill:hover {
        transform: translateY(-2px);
    }
</style>

{{-- ALERTA SUCCESS --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Proceso exitoso',
            text: "{{ session('success') }}",
            confirmButtonColor: '#39A900',
            timer: 2500,
            showConfirmButton: false
        });
    });
</script>
@endif

{{-- ALERTA ERROR --}}
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Ocurrió un problema',
            text: "{{ session('error') }}",
            confirmButtonColor: '#39A900'
        });
    });
</script>
@endif

<div class="container-fluid py-2">

    {{-- CABECERA SECCIÓN --}}
    <div class="card glass-header rounded-4 border-0 mb-4 p-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-success mb-1" style="letter-spacing: -0.5px;">
                        <i class="bi bi-people-fill me-2"></i>Gestión de Usuarios
                    </h2>
                    <p class="text-muted mb-0 small">
                        Administración de aprendices y usuarios registrados en el sistema
                    </p>
                </div>
                <div>
                    <a href="{{ route('usuario.create') }}" class="btn btn-success btn-panel-pill px-4 shadow-sm">
                        <i class="bi bi-person-plus-fill me-2"></i>Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD TABLA PRINCIPAL --}}
    <div class="card glass-card-table border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover-custom align-middle mb-0">
                    <thead class="table-thead-custom">
                        <tr>
                            <th style="padding-left: 24px !important;">Nombre / Usuario</th>
                            <th>Email</th>
                            <th>Fecha Registro</th>
                            <th class="text-center" style="padding-right: 24px !important;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                        <tr>
                            <td style="padding-left: 24px !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-shape-sm">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark">{{ $usuario->nombre }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-secondary fw-semibold">
                                    {{ $usuario->email }}
                                </div>
                            </td>
                            <td>
                                <span class="pill-badge-success">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $usuario->fechaRegistro }}
                                </span>
                            </td>
                            <td style="padding-right: 24px !important;">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- PERFIL --}}
                                    <a href="{{ route('usuario.show', $usuario->id) }}"
                                       class="btn btn-outline-primary btn-action-pill">
                                        <i class="bi bi-person-vcard me-1"></i> Perfil
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('usuario.edit', $usuario->id) }}"
                                       class="btn btn-outline-success btn-action-pill">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </a>

                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-action-pill"
                                                onclick="confirmarEliminacion(event)">
                                            <i class="bi bi-trash-fill me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted py-4">
                                    <i class="bi bi-people display-3 opacity-50 mb-3 d-block"></i>
                                    <h5 class="fw-bold">No hay usuarios registrados</h5>
                                    <p class="small text-secondary mb-0">Crea un nuevo registro para comenzar a poblar el sistema.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PIE DE PÁGINA / REGRESAR --}}
    <div class="mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-panel-pill shadow-sm bg-white">
            <i class="bi bi-arrow-left-circle me-2"></i>Volver al panel
        </a>
    </div>

</div>

{{-- SWEET ALERT --}}
<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Eliminar usuario?',
            text: 'Esta acción no se puede deshacer de forma directa.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#39A900',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection