@extends('layouts.app')

@section('title', 'Gestión de Planes Nutricionales')

@section('content')

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
  
    

    <!-- Encabezado con título y botón de crear -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Planes Nutricionales</h2>
        <a href="{{ route('calculadora.index') }}" 
        class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
        style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
        <i class="bi bi-calculator me-2"></i> Crear un nuevo plan con la calculadora
        </a>
    </div>

    <!-- Tarjeta que contiene la tabla -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-hover text-center align-middle mb-0">
                <thead class="table-dark rounded-top">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Calorías</th>
                        <th>Proteínas</th>
                        <th>Carbohidratos</th>
                        <th>Grasas</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($planes as $plan)
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->usuario->nombre ?? 'Usuario eliminado' }}</td>
                            <td>{{ number_format($plan->calorias_diarias) }} kcal</td>
                            <td>{{ $plan->proteinas_gramos }}g</td>
                            <td>{{ $plan->carbohidratos_gramos }}g</td>
                            <td>{{ $plan->grasas_gramos }}g</td>
                            <td>
                                @if($plan->activo)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('planes-nutricionales.edit', $plan->id) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill fw-bold me-2">
                                   <i class="bi bi-pencil-square"></i>editar
                                </a>
                                <form action="{{ route('planes-nutricionales.destroy', $plan->id) }}" method="POST" 
                                      style="display:inline-block;">
                                    @csrf
                                  
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger rounded-pill fw-bold"
                                            onclick="confirmarEliminacion(event)">
                                        <i class="bi bi-trash"></i>Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted">No hay planes nutricionales registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botón de volver -->
    <div class="mt-4">
        <a href="{{ route('welcome') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
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

@endsection