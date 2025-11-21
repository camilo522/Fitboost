<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculadoraRequest;
use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
            /**
         * Muestra el formulario de la calculadora.
         */
        public function index()
        {
            // Obtenemos todos los usuarios de la base de datos
            $usuarios = \App\Models\Usuario::all();

            // Pasamos la lista de usuarios a la vista
            return view('calculadora.index', compact('usuarios'));
        }

    
   /**
 * Procesa los datos del formulario y calcula los macronutrientes.
 */
    public function calcular(CalculadoraRequest $request)
    {
    // 1. Validar los datos de entrada
    $request->validate([
        'id_usuario' => 'required|exists:usuarios,id',
        'genero' => 'required|in:hombre,mujer',
        'edad' => 'required|integer|min:15',
        'peso' => 'required|numeric|min:30',
        'altura' => 'required|integer|min:100',
        'nivel_actividad' => 'required|in:sedentario,ligero,moderado,muy_activo,extremadamente_activo',
        'objetivo' => 'required|in:perdida_grasa,mantenimiento,ganancia_musculo',
    ]);

    $datos = $request->all();

    // 2. Calcular la Tasa Metabólica Basal (TMB)
    if ($datos['genero'] === 'hombre') {
        $tmb = (10 * $datos['peso']) + (6.25 * $datos['altura']) - (5 * $datos['edad']) + 5;
    } else { // mujer
        $tmb = (10 * $datos['peso']) + (6.25 * $datos['altura']) - (5 * $datos['edad']) - 161;
    }

    // 3. Multiplicar por el factor de actividad
    $factoresActividad = [
        'sedentario' => 1.2,
        'ligero' => 1.375,
        'moderado' => 1.55,
        'muy_activo' => 1.725,
        'extremadamente_activo' => 1.9,
    ];
    $caloriasMantenimiento = $tmb * $factoresActividad[$datos['nivel_actividad']];

    // 4. Ajustar las calorías según el objetivo
    $caloriasFinales = $caloriasMantenimiento;
    if ($datos['objetivo'] === 'perdida_grasa') {
        $caloriasFinales -= 500;
    } elseif ($datos['objetivo'] === 'ganancia_musculo') {
        $caloriasFinales += 300;
    }

    // 5. Calcular los macronutrientes
    $proteinas = $datos['peso'] * 2.0;
    $grasas = ($caloriasFinales * 0.25) / 9;
    $caloriasRestantes = $caloriasFinales - ($proteinas * 4) - ($grasas * 9);
    $carbohidratos = $caloriasRestantes / 4;

    // --- LÍNEAS CLAVE AÑADIDAS/CORREGIDAS ---
    // Buscamos el usuario para obtener su nombre
    $usuario = \App\Models\Usuario::find($datos['id_usuario']);

    // 6. Preparamos el array de resultados
    $resultados = [
        'datos' => $datos,
        'usuario_nombre' => $usuario->nombre, // <-- ¡ESTA LÍNEA ESENCIAL!
        'calorias' => round($caloriasFinales),
        'proteinas' => round($proteinas),
        'grasas' => round($grasas),
        'carbohidratos' => round($carbohidratos),
    ];

    // 7. Enviamos los resultados a la vista
    return view('calculadora.resultados', compact('resultados'));
    }
}