@extends('layouts.app')

@section('title')
    Gestión de Valoraciones
@endsection

@section('titleContent')
    <h1 class="text-center mb-4 text-gradient">
        <i class="bi bi-clipboard-heart"></i> Gestión de Valoraciones
    </h1>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col text-end">
        <a href="{{ route('valoraciones.create')}}"  
           class="btn rounded-pill shadow-sm px-4 text-white fw-bold" 
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
            <i class="bi bi-plus-circle me-2"></i>Nueva Valoración
        </a>
    </div>
</div>

<div class="card shadow-lg border-0 rounded-4">
    <div class="card-body">
        <h4 class="mb-3 text-black">Valoraciones Registradas</h4>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Pecho</th>
                        <th>Cintura</th>
                        <th>Cadera</th>
                        <th>Brazo Izq.</th>
                        <th>Brazo Der.</th>
                        <th>Pierna Izq.</th>
                        <th>Pierna Der.</th>
                        <th>Pantorrilla Izq.</th>
                        <th>Pantorrilla Der.</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valoraciones as $valoracion)
                        <tr>
                            <td class="text-center">{{ $valoracion->id }}</td>
                            <td class="text-center">{{ $valoracion->usuario->nombre ?? 'N/A' }}</td>
                            <td class="text-center">{{ $valoracion->fecha }}</td>
                            <td class="text-center">{{ $valoracion->peso }} kg</td>
                            <td class="text-center">{{ $valoracion->altura }} cm</td>
                            <td class="text-center">{{ $valoracion->pecho }} cm</td>
                            <td class="text-center">{{ $valoracion->cintura }} cm</td>
                            <td class="text-center">{{ $valoracion->cadera }} cm</td>
                            <td class="text-center">{{ $valoracion->brazoIzquierdo }} cm</td>
                            <td class="text-center">{{ $valoracion->brazoDerecho }} cm</td>
                            <td class="text-center">{{ $valoracion->piernaIzquierda }} cm</td>
                            <td class="text-center">{{ $valoracion->piernaDerecha }} cm</td>
                            <td class="text-center">{{ $valoracion->pantorrillaIzquierda }} cm</td>
                            <td class="text-center">{{ $valoracion->pantorrillaDerecha }} cm</td>
                            <td class="text-center">
                                <a href="{{ route('valoraciones.edit',$valoracion->id) }}" 
                                   class="btn btn-success shadow rounded-pill px-3 me-2">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <a href="{{ route('valoraciones.historial', $valoracion->id) }}" 
                                class="btn btn-outline-info btn-sm">
                                <i class="fas fa-history"></i> Ver historial
                                </a>

                                <form action="{{ route('valoraciones.destroy',$valoracion->id) }}" 
                                      method="post" style="display:inline-block;">
                                    @csrf
                                  
                                    <button type="submit" 
                                            class="btn btn-danger shadow rounded-pill px-3"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta valoración?')">
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
</div>






<style>
    .text-gradient {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection