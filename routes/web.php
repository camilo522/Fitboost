<?php

use App\Http\Controllers\CalculadoraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EjerciciosController;
use App\Http\Controllers\EntrenamientosController;
use App\Http\Controllers\PlanNutricionalController;
use App\Http\Controllers\RutinaEjerciciosController;
use App\Http\Controllers\RutinasController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ValoracionesController;
use App\Models\PlanNutricional;

// Página inicial (landing con el logo de FitBoost)
Route::get('/', function () {
    return view('landing');
});

Route::get('/welcome', function () {
    return view('welcome'); // aquí va el welcome
})->name('welcome');

// ------------------- EJERCICIOS -------------------
Route::get('/ejercicios/index/', [EjerciciosController::class, 'index'])->name('ejercicios.index');
Route::get('/ejercicios/create/', [EjerciciosController::class, 'create'])->name('ejercicios.create');
Route::post('/ejercicios/store/', [EjerciciosController::class, 'store'])->name('ejercicios.store');
Route::get('/ejercicios/edit/{id}', [EjerciciosController::class, 'edit'])->name('ejercicios.edit');
Route::post('/ejercicios/update/{id}', [EjerciciosController::class, 'update'])->name('ejercicios.update');
Route::post('/ejercicios/destroy/{id}', [EjerciciosController::class, 'destroy'])->name('ejercicios.destroy');

// ------------------- ENTRENAMIENTOS -------------------
Route::get('/entrenamientos/index/', [EntrenamientosController::class, 'index'])->name('entrenamientos.index');
Route::get('/entrenamientos/create/', [EntrenamientosController::class, 'create'])->name('entrenamientos.create');
Route::post('/entrenamientos/store/', [EntrenamientosController::class, 'store'])->name('entrenamientos.store');
Route::get('/entrenamientos/edit/{id}', [EntrenamientosController::class, 'edit'])->name('entrenamientos.edit');
Route::post('/entrenamientos/update/{id}', [EntrenamientosController::class, 'update'])->name('entrenamientos.update');
Route::post('/entrenamientos/destroy/{id}', [EntrenamientosController::class, 'destroy'])->name('entrenamientos.destroy');

// ------------------- RUTINA EJERCICIOS -------------------
Route::get('/rutinaEjercicios/index/', [RutinaEjerciciosController::class, 'index'])->name('rutinaEjercicios.index');
Route::get('/rutinaEjercicios/create/', [RutinaEjerciciosController::class, 'create'])->name('rutinaEjercicios.create');
Route::post('/rutinaEjercicios/store/', [RutinaEjerciciosController::class, 'store'])->name('rutinaEjercicios.store');
Route::get('/rutinaEjercicios/edit/{id}', [RutinaEjerciciosController::class, 'edit'])->name('rutinaEjercicios.edit');
Route::post('/rutinaEjercicios/update/{id}', [RutinaEjerciciosController::class, 'update'])->name('rutinaEjercicios.update');
Route::post('/rutinaEjercicios/destroy/{id}', [RutinaEjerciciosController::class, 'destroy'])->name('rutinaEjercicios.destroy');

// ------------------- RUTINAS -------------------
Route::get('/rutinas/index/', [RutinasController::class, 'index'])->name('rutinas.index');
Route::get('/rutinas/create/', [RutinasController::class, 'create'])->name('rutinas.create');
Route::post('/rutinas/store/', [RutinasController::class, 'store'])->name('rutinas.store');
Route::get('/rutinas/edit/{id}', [RutinasController::class, 'edit'])->name('rutinas.edit');
Route::post('/rutinas/update/{id}', [RutinasController::class, 'update'])->name('rutinas.update');
Route::post('/rutinas/destroy/{id}', [RutinasController::class, 'destroy'])->name('rutinas.destroy');

// ------------------- USUARIO -------------------
Route::get('/usuario/index/', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('/usuario/create/', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store/', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/usuario/edit/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::post('/usuario/update/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::post('/usuario/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

// ------------------- VALORACIONES -------------------
Route::get('/valoraciones/index/', [ValoracionesController::class, 'index'])->name('valoraciones.index');
Route::get('/valoraciones/create/', [ValoracionesController::class, 'create'])->name('valoraciones.create');
Route::post('/valoraciones/store/', [ValoracionesController::class, 'store'])->name('valoraciones.store');
Route::get('/valoraciones/edit/{id}', [ValoracionesController::class, 'edit'])->name('valoraciones.edit');
Route::post('/valoraciones/update/{id}', [ValoracionesController::class, 'update'])->name('valoraciones.update');
Route::post('/valoraciones/destroy/{id}', [ValoracionesController::class, 'destroy'])->name('valoraciones.destroy');
Route::get('/valoraciones/{id}/historial', [App\Http\Controllers\ValoracionesController::class, 'historial'])->name('valoraciones.historial');

// ------------------- planes-nutricionales -------------------
Route::get('/planes-nutricionales/index/', [PlanNutricionalController::class, 'index'])->name('planes-nutricionales.index');
Route::get('/planes-nutricionales/create/', [PlanNutricionalController::class, 'create'])->name('planes-nutricionales.create');
Route::post('/planes-nutricionales/store/', [PlanNutricionalController::class, 'store'])->name('planes-nutricionales.store');
Route::get('/planes-nutricionales/edit/{id}', [PlanNutricionalController::class, 'edit'])->name('planes-nutricionales.edit');
Route::post('/planes-nutricionales/update/{id}', [PlanNutricionalController::class, 'update'])->name('planes-nutricionales.update');
Route::post('/planes-nutricionales/destroy/{id}', [PlanNutricionalController::class, 'destroy'])->name('planes-nutricionales.destroy');


// Rutas para la Calculadora de Macronutrientes
Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora.index');
Route::post('/calculadora/calcular', [CalculadoraController::class, 'calcular'])->name('calculadora.calcular');