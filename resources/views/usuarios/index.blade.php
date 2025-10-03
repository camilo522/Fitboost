@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('titleContent')
    <div class="bg-gradient p-4 rounded-4 shadow-lg text-center mb-4" 
         style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
        <h1 class="text-white mb-0">Gestión de Usuarios</h1>
    </div>
@endsection

@section('content')
<div class="container">

    {{-- Botón Crear --}}
    <div class="row mb-3">
        <div class="col text-end">
            <a href="{{ route('usuario.create')}}"  type="submit" 
                            class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
                            style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
                        <i class="bi bi-check-circle me-2"></i>Crear un nuevo usuario
            </a>
        </div>
    </div>

    {{-- Tabla de usuarios --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Fecha Registro</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->fechaRegistro }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuario.edit',$usuario->id) }}" 
                                   class="btn btn-success shadow rounded-pill px-3 me-2">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                
                                <form action="{{ route('usuario.destroy',$usuario->id) }}" 
                                      method="post" 
                                      style="display:inline-block;">
                                    @csrf
                                    
                                    <button type="submit" 
                                            class="btn btn-danger shadow rounded-pill px-3"
                                            onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                <em>No hay usuarios registrados</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
    </div>
</div>
@endsection
