@extends('layouts.app')

@section('title')
    Gestión de Entrenamientos
@endsection

@section('titleContent')
    <h1 class="text-center mb-4 text-gradient">
        <i class="bi bi-activity"></i> Gestión de Entrenamientos
    </h1>
@endsection

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
<div class="row mb-3">
    <div class="col text-end">
         <a href="{{ route('entrenamientos.create')}}"  type="submit" 
                            class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                            style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                        <i class="bi bi-check-circle me-2"></i>Nuevo Entrenamiento
            </a>
         </div>
</div>

<div class="card shadow-lg border-0 rounded-4">
    <div class="card-body">
        <h4 class="mb-3 text-black">Entrenamientos Registrados</h4>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
               <thead class="table-dark text-center">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Objetivo</th>
        <th>Duración</th>
        <th>Nivel</th>
        <th>Días/Semana</th>
        <th>Estado</th>
        <th>Opciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($entrenamientos as $entrenamiento)
        <tr>
            <td class="text-center">{{$entrenamiento->id}}</td>
            <td class="text-center">{{$entrenamiento->nombre }}</td>
            <td class="text-center" >{{$entrenamiento->descripcion }}</td>
            <td class="text-center" >{{$entrenamiento->objetivo }}</td>
            <td class="text-center" >{{$entrenamiento->duracion }}</td>
            <td class="text-center" >{{$entrenamiento->nivel }}</td>
            <td class="text-center">{{$entrenamiento->diasSemana }}</td>
            <td class="text-center">
                @if($entrenamiento->estado == 'Activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </td>

            <td class="text-center">
                <a href="{{ route('entrenamientos.edit',$entrenamiento->id) }}" 
                   class="btn btn-success shadow rounded-pill px-3 me-2">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                <form action="{{ route('entrenamientos.destroy',$entrenamiento->id) }}" 
                      method="post" style="display:inline-block;">
                    @csrf
                
                    <button type="submit" 
                            class="btn btn-danger shadow rounded-pill px-3"
                            onclick="confirmarEliminacion(event)">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
</div>

 <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('welcome') }}" 
                       class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                       style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                       <i class="bi bi-arrow-left-circle me-2"></i> Volver
                    </a>
            </a>
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