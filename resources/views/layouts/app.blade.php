@extends('adminlte::page')

@section('title', 'FitBoost')

@section('content_header') <div class="d-flex justify-content-between align-items-center"> <div> <h1 class="fw-bold text-success"> <i class="bi bi-activity me-2"></i>
FitBoost </h1> <p class="text-muted mb-0">
Plataforma de entrenamiento y seguimiento físico </p> </div>

    <div>
        <span class="badge bg-success p-2">
            SENA
        </span>
    </div>
</div>

@stop

@section('content')

<div class="container-fluid">

@yield('contenido')

</div>

@stop

@section('css')

<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stop
