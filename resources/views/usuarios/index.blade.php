@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('titleContent')
<div class="sena-header shadow-sm rounded-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        
        <div>
            <h1 class="fw-bold text-white mb-1">
                <i class="bi bi-people-fill me-2"></i>
                Gestión de Usuarios
            </h1>

            <p class="text-white-50 mb-0">
                Administración de aprendices y usuarios del sistema
            </p>
        </div>

        <div>
            <a href="{{ route('usuario.create')}}" 
               class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i>
                Nuevo Usuario
            </a>
        </div>

    </div>
</div>
@endsection

@section('content')

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

<div class="container-fluid">

{{-- BOTÓN NUEVO USUARIO --}}
<div class="d-flex justify-content-end mb-4">

    <a href="{{ route('usuario.create') }}"
       class="btn btn-sena rounded-pill px-4 py-2 fw-bold shadow-sm">

        <i class="bi bi-person-plus-fill me-2"></i>
        Crear Nuevo Usuario

    </a>

</div>

    {{-- CARD PRINCIPAL --}}
    <div class="card sena-card border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="sena-table">

                        <tr>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th>Fecha Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($usuarios as $usuario)

                        <tr>

                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $usuario->email }}
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2">

                                    <div class="user-icon">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $usuario->nombre }}
                                    </span>

                                </div>
                            </td>

                            <td>
                                <span class="badge sena-badge">
                                    {{ $usuario->fechaRegistro }}
                                </span>
                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center flex-wrap gap-2">

                                    {{-- PERFIL --}}
                                    <a href="{{ route('usuario.show', $usuario->id) }}"
                                       class="btn btn-perfil btn-sm rounded-pill px-3">

                                        <i class="bi bi-person-vcard me-1"></i>
                                        Perfil

                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('usuario.edit', $usuario->id) }}"
                                       class="btn btn-editar btn-sm rounded-pill px-3">

                                        <i class="bi bi-pencil-square me-1"></i>
                                        Editar

                                    </a>

                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('usuario.destroy', $usuario->id) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                                class="btn btn-eliminar btn-sm rounded-pill px-3"
                                                onclick="confirmarEliminacion(event)">

                                            <i class="bi bi-trash-fill me-1"></i>
                                            Eliminar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4">

                                <div class="empty-state text-center py-5">

                                    <i class="bi bi-people display-3 text-muted"></i>

                                    <h5 class="mt-3 text-muted">
                                        No hay usuarios registrados
                                    </h5>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- BOTÓN VOLVER --}}
    <div class="mt-4">

        <a href="{{ route('welcome') }}"
           class="btn btn-sena rounded-pill px-4 fw-bold">

            <i class="bi bi-arrow-left-circle me-2"></i>
            Volver al panel

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
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#39A900',
            cancelButtonColor: '#d33',

            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'

        }).then((result) => {

            if (result.isConfirmed) {

                form.submit();

            }

        });

    }

</script>

{{-- ESTILOS --}}
<style>

    .sena-header{
        background: linear-gradient(135deg, #39A900, #007832);
        padding: 30px;
    }

    .sena-card{
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    }

    .sena-table{
        background: #39A900;
        color: white;
    }

    .sena-table th{
        padding: 18px !important;
        border: none;
        font-size: 15px;
    }

    .table tbody tr{
        transition: 0.3s ease;
    }

    .table tbody tr:hover{
        transform: scale(1.01);
        background: rgba(57,169,0,0.05);
    }

    .user-icon{
        width: 38px;
        height: 38px;
        background: #39A900;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sena-badge{
        background: rgba(57,169,0,0.15);
        color: #007832;
        padding: 10px 15px;
        border-radius: 20px;
        font-size: 13px;
    }

    .btn-sena{
    background: linear-gradient(135deg, #39A900, #007832);
    color: white;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(57,169,0,0.25);
    }

    .btn-sena:hover{
        background: linear-gradient(135deg, #2d8700, #006128);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(57,169,0,0.35);
    }

    .btn-perfil{
        background: #0d6efd;
        color: white;
    }

    .btn-editar{
        background: #39A900;
        color: white;
    }

    .btn-eliminar{
        background: #dc3545;
        color: white;
    }

    .btn-perfil:hover,
    .btn-editar:hover,
    .btn-eliminar:hover{
        color: white;
        transform: translateY(-2px);
    }

    .empty-state{
        opacity: 0.7;
    }

</style>

@endsection