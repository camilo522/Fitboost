@extends('layouts.app')

@section('title', 'Listado de Rutinas')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar',
                timer: 3000
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '¡Atención!',
                text: "{{ session('error') }}",
                confirmButtonText: 'Aceptar',
            });
        });
    </script>
@endif

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Rutinas</h2>

        <a href="{{ route('rutinas.create') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg,#11cb64, #03c937);">
           <i class="bi bi-plus-circle me-2"></i> Crear una nueva rutina
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-hover text-center align-middle mb-0">
                <thead class="table-dark rounded-top">
                    <tr>
                        <th>Nombre</th>
                        <th>Horario</th>
                        <th>Descripción</th>
                        <th>Entrenamiento</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($rutinas as $rutina)
                        <tr>
                            <td>{{ $rutina->nombre }}</td>
                            <td>{{ $rutina->horario }}</td>
                            <td>{{ $rutina->descripcion }}</td>
                            <td>{{ $rutina->entrenamiento->nombre ?? 'N/A' }}</td>

                            <td>

                                <!-- BOTÓN QUE ABRE MODAL -->
                                <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalAsignar{{ $rutina->id }}">
                                    <i class="bi bi-person-check"></i> Asignar
                                </a>

                                <a href="{{ route('rutinas.edit', $rutina->id) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill fw-bold me-2">
                                   <i class="bi bi-pencil-square"></i>editar
                                </a>

                                <form action="{{ route('rutinas.destroy', $rutina->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger rounded-pill fw-bold"
                                            onclick="confirmarEliminacion(event)">
                                        <i class="bi bi-trash"></i>Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>



                        <!-- =============================== -->
                        <!--   MODAL ASIGNAR RUTINA A USUARIO -->
                        <!-- =============================== -->

                        <div class="modal fade" id="modalAsignar{{ $rutina->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-4 shadow">

                                    <div class="modal-header bg-dark text-white rounded-top-4">
                                        <h5 class="modal-title">
                                            <i class="bi bi-person-check"></i> Asignar rutina
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form action="{{ route('rutinas.asignar', $rutina->id) }}" method="POST">
                                        @csrf

                                        <div class="modal-body">

                                            <p class="mb-2">Seleccione el usuario al que quiere asignarle esta rutina:</p>

                                            <select name="usuario_id" class="form-select" required>
                                                <option value="">Seleccione un usuario</option>

                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}">
                                                        {{ $usuario->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>

                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check2-circle"></i> Asignar
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- FIN DEL MODAL -->

                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No hay rutinas registradas</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('welcome') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg,#11cb64, #03c937);">
           <i class="bi bi-arrow-left-circle me-2"></i> Volver
        </a>
    </div>
</div>

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
