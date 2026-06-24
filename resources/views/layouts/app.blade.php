@extends('adminlte::page')

@section('title', 'FitBoost')

@section('content_header')
@stop

@section('content')
<div class="container-fluid pt-3 animate__animated animate__fadeIn">
    
    {{-- TARJETA PRINCIPAL DEL APLICATIVO (Integra cabecera y contenido) --}}
    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        
        {{-- CABECERA INTERNA DE LA TARJETA: El logo ahora vive aquí adentro --}}
        <div class="card-header bg-white border-bottom p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h1 class="fw-bold mb-1" style="color: var(--sena-dark); font-size: 1.8rem; letter-spacing: -0.5px;">
                        <i class="bi bi-activity me-2" style="color: var(--sena-green);"></i>FitBoost
                    </h1>
                    <p class="text-muted mb-0 small">Plataforma de entrenamiento y seguimiento físico</p>
                </div>
                <div>
                    <span class="badge p-2 text-white" style="background-color: var(--sena-green); font-size: 0.9rem; border-radius: 8px; font-weight: 600;">
                        SENA
                    </span>
                </div>
            </div>
        </div>

        {{-- CUERPO DE LA TARJETA: Espacio dinámico para tus vistas hijas --}}
        <div class="card-body p-3 p-md-4" style="background: rgba(248, 250, 252, 0.5);">
            @yield('contenido')
        </div>

    </div>

</div>
@stop

@section('css')
    <!-- Cargamos los estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <!-- Iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Animaciones sutiles para transiciones de página -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @yield('custom_css')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('custom_js')
@stop