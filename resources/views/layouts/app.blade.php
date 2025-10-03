@extends('adminlte::page')

@section('title', 'FitBoost')

@section('content_header')
	<h1>FitBoost</h1>
@stop

@section('content')
	<p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .welcome-bg {
            min-height: 100vh;
            background: url('/images/fitboost.jpg') no-repeat center center/cover;
            position: relative;
        }
        .welcome-bg::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 0;
        }
        .welcome-bg .container-fluid {
            position: relative;
            z-index: 1;
        }

        .btn-gradient {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    color: #fff !important;
    border: none;
    font-weight: bold;
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 12px rgba(106, 17, 203, 0.3);
}
.btn-gradient:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0px 6px 16px rgba(37, 117, 252, 0.5);
}



    </style>

@stop

@section('js')
	<script> console.log('Hi!'); </script>
@stop
    
    