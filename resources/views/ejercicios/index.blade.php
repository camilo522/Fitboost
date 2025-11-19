@extends('layouts.app')

@section('title', 'Listado de Ejercicios')

@section('titleContent')
    <h1 class="text-center fw-bold my-4 text-gradient">
        <i class="bi bi-bicycle"></i> Gestión de Ejercicios
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


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Crear nuevo ejercicio</h2>
        <a href="{{ route('ejercicios.create') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-plus-circle me-2"></i> Crear nuevo ejercicio
        </a>
    </div>


    <div class="table-responsive shadow-lg rounded-4">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Grupo Muscular</th>
                    <th>Dificultad</th>
                    <th>Duración Estimada</th>
                    <th>Intensidad</th>
                    <th>Equipo Necesario</th>
                    <th>Imagen</th>
                    <th>Video</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ejercicios as $ejercicio)
                    <tr>
                        <td>{{ $ejercicio->id }}</td>
                        <td>{{ $ejercicio->nombre }}</td>
                        <td>{{ $ejercicio->descripcion }}</td>
                        <td>{{ $ejercicio->categoria }}</td>
                        <td>{{ $ejercicio->grupoMuscular }}</td>
                        <td>{{ $ejercicio->dificultad }}</td>
                        <td>{{ $ejercicio->duracionEstimada }}</td>
                        <td>{{ $ejercicio->intensidad }}</td>
                        <td>{{ $ejercicio->equipoNecesario }}</td>
                        <td>
                            @if($ejercicio->imagenURL)
                                @php
                                    $isExternal = Str::startsWith($ejercicio->imagenURL, ['http://', 'https://']);
                                @endphp
                            <img 
                                src="{{ $isExternal ? $ejercicio->imagenURL : asset('storage/'.$ejercicio->imagenURL) }}" 
                                alt="Imagen de {{ $ejercicio->nombre }}" 
                                width="100" 
                                class="rounded shadow cursor-pointer"
                                onclick="abrirModalImagen(`{{ $isExternal ? $ejercicio->imagenURL : asset('storage/'.$ejercicio->imagenURL) }}`)">

                            @else
                                <span class="text-muted">No disponible</span>
                            @endif
                        </td>

                        <!-- --- COLUMNA DE VIDEO CORREGIDA --- -->
                        <td>
                            @if($ejercicio->videoURL)
                                @php
                                    // Comprobamos si el video es un enlace externo o un archivo local
                                    $isVideoExternal = Str::startsWith($ejercicio->videoURL, ['http://', 'https://']);
                                    $videoSrc = $isVideoExternal ? $ejercicio->videoURL : asset('storage/'.$ejercicio->videoURL);
                                @endphp

                                @if(str_contains($ejercicio->videoURL, '.gif'))
                                    <!-- Si es un GIF, lo mostramos como una imagen y usamos el modal de imagen -->
                                    <img 
                                        src="{{ $videoSrc }}" 
                                        alt="GIF de {{ $ejercicio->nombre }}" 
                                        width="100" 
                                        class="rounded shadow cursor-pointer"
                                        onclick="abrirModalImagen('{{ $videoSrc }}')">
                                @else
                                    <!-- Si es un video, mostramos el reproductor y usamos el modal de video -->
                                    <video
                                        src="{{ $videoSrc }}"
                                        width="100"
                                        autoplay
                                        loop
                                        muted
                                        playsinline
                                        class="rounded shadow cursor-pointer"
                                        data-video="{{ $videoSrc }}"
                                        onclick="abrirModal(this.dataset.video)">
                                    </video>
                                @endif
                            @else
                                <span class="text-muted">No disponible</span>
                            @endif
                        </td>
                        <!-- --- FIN DE LA COLUMNA CORREGIDA --- -->

                        <td>
                            <a href="{{ route('ejercicios.edit', $ejercicio->id) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill fw-bold me-2">
                                   <i class="bi bi-pencil-square"></i>editar
                                </a>
                            
                            <form action="{{ route('ejercicios.destroy', $ejercicio->id) }}" method="POST" 
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
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <a href="{{ route('welcome') }}" 
           class="btn text-white fw-bold rounded-pill px-4 shadow-sm"
           style="background: linear-gradient(90deg, #6a11cb, #2575fc);">
           <i class="bi bi-arrow-left-circle me-2"></i> Volver
        </a>
        
    </div>

    <!-- Modal Video -->
    <div id="modalGIF" 
        class="modal-fade d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" 
        style="z-index: 1050;">
        <div class="position-relative" onclick="event.stopPropagation()">
            <video id="modalVideo" autoplay loop muted playsinline style="max-width: 90vw; max-height: 90vh;" class="rounded shadow"></video>
            <button 
                type="button" 
                class="btn btn-light position-absolute top-0 end-0 m-2" 
                onclick="cerrarModal()">
                ✕
            </button>
        </div>
    </div>

    <!-- Modal Imagen -->
    <div id="modalImagen" 
        class="modal-fade d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" 
        style="z-index: 1050;">
        <div class="position-relative" onclick="event.stopPropagation()">
            <img id="modalImagenSrc" src="" alt="Imagen" style="max-width: 90vw; max-height: 90vh;" class="rounded shadow">
            <button type="button" 
                    class="btn btn-light position-absolute top-0 end-0 m-2" 
                    onclick="cerrarModalImagen()">
                ✕
            </button>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .modal-fade {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-fade.show {
            opacity: 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const modal = document.getElementById('modalGIF');
        const modalVideo = document.getElementById('modalVideo');
        const modalImagen = document.getElementById('modalImagen');
        const modalImagenSrc = document.getElementById('modalImagenSrc');

        function abrirModal(videoSrc) {
            modalVideo.src = videoSrc;
            modal.classList.remove('d-none');
            void modal.offsetWidth; // Forzar reflow
            modal.classList.add('show');
        }

        function cerrarModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                modalVideo.pause();
                modalVideo.src = '';
                modal.classList.add('d-none');
            }, 300);
        }

        function abrirModalImagen(src) {
            modalImagenSrc.src = src;
            modalImagen.classList.remove('d-none');
            void modalImagen.offsetWidth; // Forzar reflow
            modalImagen.classList.add('show');
        }

        function cerrarModalImagen() {
            modalImagen.classList.remove('show');
            setTimeout(() => {
                modalImagenSrc.src = '';
                modalImagen.classList.add('d-none');
            }, 300);
        }

        // Cerrar modales si se hace clic fuera del contenido
        modal.addEventListener('click', cerrarModal);
        modalImagen.addEventListener('click', cerrarModalImagen);
    </script>

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
@endpush



