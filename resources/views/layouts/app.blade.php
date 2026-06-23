@extends('adminlte::page')

@section('title', 'FitBoost')

@section('content_header')
<div class="d-flex justify-content-between align-items-center p-2 rounded">
    <div>
        <h1 class="fw-bold mb-1" style="color: var(--sena-dark);">
            <i class="bi bi-activity me-2"></i>FitBoost
        </h1>
        <p class="text-muted mb-0">Plataforma de entrenamiento y seguimiento físico</p>
    </div>
    <div>
        <!-- Usamos estilos en línea o clases personalizadas para asegurar el color corporativo -->
        <span class="badge p-2 text-white" style="background-color: var(--sena-green); font-size: 0.9rem; border-radius: 8px;">
            SENA
        </span>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    @yield('contenido')
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